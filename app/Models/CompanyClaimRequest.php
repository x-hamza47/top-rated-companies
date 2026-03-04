<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyClaimRequest extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'submitted_name',
        'submitted_email',
        'job_title',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

