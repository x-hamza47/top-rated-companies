<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;  // Import this at the top
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function service(Request $request, $category, $service)
    {

        // $totalCompanies = 87; // pretend we have 87 companies
        // $perPage = 10;

        // $faker = Faker::create();  // Create a Faker instance

        // $companies = collect(range(1, $totalCompanies))->map(function ($i) use ($faker) {
        //     return [
        //         'id' => $i,
        //         'name' => "Company {$i} Ltd",
        //         'logo' => "https://picsum.photos/360/360?random=" . mt_rand(1, 9999),
        //         'rating' => number_format(mt_rand(42, 50) / 10, 1), // 4.2 – 5.0
        //         'reviews' => mt_rand(20, 300),
        //         'min_project' => '$' . ['5,000', '10,000', '25,000', '50,000+'][array_rand(['5,000', '10,000', '25,000', '50,000+'])],
        //         'hourly_rate' => '$' . ['25-$49', '50-$99', '100-$149', '150-$199'][array_rand(['25-$49', '50-$99', '100-$149', '150-$199'])],
        //         'employees' => ['10 - 49', '50 - 249', '250 - 999', '1,000+'][array_rand(['10 - 49', '50 - 249', '250 - 999', '1,000+'])],
        //         'location' => $faker->city . ', ' . $faker->stateAbbr,
        //         'description' => $faker->paragraphs(3, true),
        //     ];
        // });

        // // Manual pagination (exactly how Eloquent does it)
        // $currentPage = LengthAwarePaginator::resolveCurrentPage() ?: 1;
        // $items = $companies->slice(($currentPage - 1) * $perPage, $perPage)->values();

        // $paginated = new LengthAwarePaginator(
        //     $items,
        //     $companies->count(),
        //     $perPage,
        //     $currentPage,
        //     [
        //         'path' => $request->url(),
        //         'pageName' => 'page',
        //     ]
        // );

        // return view('listicle', compact('paginated'));

        // $companies = Company::all();
        // Format category inline

        $category = collect(explode(' ', str_replace('-', ' & ', $category)))
            ->map(fn($w) => strlen($w) <= 2 ? strtoupper($w) : ucfirst(strtolower($w)))
            ->implode(' ');

        // Format service name (handle cases like ai/ml → AI/ML, seo → SEO)
        $w = explode('-', $service);
        $service = count($w) === 1
            ? strtoupper($service)
            : (count($w) === 2 && strlen($w[0]) === 2 && strlen($w[1]) === 2
                ? strtoupper(str_replace('-', '/', $service))
                : Str::title(str_replace('-', ' ', $service)));

        // Find the service with its category
        $serviceModel = Service::where('service', $service)
            ->whereHas('category', fn($q) => $q->where('category', $category))
            ->first();

        // if (!$serviceModel) {
        //     return redirect()->route('home')->with('error', 'Service not found');
        // }
        $relatedServices = Service::whereHas('category', fn($q) => $q->where('category', $category))
            ->get(); // This will return all services in the same category
        // THIS IS THE KEY: Use the relationship directly!
        $companies = $serviceModel->companies()
            ->withPivot('percentage')        // if you want to show percentage
            ->with('category', 'industry')   // optional: eager load other relations
            ->paginate(4);                   // Laravel handles everything!

        // Optional: Append query parameters (like ?sort=price) to pagination links
        $companies->appends($request->query());


        return view('listicle', compact('serviceModel', 'companies', 'relatedServices', 'service'));
    }
}
