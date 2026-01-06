<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insight extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
        'title',
        'slug',
        'description',
        'article',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }


}

