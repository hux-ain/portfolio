<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'icon_class',
        'proficiency_level',
        'order_number',
        'is_featured',
    ];

    protected $casts = [
        'proficiency_level' => 'integer',
        'order_number' => 'integer',
        'is_featured' => 'boolean',
    ];
}
