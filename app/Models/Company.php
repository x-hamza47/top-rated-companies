<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'logo',
        'verified',
        'name',
        'slug',
        'about',
        'tagline',
        'is_listed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
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

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    protected $appends = ['created_at_human'];
    protected function CreatedAtHuman(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->created_at
                ? ($this->created_at->diffInDays() > 7
                    ? $this->created_at->format('M d, Y')
                    : $this->created_at->diffForHumans())
                : null
        );
    }
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value
                ? $value
                : asset('images/dummy.jpg')
        );
    }
}
