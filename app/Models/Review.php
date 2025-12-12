<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'company_id',
        'service_id',
        'reviewer_id',
        'reviewer_type',
        'review',
        'project_title',
        'project_size',
        'project_duration',
        'project_summary',
        'rating',
        'quality',
        'schedule',
        'cost',
        'willing_to_refer'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reviewer()
    {
        return $this->morphTo();
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
