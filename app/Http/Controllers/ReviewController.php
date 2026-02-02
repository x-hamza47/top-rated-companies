<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    public function index()
    {
        if (Gate::allows('admin')) {

            $reviews = Review::with([
                'service:id,name',
                'company' => function ($query) {
                    $query->select('id', 'name', 'slug', 'user_id')
                        ->with(['user' => function ($q) {
                            $q->select('id', 'email');
                        }]);
                }
            ])
                ->latest()
                ->paginate(10);
        } else {

            $reviews = Review::with('service')
                ->where('company_id', Auth::user()->company->id)
                ->latest()
                ->paginate(10);
        }

        return view('dashboard.reviews.list', compact('reviews'));
    }

    public function store(Request $request)
    {
        $company = Company::where('slug', $request->company_slug)->firstOrFail();
        $validated = $request->validate([
            //! Reviewer Details
            'reviewer_name' => 'required|string|max:255',
            'reviewer_email' => 'required|email|max:255',
            'reviewer_location' => 'required|string|max:255',
            'reviewer_company' => 'required|string|max:255',
            'reviewer_company_bio' => 'required|string',
            'reviewer_designation' => 'required|string|max:255',

            //! Service
            'service_id' => 'required|exists:company_services,id',

            //! Review Content
            'review' => 'required|string|max:255',
            'summary' => 'required|string',

            //! Ratings
            'quality' => 'required|numeric|min:1|max:5',
            'ai' => 'required|numeric|min:1|max:5',
            'schedule' => 'required|numeric|min:1|max:5',
            'cost' => 'required|numeric|min:1|max:5',
            'willing_to_refer' => 'required|numeric|min:1|max:5',

            //! Project Details
            'project_title' => 'required|string|max:255',
            'project_size' => 'required|string|max:255',
            'project_duration' => 'required|string|max:255',
            'project_summary' => 'required|string',
        ]);


        $referer = $request->headers->get('referer');
        $source = 'Others';
        if (str_contains($referer, 'TopFirms.com')) $source = 'Topfirms';
        elseif (str_contains($referer, 'google.com')) $source = 'Google Search';

        $overallRating = round((
            $validated['quality'] +
            $validated['ai'] +
            $validated['schedule'] +
            $validated['cost'] +
            $validated['willing_to_refer']
        ) / 5, 1);


        Review::create([
            'company_id' => $company->id,
            'service_id' => $validated['service_id'],
            'reviewer_name' => $validated['reviewer_name'],
            'reviewer_email' => $validated['reviewer_email'],
            'reviewer_location' => $validated['reviewer_location'],
            'reviewer_company' => $validated['reviewer_company'],
            'reviewer_company_bio' => $validated['reviewer_company_bio'],
            'reviewer_designation' => $validated['reviewer_designation'],
            'review' => $validated['review'],
            'summary' => $validated['summary'],
            'rating' => $overallRating,
            'quality' => $validated['quality'],
            'ai' => $validated['ai'],
            'schedule' => $validated['schedule'],
            'cost' => $validated['cost'],
            'willing_to_refer' => $validated['willing_to_refer'],
            'project_title' => $validated['project_title'],
            'project_size' => $validated['project_size'],
            'project_duration' => $validated['project_duration'],
            'project_summary' => $validated['project_summary'],
            'source' => $source,
            'reference' => $referer,
            'status' => 'unlisted',
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
    public function destroy(Review $review)
    {
        if (Gate::denies('admin') && Gate::denies('company')) {
            abort(403);
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
