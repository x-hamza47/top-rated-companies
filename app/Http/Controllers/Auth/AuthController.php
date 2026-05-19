<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // ! Show Login Page
    public function index()
    {
        return view('auth.login');
    }
    public function registerPage()
    {
        return view('auth.register');
    }

    // ! Login 
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function register(Request $request)
    {

        $request->validate([
            'role' => 'required|in:user,company',
            'firstName' => ['required','regex:/^[a-zA-Z\s]+$/','max:50'],
            'lastName' => ['required','regex:/^[a-zA-Z\s]+$/','max:50'],
            'email' => 'required|email|unique:users,email',
            'phone' => ['nullable','regex:/^\+?[1-9]\d{7,14}$/'],
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($request->role === "company") {
            Company::create([
                'user_id' => $user->id,
                'name' => null,
                'slug' => null,
                'tagline' => null,
                'about' => null,
                'logo' => null,
            ]);
        }

        $user->sendEmailVerificationNotification();

        return redirect()->route('login')
            ->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    // ! Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // =========================
    // Forgot Password 
    // =========================

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role === 'admin') {

            return back()->with('status', 'If your email exists, a reset link has been sent.')
                ->with('remaining', 0)
                ->withInput();
        }


        $waitTime = 120;

        $lastReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->latest('created_at')
            ->first();

        if ($lastReset) {
            $last = Carbon::parse($lastReset->created_at);
            $secondsPassed = $last->diffInSeconds(now());

            if ($secondsPassed < $waitTime) {
                $remaining = $waitTime - $secondsPassed;
                return back()
                    ->with('error', "Please wait {$remaining} seconds before sending again.")
                    ->with('remaining', $remaining)
                    ->with('status', session('status', null))
                    ->withInput();
            }
        }

        $status = Password::sendResetLink($request->only('email'));
        $remaining = $waitTime;

        return back()
            ->with('status', $status === Password::RESET_LINK_SENT
                ? 'Reset email sent successfully!'
                : 'Unable to send reset email.')
            ->with('remaining', $remaining)
            ->withInput();
    }

    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');
        return view('auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role === 'admin') {
            return redirect()->route('login')->with('status', 'Password reset successfully.');
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Password reset successfully.')
            : back()->withErrors(['email' => __($status)]);
    }
}
