<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'plugin_id',
        'name',
        'gallery',
    ];

    protected $casts = [
        'plugin_id' => 'integer',
        'name' => 'array',
        'gallery' => 'array',
    ];
}
