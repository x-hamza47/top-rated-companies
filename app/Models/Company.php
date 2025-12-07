<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'company_services')
            ->withPivot('percentage')
            ->withTimestamps();
    }
    public function detail()
    {
        return $this->hasOne(CompanyDetail::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'company_id');
    }

    public function givenReviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function networks()
    {
        return $this->belongsToMany(
            Company::class,
            'networks',
            'company_id',
            'network_company_id'
        );
    }

    public function inNetworks()
    {
        return $this->belongsToMany(
            Company::class,
            'networks',
            'network_company_id',
            'company_id'
        );
    }
}
