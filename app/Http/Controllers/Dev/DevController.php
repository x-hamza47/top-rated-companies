<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DevController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->search, function ($q) use ($request) {
            $q->where(function ($q) use ($request) {
                $q->where('firstName', 'like', '%'.$request->search.'%')
                    ->orWhere('lastName', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        })
            ->when($request->role, function ($q) use ($request) {
                $q->where('role', $request->role);
            })
            ->orderBy('role')
            ->paginate(15);

        return view('dashboard.users.list', compact('users'));
    }

    public function forceLogout($id)
    {
        $user = User::findOrFail($id);

        DB::table('sessions')
            ->where('user_id', $id)
            ->delete();
        $lastSeen = Cache::get('user_last_seen_'.$id);
        Cache::put('last_seen_at_'.$id, $lastSeen ?? now(), now()->addDays(1));
        Cache::forget('user_last_seen_'.$id);

        return back()->with('success', $user->firstName.' has been logged out.');
    }
}
