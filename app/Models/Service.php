<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'desc'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_services')
            ->withPivot(['expertise_percentage']);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function insights()
    {
        return $this->hasMany(Insight::class);
    }

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable');
    }
}
