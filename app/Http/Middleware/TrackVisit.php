<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\VisitService;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    protected $visitService;

    public function __construct(VisitService $visitService)
    {
        $this->visitService = $visitService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $companySlug = $request->route('companySlug');
        $companyId = Company::where('slug', $companySlug)->value('id');

        if ($companyId) {
            $this->visitService->trackVisit($request, $companyId);
        }

        return $response;

    }
}
