<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index($serviceSlug)
    {
        $service = Service::with([
            'category',
        ])->where('slug', $serviceSlug)->firstOrFail();

        $companies = $service->companies()
            ->with([
            'services', 
            'details:id,company_id,min_project_size,hourly_rate_min,hourly_rate_max,employees_min,employees_max,locations,website'
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')->paginate(10);


        $relatedServices = $service->category
            ->services()
            ->where('id', '!=', $service->id)
            ->take(7)
            ->get();

        return view('listicle.listicle', compact('service', 'companies', 'relatedServices'));

    }
}
