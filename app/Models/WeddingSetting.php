<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'story_content' => 'array',
        'dress_colors' => 'array',
    ];
}
