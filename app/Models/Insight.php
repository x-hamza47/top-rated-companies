<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Insight extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'thumbnail',
        'published_at',
        'read_time',
        'content_json',
        'meta_title',
        'meta_description',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'content_json' => 'array',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : null;
    }
}
