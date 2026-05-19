<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class AuthorController extends Controller
{
       /**
     * Display a listing of authors.
     */
    public function index()
    {
        $authors = Author::latest()->paginate(15);
 
        return view('dashboard.authors.list', compact('authors'));
    }
 
    /**
     * Show the form for creating a new author.
     */
    public function create()
    {
        return view('dashboard.authors.create-update');
    }
 
    /**
     * Store a newly created author in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:authors,slug',
            'designation'  => 'nullable|string|max:255',
            'company'      => 'nullable|string|max:255',
            'bio'          => 'nullable|string|max:300',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url'  => 'nullable|url|max:255',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active'    => 'nullable|boolean',
        ]);
 
        $validated['is_active'] = $request->boolean('is_active');
 
        if ($request->hasFile('image')) {
            $validated['image'] = $this->saveAvatar($request->file('image'));
        } else {
            unset($validated['image']);
        }
 
        Author::create($validated);
 
        return redirect()
            ->route('authors.index')
            ->with('success', 'Author created successfully.');
    }
 
    /**
     * Show the form for editing the specified author.
     */
    public function edit(Author $author)
    {
        return view('dashboard.authors.create-update', compact('author'));
    }
 
    /**
     * Update the specified author in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:authors,slug,' . $author->id,
            'designation'  => 'nullable|string|max:255',
            'company'      => 'nullable|string|max:255',
            'bio'          => 'nullable|string|max:300',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url'  => 'nullable|url|max:255',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_active'    => 'nullable|boolean',
        ]);
 
        $validated['is_active'] = $request->boolean('is_active');
 
        if ($request->hasFile('image')) {
            if ($author->image && Storage::disk('public')->exists($author->image)) {
                Storage::disk('public')->delete($author->image);
            }
            $validated['image'] = $this->saveAvatar($request->file('image'));
        } else {
            unset($validated['image']);
        }
 
        $author->update($validated);
 
        return redirect()
            ->route('authors.index')
            ->with('success', 'Author updated successfully.');
    }
 
    /**
     * Remove the specified author from storage.
     */
    public function destroy(Author $author)
    {
        if ($author->image && Storage::disk('public')->exists($author->image)) {
            Storage::disk('public')->delete($author->image);
        }
 
        $author->delete();
 
        return redirect()
            ->route('authors.index')
            ->with('success', 'Author deleted successfully.');
    }
 
    /**
     * Save avatar image as WebP, cropped to square.
     */
    private function saveAvatar($file): string
    {
        $filename  = Str::uuid() . '.webp';
        $directory = 'authors';
        $path      = $directory . '/' . $filename;
 
        if (! Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory, 0755, true);
        }
 
        $webpImage = Image::read($file)
            ->cover(400, 400)
            ->toWebp(80)
            ->toFilePointer();
 
        Storage::disk('public')->put($path, $webpImage);
 
        return $path;
    }
}
