<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{
    protected $fillable = [
        'package_id',
        'feature',
        'type',
        'small_value',
        'medium_value',
        'large_value',
    ];
    protected $casts = [
        'type' => 'string', 
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
