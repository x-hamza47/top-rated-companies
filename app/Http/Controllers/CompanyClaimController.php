<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyClaimRequest;
use App\Models\User;
use App\Notifications\CompanyClaimRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CompanyClaimController extends Controller
{
    public function create($company)
    {

        $company = Company::select('id', 'name', 'slug', 'logo', 'user_id')
            ->findOrFail($company);

        if ($company->user_id !== null) {
            abort(403, 'Company already claimed.');
        }

        return view('profile.claim.claim-profile', compact('company'));
    }

    public function store(Request $request, $companyId)
    {
        $company = Company::findOrFail($companyId);

        if ($company->user_id !== null) {
            return redirect()->back()->with('error', 'Company already claimed.');
        }
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'company_email' => 'required|email|max:100',
            'job_title' => 'nullable|string|max:100',
        ]);

        $emailDomain = substr(strrchr($request->company_email, "@"), 1);

        $companyDomain = parse_url($company->details->website, PHP_URL_HOST);

        $companyDomain = preg_replace('/^www\./', '', $companyDomain);

        if (strtolower($emailDomain) !== strtolower($companyDomain)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please use your corporate email to claim this company.');
        }

        $existingClaim = CompanyClaimRequest::where('company_id', $company->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingClaim) {
            return redirect()->back()
                ->with('error', 'You have already submitted a claim request for this company.');
        }
        // ! Claim Request
        $claim = CompanyClaimRequest::create([
            'company_id' => $company->id,
            'user_id' => Auth::id(),
            'submitted_name' => $request->first_name . ' ' . $request->last_name,
            'submitted_email' => $request->company_email,
            'job_title' => $request->job_title,
            'status' => 'pending',
        ]);

        $admins = User::where('role', 'admin')
        
            ->where('email', '!=', 'amypohwani97@gmail.com')
            ->get();
        Notification::send($admins, new CompanyClaimRequestNotification($claim));
        return redirect()->route('profile.index', $company->slug)
            ->with('success', 'Claim request submitted. Admin will verify and approve.');
    }
}
