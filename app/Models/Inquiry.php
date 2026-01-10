<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'subject',
        'phone',
        'message',
        'ip_address',
        'status',
        'read_at',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
