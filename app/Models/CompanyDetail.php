<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $fillable = [
        'company_id',
        'min_project_size',
        'hourly_rate_min',
        'hourly_rate_max',
        'employees_min',
        'employees_max',
        'locations',
        'founded',
        'languages',
        'website',
        'social_links'
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function company(){
        return  $this->belongsTo(Company::class);
    }

}
