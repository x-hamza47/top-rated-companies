<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function showForm($companySlug)
    {
        $company = Company::select('id', 'name', 'slug')
            ->with(['services'])
            ->where('slug', $companySlug)
            ->firstOrFail();
        return view('review.review', compact('company'));
    }
}
