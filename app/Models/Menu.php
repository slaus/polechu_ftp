<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use HasFactory;
    use NodeTrait;

    const MENU_LAYOUTS = [
        'main' => 1,
        'footer' => 0,
    ];

    protected $table = 'menus';

    protected $fillable = [
        'layout',
        'name',
        'properties',
        'visibility',
    ];

    protected $casts = [
        'layout' => 'integer',
        'name' => 'array',
        'properties' => 'array',
        'visibility' => 'boolean',
    ];
}
