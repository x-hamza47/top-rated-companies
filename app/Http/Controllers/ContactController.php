<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\User;
use App\Notifications\ContactUsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('contact.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'subject' => 'required|string',
            'message' => 'required|string',
        ], [
            'fname.required' => 'First name is required.',
            'fname.string'   => 'First name must be a valid string.',
            'lname.required' => 'Last name is required.',
            'lname.string'   => 'Last name must be a valid string.',
        ]);

        $contact = ContactUs::create([
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'phone' => $request->phone,
        ]);

        $admins = User::where('role', 'admin')
            // ->where('email', '!=', 'admin@gmail.com')
            ->where('email', '=', 'hamzaamir72007@gmail.com')
            ->get();
        Notification::send($admins, new ContactUsNotification($contact));

        return back()->with('success', 'Message sent!');
    }

    // ! Dashboard Routes

    public function index()
    {
        $user = Auth::user();

 
        $unreadNotificationIds = $user->unreadNotifications
            ->where('type', 'contact-message')
            ->pluck('data.contact_id')
            ->toArray();

 
        $messages = ContactUs::query()
            ->select('contact_us.*', 'contact_us.id as contact_id')
            // ->orderByRaw("FIELD(contact_us.id, ?) DESC", [implode(',', $unreadNotificationIds)])
            // ->latest()
            ->paginate(10);

        return view('dashboard.contact.list', compact('messages', 'unreadNotificationIds'));
    }

    public function show(ContactUs $contact)
    {
        $notification = Auth::user()->unreadNotifications
            ->where('type', 'contact-message')
            ->firstWhere('data.contact_id', $contact->id);

        if ($notification) {
            $notification->markAsRead();
        }
        return view('dashboard.contact.show', compact('contact'));
    }

    public function markRead(ContactUs $contact)
    {
        $notification = Auth::user()->unreadNotifications()
            ->where('type', 'contact-message')
            ->where('data->contact_id', $contact->id)
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Message marked as read.');
    }

    public function resolve(ContactUs $contact)
    {
        if ($contact->status !== 'resolved') {
            $contact->update(['status' => 'resolved']);
        }
        return redirect()->route('contact.index')
            ->with('success', 'Message marked as resolved.');
    }
}

