<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request, $serviceSlug)
    {
        $service = Service::with('category')
            ->where('slug', $serviceSlug)
            ->firstOrFail();

        $serviceFaqs = $service->faqs;
        $companiesQuery = $service->companies()
            ->with([
                'services',
                'details:id,company_id,min_project_size,hourly_rate,employees_range,is_freelancer,locations,website'
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating');

        // ------------------------
        // Filter by location
        // ------------------------
        if ($request->filled('location')) {
            $companiesQuery->whereHas('details', function ($q) use ($request) {
                $q->where('locations', 'LIKE', '%' . trim($request->location) . '%');
            });
        }

        // ------------------------
        // Filter by budget
        // ------------------------
        if ($request->filled('budget')) {
            $companiesQuery->whereHas('details', function ($q) use ($request) {
                switch ($request->budget) {
                    case '50k':
                        $q->where('min_project_size', '<', 50000);
                        break;
                    case '100k':
                        $q->whereBetween('min_project_size', [50000, 100000]);
                        break;
                    case '100k+':
                        $q->where('min_project_size', '>', 100000);
                        break;
                }
            });
        }

        // ------------------------
        // Filter by hourly rate
        // ------------------------
        if ($request->filled('hourly')) {
            $companiesQuery->whereHas('details', function ($q) use ($request) {
                $q->where('hourly_rate', $request->hourly);
            });
        }

        // ------------------------
        // Filter by industries
        // ------------------------
        if ($request->filled('industries')) {
            $companiesQuery->whereIn('industry', $request->industries);
        }

        // ------------------------
        // Filter by services
        // ------------------------
        if ($request->filled('services')) {
            $companiesQuery->whereHas('services', function ($q) use ($request) {
                $q->whereIn('name', $request->services);
            });
        }

        // ------------------------
        // Pagination
        // ------------------------
        $companies = $companiesQuery->paginate(10)->withQueryString();

        // ------------------------
        // Related services
        // ------------------------
        $relatedServices = $service->category
            ->services()
            ->where('id', '!=', $service->id)
            ->take(7)
            ->get();

        return view('listicle.listicle', compact('service', 'companies', 'relatedServices', 'serviceFaqs'));
    }
}
