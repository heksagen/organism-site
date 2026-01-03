<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpeciesReference extends Model
{
    protected $fillable = [
        'species_id',
        'citation',
        'link',
        'type',
        'sort_order',
    ];

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }
}
