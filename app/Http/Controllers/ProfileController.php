<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($companySlug)
    {
        $company = Company::with(['details', 'services'])
            ->where('slug', $companySlug)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->firstOrFail();

        $reviews = $company->reviews()
            ->with('service.category')
            ->where('status', 'verified')
            ->latest()
            ->paginate(5);

        return view('profile.index', compact('company', 'reviews'));
    }

    public function projectSizes(Company $company, Request $request)
    {
        $serviceId = $request->query('service');
        if ($serviceId === 'all') {
            $sizes = $company->reviews
                ->pluck('project_size')
                ->map(fn($v) => (int) str_replace(['$', ','], '', $v));
        } else {
            $sizes = $company->reviews()
                ->where('service_id', $serviceId)
                ->pluck('project_size')
                ->map(fn($v) => (int) str_replace(['$', ','], '', $v));
        }

        $min = $sizes->min();
        $max = $sizes->max();
        $count = $sizes->count();

        return response()->json([
            'min' => $min,
            'max' => $max,
            'count' => $count,
        ]);
    }

    public function packages($companySlug)
    {
        $company = Company::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('slug', $companySlug)
            ->firstOrFail();

        $service = Service::whereHas('packages', function ($q) use ($company) {
            $q->where('company_id', $company->id);
        })->inRandomOrder()->first();

        if ($service) {
            $service->load(['packages' => function ($q) use ($company) {
                $q->where('company_id', $company->id)
                    ->with('features');
            }]);
        }

        $allServices = Service::whereHas('packages', function ($q) use ($company) {
            $q->where('company_id', $company->id);
        })->get();

        return view('plan', compact('company', 'service', 'allServices'));
    }


    public function getServicePackages(Company $company, Service $service)
    {
        if (!$company->services()->where('services.id', $service->id)->exists()) {
            abort(403);
        }

        $packages = $service->packages()
            ->where('company_id', $company->id)
            ->with('features')
            ->get();

        return response()->json([
            'packages' => $packages->map(function ($pkg) {
                return [
                    'id'          => $pkg->id,
                    'small_price' => $pkg->small_price,
                    'medium_price' => $pkg->medium_price,
                    'large_price' => $pkg->large_price,
                    'price_type'  => $pkg->price_type,
                    'small_description'  => $pkg->small_description,
                    'medium_description' => $pkg->medium_description,
                    'large_description'  => $pkg->large_description,
                    'features' => $pkg->features->map(function ($f) {
                        return [
                            'feature'     => $f->feature,
                            'type'        => $f->type,
                            'small_value' => $f->small_value,
                            'medium_value' => $f->medium_value,
                            'large_value' => $f->large_value,
                        ];
                    })->toArray(),
                ];
            })->toArray(),
        ]);
    }
}
