<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Species extends Model
{
    protected $fillable = [
        'slug',
        'common_name',
        'scientific_name',
        'short_intro',
        'hero_image',
        'is_published',
        'sort_order',

        // ✅ add this
        'taxonomy',
    ];

    // ✅ add this
    protected $casts = [
        'taxonomy' => 'array',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(SpeciesSection::class)->orderBy('sort_order');
    }

    public function images(): HasMany
    {
        return $this->hasMany(SpeciesImage::class)->orderBy('sort_order');
    }

    public function references(): HasMany
    {
        return $this->hasMany(SpeciesReference::class)->orderBy('sort_order');
    }
    protected function taxonomy(): Attribute
{
    return Attribute::make(
        get: fn ($value) => is_string($value) ? json_decode($value, true) : $value,
        set: fn ($value) => is_array($value) ? json_encode($value) : $value,
    );
}

}
