<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'settings';

    protected $fillable = [
        'group',
        'name',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];
}
