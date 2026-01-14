<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'company_id',
        'service_id',
        'reviewer_name',
        'reviewer_email',
        'reviewer_location',
        'reviewer_company',
        'reviewer_company_bio',
        'reviewer_designation',
        'reviewer_employees',
        'review',
        'summary',
        'rating',
        'quality',
        'ai',
        'schedule',
        'cost',
        'willing_to_refer',
        'project_title',
        'project_size',
        'project_duration',
        'project_summary',
        'source',
        'reference',
        'status',
    ];


    protected $casts = [
        'rating' => 'integer',
        'quality' => 'integer',
        'ai' => 'integer',
        'schedule' => 'integer',
        'cost' => 'integer',
        'willing_to_refer' => 'integer',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
