<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyClaimRequest;
use Illuminate\Support\Facades\DB;


class CompanyClaimRequestController extends Controller
{
    public function index()
    {
        $claims = CompanyClaimRequest::with(['company', 'user'])
            ->latest()->paginate(10);

        return view('dashboard.claims.list', compact('claims'));
    }
    public function approve($id)
    {
        $claim = CompanyClaimRequest::with('company')->findOrFail($id);

        if ($claim->status !== 'pending') {
            return response()->json(['error' => 'Already processed'], 400);
        }

        $company = $claim->company;

        DB::transaction(function () use ($claim, $company) {
            $claim->update(['status' => 'approved']);
            $company->update(['user_id' => $claim->user_id]);
            
            CompanyClaimRequest::where('company_id', $company->id)
                ->where('id', '!=', $claim->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);
        });

        return response()->json(['success' => true]);
    }

    public function reject($id)
    {
        $claim = CompanyClaimRequest::findOrFail($id);

        if ($claim->status !== 'pending') {
            return response()->json(['error' => 'Already processed'], 400);
        }

        $claim->update([
            'status' => 'rejected',
        ]);

        return response()->json(['success' => true]);
    }
}
