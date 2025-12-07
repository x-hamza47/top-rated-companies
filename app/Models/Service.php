<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['category', 'service'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_services')
            ->withPivot('percentage')
            ->withTimestamps();
    }

    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class, 'service_id');
    }
}
