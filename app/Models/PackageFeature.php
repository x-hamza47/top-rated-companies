<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'feature',
        'type',
        'value',
        'included',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
