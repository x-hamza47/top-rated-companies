<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companydetail extends Model
{
    protected $guarded = [];
    protected $casts = [
        'links' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
