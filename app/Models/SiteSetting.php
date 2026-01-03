<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_title',
        'site_subtitle',
        'overview_text',
        'hero_image',
    ];
}
