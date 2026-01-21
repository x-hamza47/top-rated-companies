<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
        // $company = Company::with([
        //     'services' => function ($q) {
        //         $q->whereHas('packages');
        //     },
        //     'packages.features' 
        // ])
        // ->where('slug', $companySlug)
        // ->withCount('reviews')
        // ->withAvg('reviews', 'rating')
        // ->firstOrFail();

        $company = Company::with('packages.features')
        ->where('slug', $companySlug)
        ->firstOrFail();
    dd($company);

        return view('plan', compact('company'));
    }
}
