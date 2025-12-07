<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($company)
    {
        $company = Company::where('name', $company)->first();

        $reviews = $company->reviews()->paginate(5);
        return view('profile', compact('company', 'reviews'));
    }
    public function projectSizes(Company $company, Request $request)
    {
        $serviceId = $request->query('service');
        if ($serviceId === 'all') {
            $sizes = $company->reviews
                ->pluck('projectSize')
                ->map(fn($v) => (int) str_replace(['$', ','], '', $v));
        } else {
            $sizes = $company->reviews()
                ->where('service_id', $serviceId)
                ->pluck('projectSize')
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
}
