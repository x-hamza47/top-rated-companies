<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Company;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class CompanyController extends Controller
{
    public function index()
    { // ! Companies with specific Columns
        $companies = Company::with([
            'details:id,company_id,hourly_rate_min,hourly_rate_max,employees_min,employees_max,locations',
            'services:id,name'
        ])
            ->select('id', 'logo', 'verified', 'name', 'tagline', 'created_at')
            ->withCount('services')
            ->paginate(10);

        return view("dashboard.company.list", compact('companies'));
    }

    public function edit(Company $company)
    {
        $categories = Category::all();
        $company->load(['details', 'services']);
        $allServices = Service::all();
        return view('dashboard.company.edit', compact('company', 'categories', 'allServices'));
    }

    public function updateOrCreate(?int $id, CompanyRequest $request)
    {
        $user = Auth::user();

        if (Gate::allows('admin')) {
            if (!$id) {
                abort(403, "Admin cannot create a company.");
            }
            $company = Company::findOrFail($id);
        } elseif (Gate::allows('company')) {
            $company = $id ? Company::where('id', $id)->where('user_id', $user->id)->firstOrFail()
                : Company::firstOrCreate(['user_id' => $user->id]);
        } else {
            abort(403, 'You are not authorized.');
        }
        // ! Company Basic Info
        $company->update($request->only(['name', 'slug', 'tagline', 'about']));

        // ! Company Details
        $company->details()->updateOrCreate(
            ['company_id' => $company->id],
            $request->only([
                'min_project_size',
                'hourly_rate_min',
                'hourly_rate_max',
                'employees_min',
                'employees_max',
                'locations',
                'founded',
                'languages',
                'website',
                'social_links'
            ])
        );

        $services = $request->services ?? [];
        $syncData = [];
        foreach ($services as $serviceId => $expertise) {
            $syncData[$serviceId] = ['expertise_percentage' => $expertise];
        }
        $company->services()->sync($syncData);

        return redirect()->back()->with('success', 'Company updated successfully.');
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
            $directory = 'uploads/companies-logo';

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
