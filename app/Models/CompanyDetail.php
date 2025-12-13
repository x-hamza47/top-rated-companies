<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'languages' => 'array',
    ];

    public function company()
    {
        return  $this->belongsTo(Company::class);
    }

    // Hack: Accessor
    protected function hourlyRate(): Attribute
    {
        return Attribute::make(
            get: fn() =>
            '$' . intval($this->hourly_rate_min)
                . '- $' .intval($this->hourly_rate_max) . '/hr'
        );
    }
    protected function employees(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->employees_min}-{$this->employees_max}"
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
