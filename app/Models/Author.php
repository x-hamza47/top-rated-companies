<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'designation',
        'company',
        'bio',
        'linkedin_url',
        'twitter_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function insights()
    {
        return $this->hasMany(Insight::class);
    }
}
