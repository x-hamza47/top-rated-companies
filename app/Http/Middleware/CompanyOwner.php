<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->can('company')) {
            $company = $request->route('company');

            if (!$company || $company->user_id !== $user->id) {
                // abort(403, 'Unauthorized access.');
                return redirect()->back()->with('error', 'You are not authorized to access that page.');
            }
        }
        return $next($request);
    }
}
