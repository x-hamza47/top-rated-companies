<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scopes\HideDevScope;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::withoutGlobalScope(HideDevScope::class)
            ->whereIn('role', ['admin', 'dev'])
            ->where('email', $request->email)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid admin credentials']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard.index');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $this->saveSessionSnapshot($user->id);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function saveSessionSnapshot(int $userId): void
    {
        $lastSession = DB::table('sessions')
            ->where('user_id', $userId)
            ->latest('last_activity')
            ->first();

        if ($lastSession) {
            $location = Cache::get('ip_location_' . $lastSession->ip_address);
            if ($location && ($location['label'] ?? null) !== 'Localhost') {
                Cache::put('user_last_location_' . $userId, $location, now()->addDays(7));
            }
        }

        $lastSeen = Cache::get('user_last_seen_' . $userId);
        Cache::put('last_seen_at_' . $userId, $lastSeen ?? now(), now()->addDays(1));
        Cache::forget('user_last_seen_' . $userId);
    }
}
