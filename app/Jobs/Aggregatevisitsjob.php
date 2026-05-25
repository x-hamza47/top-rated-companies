<?php

namespace App\Jobs;

use App\Models\CompanyVisitSummary;
use App\Models\Visit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class Aggregatevisitsjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Carbon $date;

    /**
     * Create a new job instance.
     */
    public function __construct(?Carbon $date = null)
    {
        $this->date = $date ?? now()->subDay()->startOfDay();
    }

    /**
     * Execute the job.
     */
     public function handle(): void
    {
        $date = $this->date->toDateString();
 
        $companyIds = Visit::whereDate('created_at', $date)
            ->distinct()
            ->pluck('company_id');
 
        foreach ($companyIds as $companyId) {
            $visits = Visit::where('company_id', $companyId)
                ->whereDate('created_at', $date)
                ->get();
 
            $totalVisits    = $visits->count();
            $uniqueVisitors = $visits->unique('visitor_id')->count();
 
            $devices = $visits->groupBy('device_type')
                ->map(fn($group) => $group->count())
                ->toArray();
 
            $browsers = $visits->groupBy('browser')
                ->map(fn($group) => $group->count())
                ->toArray();
 
            $countries = $visits->groupBy('country_code')
                ->map(fn($group) => $group->count())
                ->toArray();
 
            $referrers = $visits->map(function ($visit) {
                if (!$visit->referrer_url) return 'direct';
                $host = parse_url($visit->referrer_url, PHP_URL_HOST);
                return $host ? preg_replace('/^www\./', '', $host) : 'direct';
            })
            ->groupBy(fn($domain) => $domain)
            ->map(fn($group) => $group->count())
            ->toArray();
 
            $hours = $visits->groupBy(fn($v) => Carbon::parse($v->created_at)->hour)
                ->map(fn($group) => $group->count())
                ->toArray();
 
            CompanyVisitSummary::updateOrCreate(
                ['company_id' => $companyId, 'date' => $date],
                [
                    'total_visits'    => $totalVisits,
                    'unique_visitors' => $uniqueVisitors,
                    'devices'         => $devices,
                    'browsers'        => $browsers,
                    'countries'       => $countries,
                    'referrers'       => $referrers,
                    'hours'           => $hours,
                ]
            );
        }
    }
}
