<?php

namespace App\Jobs;

use App\Models\Visit;
use Jenssegers\Agent\Agent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Stevebauman\Location\Facades\Location;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TrackVisitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $alreadyViewed = Visit::where('company_id', $this->data['company_id'])
            ->where('visitor_id', $this->data['visitor_id'])
            ->where('page_url', $this->data['page_url'])
            ->whereDate('created_at', now()->toDateString())
            ->exists();


        if ($alreadyViewed) return;

        $agent = new Agent();
        $agent->setUserAgent($this->data['user_agent']);
        $browser =  $agent->browser();
        $os = $agent->platform();
        $deviceType = $agent->isMobile() ? 'mobile' : 'desktop';


        $geo = Location::get($this->data['ip_address']);

        Visit::create([
            'company_id'   => $this->data['company_id'],
            'visitor_id'   => $this->data['visitor_id'],
            'ip_address'   => $this->data['ip_address'],
            'user_agent'   => $this->data['user_agent'],
            'browser'      => $browser,
            'os'           => $os,
            'device_type'  => $deviceType,
            'page_url'     => $this->data['page_url'],    
            'referrer_url' => $this->data['referrer_url'],
            'country_code' => optional($geo)->countryCode,
            'country'      => optional($geo)->countryName,
            'region'       => optional($geo)->regionName,
            'city'         => optional($geo)->cityName,
        ]);
    }
}
