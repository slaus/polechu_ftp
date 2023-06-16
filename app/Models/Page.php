<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'slug',
        'name',
        'content',
        'seo',
        'visibility',
    ];

    protected $casts = [
        'name' => 'array',
        'content' => 'array',
        'seo' => 'array',
        'visibility' => 'boolean',
    ];
}
