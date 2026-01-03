<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpeciesImage extends Model
{
    protected $fillable = [
        'species_id',
        'section_key',
        'image_path',
        'caption',
        'credit',
        'sort_order',
    ];

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }
}
