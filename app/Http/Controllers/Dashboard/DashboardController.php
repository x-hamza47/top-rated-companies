<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyVisitSummary;
use App\Models\ContactUs;
use App\Models\Inquiry;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin')) {
            return $this->adminDashboard();
        }

        if (Gate::allows('company')) {
            return $this->companyDashboard();
        }

        abort(403);
    }

    private function adminDashboard()
    {
        // ! Companies
        $totalCompanies = Company::count();
        $verifiedCompanies = Company::where('verified', true)->count();
        $listedCompanies = Company::where('is_listed', true)->count();

        // ! Users
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $companyUsers = User::where('role', 'company')->count();
        $regularUsers = User::where('role', 'user')->count();

        // ! Reviews
        $totalReviews = Review::count();
        $pendingReviews = Review::where('status', 'unlisted')->count();

        // ! Inquiries
        $totalInquiries = Inquiry::count();
        $pendingInquiries = Inquiry::where('status', 'pending')->count();

        // ! Contact Us
        $totalContacts = ContactUs::count();
        $pendingContacts = ContactUs::where('status', 'pending')->count();

        // ! New registrations last 30 days (for area chart)
        $registrations = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $registrationDates = [];
        $registrationCounts = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $registrationDates[] = now()->subDays($i)->format('M d');
            $registrationCounts[] = $registrations[$date] ?? 0;
        }

        // ! Reviews by rating (for bar chart)
        $reviewsByRating = Review::selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('count', 'rating');

        $ratingLabels = ['1★', '2★', '3★', '4★', '5★'];
        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[] = $reviewsByRating[$i] ?? 0;
        }
        // ! Platform Views last 30 days (from CompanyVisitSummary)
        $platformViews = CompanyVisitSummary::selectRaw('date, SUM(total_visits) as total')
            ->where('date', '>=', now()->subDays(29)->toDateString())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $platformViewDates = [];
        $platformViewCounts = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $platformViewDates[] = now()->subDays($i)->format('M d');
            $platformViewCounts[] = (int) ($platformViews[$date] ?? 0);
        }

        // ! Total & today platform views (for KPI card)
        $totalPlatformViews = CompanyVisitSummary::sum('total_visits');
        $todayPlatformViews = CompanyVisitSummary::whereDate('date', now()->toDateString())
            ->sum('total_visits');

        // ! Traffic by hour (merge all companies)
        $allSummaries = CompanyVisitSummary::all();

        $hourTotals = array_fill(0, 24, 0);
        foreach ($allSummaries as $summary) {
            if ($summary->hours) {
                foreach ($summary->hours as $hour => $count) {
                    $hourTotals[(int) $hour] += $count;
                }
            }
        }
        $hourLabels = array_map(fn ($h) => str_pad($h, 2, '0', STR_PAD_LEFT).':00', range(0, 23));
        $hourCounts = array_values($hourTotals);

        // ! Top 10 companies by views
        $topCompanies = CompanyVisitSummary::selectRaw('company_id, SUM(total_visits) as total')
            ->groupBy('company_id')
            ->orderByDesc('total')
            ->limit(10)
            ->with('company:id,name')
            ->get();

        $topCompanyLabels = $topCompanies->map(fn ($r) => $r->company->name ?? 'Unknown')->toArray();
        $topCompanyCounts = $topCompanies->map(fn ($r) => (int) $r->total)->toArray();

        return view('dashboard.dashboard.admin', compact(
            'platformViewDates', 'platformViewCounts',
            'totalPlatformViews', 'todayPlatformViews',
            'hourLabels', 'hourCounts',
            'topCompanyLabels', 'topCompanyCounts',
            'totalCompanies', 'verifiedCompanies', 'listedCompanies',
            'totalUsers', 'adminUsers', 'companyUsers', 'regularUsers',
            'totalReviews', 'pendingReviews',
            'totalInquiries', 'pendingInquiries',
            'totalContacts', 'pendingContacts',
            'registrationDates', 'registrationCounts',
            'ratingLabels', 'ratingCounts'
        ));
    }

    private function companyDashboard()
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();

        // No company linked yet
        if (! $company) {
            return view('dashboard.dashboard.company', ['company' => null]);
        }

        // ! Views (from summaries table)
        $totalViews = CompanyVisitSummary::where('company_id', $company->id)->sum('total_visits');
        $todayViews = CompanyVisitSummary::where('company_id', $company->id)
            ->whereDate('date', now()->toDateString())
            ->value('total_visits') ?? 0;

        // ! Inquiries
        $totalInquiries = Inquiry::where('company_id', $company->id)->count();
        $pendingInquiries = Inquiry::where('company_id', $company->id)->where('status', 'pending')->count();

        // ! Reviews
        $totalReviews = Review::where('company_id', $company->id)->count();
        $averageRating = Review::where('company_id', $company->id)->avg('rating');
        $averageRating = $averageRating ? round($averageRating, 1) : 0;

        // ! Last 30 days views for area chart
        $summaries = CompanyVisitSummary::where('company_id', $company->id)
            ->where('date', '>=', now()->subDays(29)->toDateString())
            ->orderBy('date')
            ->pluck('total_visits', 'date');

        $viewDates = [];
        $viewCounts = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $viewDates[] = now()->subDays($i)->format('M d');
            $viewCounts[] = $summaries[$date] ?? 0;
        }

        // ! Hours breakdown for bar chart (merge all summaries)
        $allSummaries = CompanyVisitSummary::where('company_id', $company->id)->get();

        $hourTotals = array_fill(0, 24, 0);
        foreach ($allSummaries as $summary) {
            if ($summary->hours) {
                foreach ($summary->hours as $hour => $count) {
                    $hourTotals[(int) $hour] += $count;
                }
            }
        }
        $hourLabels = array_map(fn ($h) => str_pad($h, 2, '0', STR_PAD_LEFT).':00', range(0, 23));
        $hourCounts = array_values($hourTotals);

        // ! Devices breakdown for donut chart
        $deviceTotals = [];
        foreach ($allSummaries as $summary) {
            if ($summary->devices) {
                foreach ($summary->devices as $device => $count) {
                    $deviceTotals[$device] = ($deviceTotals[$device] ?? 0) + $count;
                }
            }
        }
        $deviceLabels = array_keys($deviceTotals);
        $deviceCounts = array_values($deviceTotals);

        return view('dashboard.dashboard.company', compact(
            'company',
            'totalViews', 'todayViews',
            'totalInquiries', 'pendingInquiries',
            'totalReviews', 'averageRating',
            'viewDates', 'viewCounts',
            'hourLabels', 'hourCounts',
            'deviceLabels', 'deviceCounts'
        ));
    }
}
