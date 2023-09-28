<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'position',
        'description',
        'details',
        'image',
        'order',
        'visibility',
    ];

    protected $casts = [
        'name' => 'array',
        'position' => 'array',
        'description' => 'array',
        'details' => 'array',
        'order' => 'integer',
        'visibility' => 'boolean',
    ];
}
