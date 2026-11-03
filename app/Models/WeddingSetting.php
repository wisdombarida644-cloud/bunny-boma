<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'story_content' => 'array',
        'story_sides' => 'array',
        'dress_colors' => 'array',
        'rsvp_deadline' => 'date',
        'background_music_enabled' => 'boolean',
    ];
}
