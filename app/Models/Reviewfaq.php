<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewFaq extends Model
{
    protected $guarded = [];

    protected $casts = [
        'question' => 'array',
        'answer'   => 'array',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }
}
