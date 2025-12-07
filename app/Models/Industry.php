<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $guarded = [];

    public function company()
    {
        return $this->hasMany(Company::class);
    }
}
