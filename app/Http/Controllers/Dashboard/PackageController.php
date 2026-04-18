<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Company;
use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PackageController extends Controller
{

    public function packagePage($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $packages = Package::select(
            'id',
            'company_id',
            'service_id',
            'small_price'
        )
            ->with([
                'features:id,package_id,feature,type,small_value',

                'company' => function ($q) {
                    $q->select('id', 'name', 'slug', 'logo', 'verified')
                        ->with('details:id,company_id,locations')
                        ->withCount('reviews')
                        ->withAvg('reviews', 'rating');
                }
            ])
            ->where('service_id', $service->id)
            ->latest()
            ->paginate(10);

        return view("packages.list", compact('packages', 'service'));
    }

    public function index()
    {
        $user = Auth::user();

        $packages = null;
        $packageCount = null;

        if (Gate::allows('admin')) {
            $packages = Company::has('packages')
                ->withCount('packages')
                ->with([
                    'user:id,email',
                    'packages.service'
                ])
                ->paginate(10);
        } else if (Gate::allows('company')) {
            $packages = Package::with('service')
                ->where('company_id', $user->company->id)
                ->get();

            $packageCount = $packages->count();
        } else {
            abort(403);
        }

        return view('dashboard.packages.list', compact('packages', 'packageCount'));
    }

    public function create()
    {
        Gate::authorize('company');
        $company = Auth::user()->company;

        $services = $company->services()
            ->whereDoesntHave('packages', function ($q) use ($company) {
                $q->where('company_id', $company->id);
            })
            ->orderBy('services.name')
            ->pluck('services.name', 'services.id');

        return view('dashboard.packages.create', compact('services'));
    }

    public function store(Request $request)
    {
        $company = Auth::user()->company;

        if ($company->packages()->count() >= 5) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['package_limit' => 'You cannot create more than 5 packages.']);
        }
        $validated = $request->validate([
            'service_id'   =>  [
                'required',
                Rule::exists('company_services', 'service_id')
                    ->where('company_id', Auth::user()->company->id)
            ],
            'price_type'   => 'required|in:total,monthly',
            'description'  => 'nullable|string',
            'small_price'  => 'required|numeric|min:0',
            'medium_price' => 'required|numeric|min:0',
            'large_price'  => 'required|numeric|min:0',
            'features'     => 'required|array|min:1',
            'features.*.feature'      => 'required|string|max:255',
            'features.*.type'         => 'required|in:text,checkbox',
            'features.*.small_value'  => 'required_if:features.*.type,text|string|max:255|nullable',
            'features.*.medium_value' => 'required_if:features.*.type,text|string|max:255|nullable',
            'features.*.large_value'  => 'required_if:features.*.type,text|string|max:255|nullable',
        ], [
            // Custom messages
            'features.*.small_value.required_if'  => 'The Small Tier value field is required.',
            'features.*.medium_value.required_if' => 'The Medium Tier value field is required.',
            'features.*.large_value.required_if'  => 'The Large Tier value field is required.',
        ], [
            // Attribute names (optional)
            'features.*.feature' => 'Feature Name',
        ]);
        $company = Auth::user()->company;

        $package = $company->packages()->create([
            'service_id'  => $validated['service_id'],
            'price_type'  => $validated['price_type'],
            'description' => $validated['description'] ?? null,
            'small_price' => $validated['small_price'],
            'medium_price' => $validated['medium_price'],
            'large_price' => $validated['large_price'],
        ]);

        foreach ($validated['features'] as $feature) {
            $package->features()->create([
                'feature'      => $feature['feature'],
                'type'         => $feature['type'],
                'small_value'  => $feature['type'] === 'checkbox' ? ($feature['small_value'] ?? 0) : $feature['small_value'],
                'medium_value' => $feature['type'] === 'checkbox' ? ($feature['medium_value'] ?? 0) : $feature['medium_value'],
                'large_value'  => $feature['type'] === 'checkbox' ? ($feature['large_value'] ?? 0) : $feature['large_value'],
            ]);
        }

        return redirect()->route('packages.index')->with('success', 'Package created successfully!');
    }

    public function edit(Package $package)
    {
        Gate::authorize('company');

        $company = Auth::user()->company;

        abort_if($package->company_id !== $company->id, 403);

        $services = $company->services()
            ->whereDoesntHave('packages', function ($q) use ($company, $package) {
                $q->where('company_id', $company->id)
                    ->where('id', '!=', $package->id);
            })
            ->orderBy('services.name')
            ->pluck('services.name', 'services.id');

        $package->load('features');

        return view('dashboard.packages.edit', compact('package', 'services'));
    }

    public function update(Request $request, Package $package)
    {
        Gate::authorize('company');

        $company = Auth::user()->company;

        abort_if($package->company_id !== $company->id, 403);

        $validated = $request->validate([
            'service_id' => [
                'required',
                Rule::exists('company_services', 'service_id')
                    ->where('company_id', $company->id),
            ],
            'price_type'   => 'required|in:total,monthly',
            'description'  => 'nullable|string',
            'small_price'  => 'required|numeric|min:0',
            'medium_price' => 'required|numeric|min:0',
            'large_price'  => 'required|numeric|min:0',

            'features'     => 'required|array|min:1',
            'features.*.feature'      => 'required|string|max:255',
            'features.*.type'         => 'required|in:text,checkbox',
            'features.*.small_value'  => 'required_if:features.*.type,text|nullable|string|max:255',
            'features.*.medium_value' => 'required_if:features.*.type,text|nullable|string|max:255',
            'features.*.large_value'  => 'required_if:features.*.type,text|nullable|string|max:255',
        ], [
            'features.*.small_value.required_if'  => 'The Small Tier value field is required.',
            'features.*.medium_value.required_if' => 'The Medium Tier value field is required.',
            'features.*.large_value.required_if'  => 'The Large Tier value field is required.',
        ]);

        // Update package
        $package->update([
            'service_id'   => $validated['service_id'],
            'price_type'   => $validated['price_type'],
            'description'  => $validated['description'] ?? null,
            'small_price'  => $validated['small_price'],
            'medium_price' => $validated['medium_price'],
            'large_price'  => $validated['large_price'],
        ]);

        // 🔥 Reset features (safe + clean)
        $package->features()->delete();

        foreach ($validated['features'] as $feature) {
            $package->features()->create([
                'feature'      => $feature['feature'],
                'type'         => $feature['type'],
                'small_value'  => $feature['type'] === 'checkbox'
                    ? ($feature['small_value'] ?? 0)
                    : $feature['small_value'],
                'medium_value' => $feature['type'] === 'checkbox'
                    ? ($feature['medium_value'] ?? 0)
                    : $feature['medium_value'],
                'large_value'  => $feature['type'] === 'checkbox'
                    ? ($feature['large_value'] ?? 0)
                    : $feature['large_value'],
            ]);
        }

        return redirect()
            ->route('packages.index')
            ->with('success', 'Package updated successfully!');
    }

    public function destroy(Package $package)
    {
        Gate::authorize('company');

        if ($package->company_id !== Auth::user()->company->id) {
            abort(403, 'You do not own this package.');
        }

        $package->delete();

        return redirect()
            ->route('packages.index')
            ->with('success', 'Package has been moved to trash.');
    }
}
