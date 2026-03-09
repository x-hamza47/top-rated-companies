<?php


use Illuminate\Support\Facades\Schedule;

Schedule::command('queue:work --stop-when-empty --tries=3 --timeout=90 --sleep=3')
    ->everyMinute()
    ->withoutOverlapping()
    ->name('queue-worker')
    ->runInBackground();
