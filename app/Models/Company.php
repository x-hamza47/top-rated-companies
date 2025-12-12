<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'logo',
        'verified',
        'name',
        'slug',
        'about',
        'tagline',
        'category_id',
    ];

    public function details(){
        return $this->hasOne(CompanyDetail::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'company_services')
            ->withPivot(['expertise_percentage'])
            ->withTimestamps();
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
