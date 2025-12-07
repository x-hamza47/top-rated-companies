<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFaq extends Model
{
    protected $guarded = [];

    protected $casts = [
        'question' => 'array',
        'answer'   => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
