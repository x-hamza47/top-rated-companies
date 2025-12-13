<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($companySlug)
    {
        $company = Company::with(
            ['details', 'services']
        )->where('slug', $companySlug)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->firstOrFail();

        $reviews = $company->reviews()->paginate(5);

        return view('profile.index', compact('company','reviews'));
    }
    
}
