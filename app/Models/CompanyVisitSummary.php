<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyVisitSummary extends Model
{
    protected $fillable = [
        'company_id',
        'date',
        'total_visits',
        'unique_visitors',
        'devices',
        'browsers',
        'countries',
        'referrers',
        'hours',
    ];

    protected $casts = [
        'date' => 'date',
        'devices' => 'array',
        'browsers' => 'array',
        'countries' => 'array',
        'referrers' => 'array',
        'hours' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
