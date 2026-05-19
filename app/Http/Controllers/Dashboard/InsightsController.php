<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Insight;
use App\Models\Service;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class InsightsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $query = Insight::with(['service:id,name', 'author:id,name,designation'])
            ->latest();

        // if ($user->role !== 'admin') {
        //     $query->where('author_id', $user->id);
        // }

        // Paginate the results
        $insights = $query->paginate(10);

        return view('dashboard.insights.list', compact('insights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::pluck('name', 'id');
        $authors = Author::where('is_active', true)->orderBy('name')->get(['id', 'name', 'designation']);

        return view('dashboard.insights.create-update', compact('services', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'author_id'        => 'nullable|exists:authors,id',
            'slug'             => Gate::allows('admin') ? 'nullable|string|max:255|unique:insights,slug' : 'prohibited',
            'content_json'     => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'service_id'       => 'required|exists:services,id',
            'excerpt'          => 'nullable|string|max:500',
            'read_time'        => 'nullable|integer|min:1|max:999',
            'meta_title'       => 'nullable|string|min:15|max:80',
            'meta_description' => 'nullable|string|min:70|max:160',
            'is_published'     => Gate::allows('admin') ? 'nullable|boolean' : 'prohibited',
        ]);
 
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $this->saveThumbnail($request->file('thumbnail'));
        }
 
        $finalJson = $this->promoteTempImages($request->content_json);
 
        Insight::create([
            'title'            => $request->title,
            'slug'             => Gate::allows('admin') && $request->filled('slug')
                                    ? $request->slug
                                    : $this->uniqueSlug(Str::slug($request->title)),
            'content_json'     => $finalJson,
            'excerpt'          => $request->excerpt,
            'read_time'        => $request->read_time,
            'thumbnail'        => $thumbnailPath,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_published'     => $request->boolean('is_published'),
            'service_id'       => $request->service_id,
            'author_id'        => $request->author_id,
        ]);
 
        return redirect()->route('insights.index')->with('success', 'Insight created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insight $insight)
    {
        Gate::authorize('admin');

        $services = Service::pluck('name', 'id');
        $authors = Author::where('is_active', true)->orderBy('name')->get(['id', 'name', 'designation']);

        return view('dashboard.insights.create-update', compact('insight', 'services', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insight $insight)
    {
        Gate::authorize('admin');
 
        $request->validate([
            'title'            => 'required|string|max:255',
            'author_id'        => 'nullable|exists:authors,id',
            'slug'             => Gate::allows('admin') ? 'nullable|string|max:255|unique:insights,slug,' . $insight->id : 'prohibited',
            'content_json'     => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'service_id'       => 'required|exists:services,id',
            'excerpt'          => 'nullable|string|max:500',
            'read_time'        => 'nullable|integer|min:1|max:999',
            'meta_title'       => 'nullable|string|min:15|max:80',
            'meta_description' => 'nullable|string|min:70|max:160',
            'is_published'     => Gate::allows('admin') ? 'nullable|boolean' : 'prohibited',
        ]);
 
        $thumbnailPath = $insight->thumbnail;
 
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $this->saveThumbnail($request->file('thumbnail'));
        }
 
        $finalJson = $this->promoteTempImages($request->content_json);
        $this->cleanupRemovedImages($insight, $finalJson);
 
        $updateData = [
            'title'            => $request->title,
            'slug'             => Gate::allows('admin') && $request->filled('slug')
                                    ? $request->slug
                                    : $this->uniqueSlug(Str::slug($request->title), $insight->id),
            'content_json'     => $finalJson,
            'excerpt'          => $request->excerpt,
            'read_time'        => $request->read_time,
            'thumbnail'        => $thumbnailPath,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_published'     => $request->boolean('is_published'),
            'service_id'       => $request->service_id,
            'author_id'        => $request->author_id,
        ];
 
        $insight->update($updateData);
 
        return redirect()->route('insights.index')->with('success', 'Insight updated successfully.');
    }
    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $original = $slug;
        $count = 1;

        while (
            Insight::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insight $insight)
    {
        Gate::authorize('admin');

        if ($insight->thumbnail && Storage::disk('public')->exists($insight->thumbnail)) {
            Storage::disk('public')->delete($insight->thumbnail);
        }

        $data = is_array($insight->content_json)
            ? $insight->content_json
            : json_decode($insight->content_json, true);

        if (!empty($data['blocks'])) {
            foreach ($data['blocks'] as $block) {
                if ($block['type'] !== 'image') {
                    continue;
                }
                $url = $block['data']['file']['url'] ?? null;
                if (!$url) {
                    continue;
                }
                $path = 'insights/' . basename(parse_url($url, PHP_URL_PATH));
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $insight->delete();

        return redirect()->route('insights.index')->with('success', 'Insight deleted successfully.');
    }

    public function showInsights(Request $request)
    {
        $services = Service::withCount(['insights' => fn($q) => $q->where('is_published', true)])
            ->having('insights_count', '>', 0)
            ->get();

        $recentInsights = Insight::where('is_published', true)
            ->select('id', 'title', 'thumbnail', 'slug', 'created_at')
            ->latest()
            ->limit(5)
            ->get();

        $insights = Insight::with(['service', 'author'])
            ->where('is_published', true)
            ->when($request->filled('service'), fn($q) => $q->where('service_id', $request->service))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('insights.insights', compact('insights', 'services', 'recentInsights'));
    }

    public function showInsight($slug)
    {
        $insight = Insight::with(['author', 'service'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $contentJson = $insight->content_json ?? [];

        $toc = collect($contentJson['blocks'] ?? [])
            ->filter(fn($b) => $b['type'] === 'header')
            ->map(fn($b) => [
                'level' => $b['data']['level'],
                'text' => strip_tags($b['data']['text']),
                'anchor' => Str::slug(strip_tags($b['data']['text'])),
            ])
            ->values();

        $relatedInsights = Insight::with(['author', 'service'])
            ->where('is_published', true)
            ->where('service_id', $insight->service_id)
            ->where('id', '!=', $insight->id)
            ->select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'service_id', 'created_at')
            ->latest()
            ->limit(3)
            ->get();

        if ($relatedInsights->count() < 3) {
            $existingIds = $relatedInsights->pluck('id')->push($insight->id);
            $paddingInsights = Insight::with(['author', 'service'])
                ->where('is_published', true)
                ->whereNotIn('id', $existingIds)
                ->select('id', 'title', 'slug', 'excerpt', 'thumbnail', 'service_id', 'created_at')
                ->latest()
                ->limit(3 - $relatedInsights->count())
                ->get();
            $relatedInsights = $relatedInsights->merge($paddingInsights);
        }

        return view('insights.viewInsight', compact('insight', 'contentJson', 'toc', 'relatedInsights'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        $filename = Str::uuid() . '.webp';
        $directory = 'insights/temp';
        $path = $directory . '/' . $filename;

        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory, 0755, true);
        }

        $webpImage = Image::read($request->file('image'))
            ->toWebp(75)
            ->toFilePointer();

        Storage::disk('public')->put($path, $webpImage);

        try {
            TempImage::create([
                'session_id' => session()->getId(),
                'filename' => $filename,
                'path' => $path,
                'url' => Storage::disk('public')->url($path),
            ]);
        } catch (\Throwable $e) {

            Storage::disk('public')->delete($path);

            return response()->json([
                'success' => 0,
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => 1,
            'file' => [
                'url' => Storage::disk('public')->url($path),
                'filename' => $filename,
            ],
        ]);
    }

    public function deleteTempImage(Request $request)
    {
        $request->validate(['filename' => 'required|string']);

        $tempImage = TempImage::where('filename', $request->filename)
            ->where('session_id', session()->getId())
            ->first();

        if (!$tempImage) {
            return response()->json(['success' => false], 404);
        }

        if (Storage::disk('public')->exists($tempImage->path)) {
            Storage::disk('public')->delete($tempImage->path);
        }

        $tempImage->delete();

        return response()->json(['success' => true]);
    }

    private function saveThumbnail($file): string
    {
        $filename = Str::uuid() . '.webp';
        $directory = 'insights/thumbnails';
        $path = $directory . '/' . $filename;

        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory, 0755, true);
        }

        $webpImage = Image::read($file)
            ->cover(1200, 630)
            ->toWebp(80)
            ->toFilePointer();

        Storage::disk('public')->put($path, $webpImage);

        return $path;
    }

    private function promoteTempImages(string $contentJson): array
    {
        $data = json_decode($contentJson, true);

        if (empty($data['blocks'])) {
            return $data;
        }

        foreach ($data['blocks'] as &$block) {
            if ($block['type'] !== 'image') {
                continue;
            }

            $url = $block['data']['file']['url'] ?? null;
            if (!$url || !str_contains($url, '/temp/')) {
                continue;
            }

            $filename = basename(parse_url($url, PHP_URL_PATH));
            $tempPath = 'insights/temp/' . $filename;
            $permPath = 'insights/' . $filename;

            if (Storage::disk('public')->exists($tempPath)) {
                Storage::disk('public')->move($tempPath, $permPath);
                $block['data']['file']['url'] = Storage::disk('public')->url($permPath);
            }

            TempImage::where('filename', $filename)->delete();
        }

        return $data;
    }

    private function cleanupRemovedImages(Insight $insight, array $newData): void
    {
        $oldData = is_array($insight->content_json)
            ? $insight->content_json
            : json_decode($insight->content_json, true);

        $oldImages = [];
        $newImages = [];

        foreach (($oldData['blocks'] ?? []) as $block) {
            if ($block['type'] === 'image' && ($url = $block['data']['file']['url'] ?? null)) {
                $oldImages[] = basename(parse_url($url, PHP_URL_PATH));
            }
        }

        foreach (($newData['blocks'] ?? []) as $block) {
            if ($block['type'] === 'image' && ($url = $block['data']['file']['url'] ?? null)) {
                $newImages[] = basename(parse_url($url, PHP_URL_PATH));
            }
        }

        foreach (array_diff($oldImages, $newImages) as $filename) {
            $path = 'insights/' . $filename;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
