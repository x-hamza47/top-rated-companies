<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;  // Import this at the top
use Faker\Factory as Faker;  // You may need to import Faker if you're using it
use Illuminate\Support\Collection;

class ViewController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function listicle(Request $request)
    {
        $totalCompanies = 87; // pretend we have 87 companies
        $perPage = 10;

        $faker = Faker::create();  // Create a Faker instance

        $companies = collect(range(1, $totalCompanies))->map(function ($i) use ($faker) {
            return [
                'id' => $i,
                'name' => "Company {$i} Ltd",
                'logo' => "https://picsum.photos/360/360?random=" . mt_rand(1, 9999),
                'rating' => number_format(mt_rand(42, 50) / 10, 1), // 4.2 – 5.0
                'reviews' => mt_rand(20, 300),
                'min_project' => '$' . ['5,000', '10,000', '25,000', '50,000+'][array_rand(['5,000', '10,000', '25,000', '50,000+'])],
                'hourly_rate' => '$' . ['25-$49', '50-$99', '100-$149', '150-$199'][array_rand(['25-$49', '50-$99', '100-$149', '150-$199'])],
                'employees' => ['10 - 49', '50 - 249', '250 - 999', '1,000+'][array_rand(['10 - 49', '50 - 249', '250 - 999', '1,000+'])],
                'location' => $faker->city . ', ' . $faker->stateAbbr,
                'description' => $faker->paragraphs(3, true),
            ];
        });

        // Manual pagination (exactly how Eloquent does it)
        $currentPage = LengthAwarePaginator::resolveCurrentPage() ?: 1;
        $items = $companies->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator(
            $items,
            $companies->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'pageName' => 'page',
            ]
        );

        return view('listicle', compact('paginated'));
    }

    public function plans(){
        return view('plan');
    }

    public function check(){
        return "Checking";
    }
}
