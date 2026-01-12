<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'company_id',
        'visitor_id',
        'ip_address',
        'user_agent',
        'browser',
        'os',
        'device_type',
        'page_url',
        'referrer_url',
        'country_code',
        'country',
        'region',
        'city'
    ];
}
