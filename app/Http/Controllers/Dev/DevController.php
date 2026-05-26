<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class DevController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->search, function ($q) use ($request) {
            $q->where(function ($q) use ($request) {
                $q->where('firstName', 'like', '%' . $request->search . '%')
                    ->orWhere('lastName', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        })
            ->when($request->role, function ($q) use ($request) {
                $q->where('role', $request->role);
            })
            ->orderBy('role')
            ->paginate(15);

        $sessions = DB::table('sessions')
            ->whereIn('user_id', $users->pluck('id'))
            ->get()
            ->groupBy('user_id'); 

        $users->each(function ($user) use ($sessions) {
            $userSessions = $sessions->get($user->id, collect());

            if ($userSessions->isEmpty()) {
                $lastLocation = Cache::get('user_last_location_' . $user->id);
                $user->session_info = $lastLocation ? [['last_known' => true, 'location' => $lastLocation]] : null;
                return;
            }

            $user->session_info = $userSessions->map(function ($session) {
                $agent = new Agent();
                $agent->setUserAgent($session->user_agent);
                $ip = $session->ip_address;

                $location = Cache::get('ip_location_' . $ip);

                if (!$location) {
                    if (in_array($ip, ['127.0.0.1', '::1']) || str_starts_with($ip, '192.168.')) {
                        $location = ['label' => 'Localhost', 'lat' => null, 'lon' => null];
                    } else {
                        $geo = Location::get($ip);

                        $location = $geo ? [
                            'label' => "{$geo->cityName}, {$geo->countryName}",
                            'lat'   => $geo->latitude,
                            'lon'   => $geo->longitude,
                        ] : ['label' => 'Unknown', 'lat' => null, 'lon' => null];
                    }

                    Cache::put('ip_location_' . $ip, $location, now()->addDays(7));
                }
                return [
                    'ip'        => $ip,
                    'location'  => $location,
                    'browser'   => $agent->browser() ?: 'Unknown',
                    'platform'  => $agent->platform() ?: 'Unknown',
                    'is_mobile' => $agent->isMobile(),
                ];
            });
        });

        return view('dashboard.users.list', compact('users'));
    }


    public function forceLogout($id)
    {
        
        $user = User::findOrFail($id);

        $lastSession = DB::table('sessions')
            ->where('user_id', $id)
            ->latest('last_activity')
            ->first();

        if ($lastSession) {
            $location = Cache::get('ip_location_' . $lastSession->ip_address);

            if ($location && ($location['label'] ?? null) !== 'Localhost') {
                Cache::put('user_last_location_' . $id, $location, now()->addDays(7));
            }
        }


        DB::table('sessions')
            ->where('user_id', $id)
            ->delete();
        $lastSeen = Cache::get('user_last_seen_' . $id);
        Cache::put('last_seen_at_' . $id, $lastSeen ?? now(), now()->addDays(1));
        Cache::forget('user_last_seen_' . $id);

        return back()->with('success', $user->firstName . ' has been logged out.');
    }
}
