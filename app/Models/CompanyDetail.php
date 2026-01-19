<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $fillable = [
        'company_id',
        'min_project_size',
        'hourly_rate',      
        'employees_range',  
        'is_freelancer',     
        'locations',
        'founded',
        'languages',
        'website',
        'social_links'
    ];

    protected $casts = [
        'languages' => 'array',
        'social_links' => 'array',
        'is_freelancer' => 'boolean',
    ];

    public function company()
    {
        return  $this->belongsTo(Company::class);
    }

    // Hack: Accessor

    protected function employees(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_freelancer
                ? 'Freelancer'
                : ($this->employees_range ?? null)
        );
    }
    protected function yearsInBusiness(): Attribute
    {
        return Attribute::make(
            get: fn() => now()->year - (int) $this->founded
        );
    }

    protected function totalLanguages(): Attribute
    {
        return Attribute::make(
            get: fn() => count($this->languages ?? [])
        );
    }
}
