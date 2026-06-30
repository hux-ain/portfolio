<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'tech_stack',
        'github_link',
        'live_link',
        'order_number',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'tech_stack' => 'array', // Auto decode/encode JSON
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
