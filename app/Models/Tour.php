<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

    protected $fillable = [
        'slug',
        'name',
        'image',
        'gallery',
        'price',
        'description',
        'content',
        'seo',
        'visibility',
        'order',
    ];

    protected $casts = [
        'name' => 'array',
        'gallery' => 'array',
        'price' => 'array',
        'description' => 'array',
        'content' => 'array',
        'seo' => 'array',
        'visibility' => 'boolean',
        'order' => 'integer',
    ];
}
