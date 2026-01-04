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
    if (isset($data['taxonomy']) && is_array($data['taxonomy'])) {
        $data['taxonomy'] = json_encode($data['taxonomy'], JSON_UNESCAPED_UNICODE);
    }

    return $data;
}

}
