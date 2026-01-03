<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpeciesSection extends Model
{
    protected $fillable = [
        'species_id',
        'key',
        'title',
        'content',
        'is_enabled',
        'sort_order',
    ];

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }
}
