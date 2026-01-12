<?php

namespace App\Services;

use App\Jobs\TrackVisitJob;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class VisitService
{
    /**
     * Create a new class instance.
     */
    public function trackVisit($request, $companyId)
    {
        $visitorId = Cookie::get('visitor_id');
        if (!$visitorId) {
            $visitorId = Str::uuid()->toString();
            Cookie::queue('visitor_id', $visitorId, 60 * 24);
        }

        TrackVisitJob::dispatch([
            'company_id' => $companyId,
            'visitor_id' => $visitorId,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'page_url'     => $request->fullUrl(),
            'referrer_url' => $request->headers->get('referer') ?? null,
        ]);
    }
}
