<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{

    use HasFactory;

    protected $fillable = [
        'company_id',
        'service_id',
        'small_price',
        'medium_price',
        'large_price',
        'price_type',
        'description',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function features()
    {
        return $this->hasMany(PackageFeature::class);
    }
}
