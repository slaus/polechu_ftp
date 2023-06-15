<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory;
    use HasTags;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'slug',
        'name',
        'image',
        'description',
        'content',
        'author',
        'seo',
        'visibility',
    ];

    protected $casts = [
        'user_id' => 'array',
        'name' => 'array',
        'description' => 'array',
        'content' => 'array',
        'author' => 'array',
        'seo' => 'array',
        'visibility' => 'boolean',
    ];

    protected $appends = [
        'published_at',
        'format_published_at',
    ];

    public function getPublishedAtAttribute(): string
    {
        return $this->created_at?->format('d.m.Y H:i') ?? '';
    }

    public function getFormatPublishedAtAttribute(): string
    {
        return $this->created_at?->isoFormat('D MMMM Y') ?? '';
    }
}
