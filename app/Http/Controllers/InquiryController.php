<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $inquiry = Inquiry::create([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
        ]);

        // TODO: Create a notification for the company 
        // Notification::create([...]);

        return back()->with('success', 'Inquiry sent successfully!');
    }

    public function index()
    {
        $companyId = Auth::id(); 
        $inquiries = Inquiry::where('company_id', $companyId)
            ->latest()
            ->paginate(10);

        return view('dashboard.inquiries.list', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        $companyId = Auth::id();
        if ($inquiry->company_id !== $companyId) {
            abort(403, 'Unauthorized access');
        }

        if (is_null($inquiry->read_at)) {
            $inquiry->update(['read_at' => now()]);
        }

        return view('dashboard.inquiries.show', compact('inquiry'));
    }

    public function markRead(Inquiry $inquiry)
    {
        $companyId = Auth::id();
        if ($inquiry->company_id !== $companyId) {
            abort(403);
        }

        $inquiry->update(['read_at' => now()]);

        return redirect()->back();
    }

    public function destroy(Inquiry $inquiry)
    {
        $companyId = Auth::id();
        if ($inquiry->company_id !== $companyId) {
            abort(403);
        }

        $inquiry->delete();

        return redirect()->back()->with('success', 'Inquiry deleted successfully.');
    }

    public function markResolved(Inquiry $inquiry)
    {

        $user = Auth::user();

        if ($inquiry->company_id !== $user->company->id) {
            abort(403, 'Unauthorized.');
        }

        if ($inquiry->status !== 'resolved') {
            $inquiry->update(['status' => 'resolved']);
        }

        return redirect()->back()->with('success', 'Inquiry marked as resolved.');
    }


}

