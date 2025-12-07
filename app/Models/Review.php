<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Review extends Model
{
    protected $guarded = [];

    public function company()
    {
        $this->BelongsTo(Company::class, 'company_id');
    }
    public function reviewer()
    {
        return $this->belongsTo(Company::class, 'reviewer_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function faqs()
    {
        return $this->hasMany(ReviewFaq::class, 'review_id');
    }
}
