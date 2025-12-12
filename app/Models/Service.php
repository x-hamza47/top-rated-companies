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
}
