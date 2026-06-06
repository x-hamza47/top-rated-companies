<?php

use App\Jobs\Aggregatevisitsjob;
use App\Jobs\Pruneoldvisitsjob;
use Illuminate\Support\Facades\Schedule;

Schedule::command('queue:work --stop-when-empty --tries=3 --timeout=90 --sleep=3')
    ->everyMinute()
    ->withoutOverlapping()
    ->name('queue-worker')
    ->runInBackground();
Schedule::command('sitemap:generate')->daily();

Schedule::job(new Aggregatevisitsjob)->dailyAt('00:05');
Schedule::job(new Pruneoldvisitsjob)->dailyAt('00:30');
