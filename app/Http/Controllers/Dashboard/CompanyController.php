<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::with([
            'details:id,company_id,hourly_rate,employees_range,is_freelancer,locations',
            'services:id,name'
        ])
            ->select('id', 'logo', 'verified', 'is_listed', 'name', 'tagline', 'created_at')
            ->withCount('services');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas(
                        'details',
                        fn($d) =>
                        $d->where('locations', 'LIKE', '%' . $request->search . '%')
                    );
            });
        }

        if ($request->filled('verified')) {
            $query->where('verified', $request->verified);
        }

        if ($request->filled('is_listed')) {
            $query->where('is_listed', $request->is_listed);
        }

        $companies = $query->latest()->paginate(25)->withQueryString();

        return view("dashboard.company.list", compact('companies'));
    }

    public function toggleListed(Company $company)
    {
        Gate::authorize('admin');

        $company->update(["is_listed" => !$company->is_listed]);
        return response()->json([
            'success' => true,
            'is_listed' => $company->is_listed,
        ]);
    }
    public function toggleVerified(Company $company)
    {
        Gate::authorize('admin');
        $company->update(['verified' => !$company->verified]);
        return response()->json([
            'success' => true,
            'verified' => $company->verified,
        ]);
    }
    public function editOrCreate(?Company $company = null)
    {
        $categories = Category::all();
        $allServices = Service::all();

        if ($company) {
            $company->load(['details', 'services' => function($query) {
            $query->withPivot('description');
        }]);
        } else {
            $company = new Company();
        }

        return view('dashboard.company.edit', compact('company', 'categories', 'allServices'));
    }

    public function updateOrCreate(CompanyRequest $request, ?int $id = null)
    {
        dd(Gate::allows('admin'), Gate::allows('company'), Auth::user()->role);
        $user = Auth::user();

        if (Gate::allows('admin')) {
            $company = $id ? Company::findOrFail($id) : new Company();
        } elseif (Gate::allows('company')) {
            $company = $id
                ? Company::where('id', $id)->where('user_id', $user->id)->firstOrFail()
                : Company::firstOrCreate(['user_id' => $user->id]);
        } else {
            abort(403, 'You are not authorized.');
        }

        DB::transaction(function () use ($company, $request) {

            // ! Basic Info
            $company->fill($request->only(['name', 'slug', 'tagline', 'about']));
            $company->save();

            // ! Details
            $company->details()->updateOrCreate(
                ['company_id' => $company->id],
                [
                    'min_project_size' => $request->min_project_size,
                    'hourly_rate' => $request->hourly_rate,
                    'employees_range' => $request->is_freelancer ? null : $request->employees_range,
                    'is_freelancer' => $request->is_freelancer ?? false,
                    'locations' => $request->locations,
                    'founded' => $request->founded,
                    'languages' => $request->languages,
                    'website' => $request->website,
                    'social_links' => $request->social_links,
                ]
            );

            // ! Services
            $syncData = [];
            foreach ($request->services ?? [] as $serviceId => $data) {
                $syncData[$serviceId] = [
                    'expertise_percentage' => is_array($data) ? $data['expertise_percentage'] : $data,
                    'description' => is_array($data) ? ($data['description'] ?? null) : null,
                ];
            }
            $company->services()->sync($syncData);

            // ! Logo — only uploaded after DB succeeds
            if ($request->hasFile('logo')) {
                if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                    Storage::disk('public')->delete($company->logo);
                }

                $filename = Str::uuid() . '.webp';
                $directory = 'uploads/company-logo';
                $path = $directory . '/' . $filename;

                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory, 0755, true);
                }

                Image::read($request->file('logo'))
                    ->cover(300, 300)
                    ->toWebp(80)
                    ->save(Storage::disk('public')->path($path));

                $company->logo = $path;
                $company->save();
            }
        });

        return redirect()->route('companies.index')->with('success', 'Company saved successfully.');
    }

    public function uploadLogo(Request $request, Company $company)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            $filename = Str::uuid() . "." . $request->file('logo')->extension();
            $directory = 'uploads/company-logo';

            $path = $directory . "/" . $filename;

            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory, 0755, true);
            }

            Image::read($request->file('logo'))
                ->cover(300, 300)
                ->save(Storage::disk('public')->path($path));

            $company->update(['logo' => $path]);
            return back()->with('success', 'Company logo updated successfully!');
        }
    }


    public function destroy(Company $company)
    {
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        return redirect()->back()->with('success', "Company delete successfully");
    }
}
