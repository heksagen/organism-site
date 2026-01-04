<?php

namespace App\Filament\Resources\SpeciesResource\Pages;

use App\Filament\Resources\SpeciesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSpecies extends CreateRecord
{
    protected static string $resource = SpeciesResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    // Taxonomy: force JSON string
    if (isset($data['taxonomy']) && is_array($data['taxonomy'])) {
        $data['taxonomy'] = json_encode($data['taxonomy'], JSON_UNESCAPED_UNICODE);
    }

    // Hero image: force single string path (PDO cannot bind arrays)
    if (isset($data['hero_image']) && is_array($data['hero_image'])) {
        $first = reset($data['hero_image']);
        $data['hero_image'] = is_string($first) ? $first : null;
    }

    return $data;
}


}
