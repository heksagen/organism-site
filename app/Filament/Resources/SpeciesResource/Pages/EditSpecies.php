<?php

namespace App\Filament\Resources\SpeciesResource\Pages;

use App\Filament\Resources\SpeciesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpecies extends EditRecord
{
    protected static string $resource = SpeciesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

protected function mutateFormDataBeforeSave(array $data): array
{
    if (isset($data['taxonomy']) && is_array($data['taxonomy'])) {
        $data['taxonomy'] = json_encode($data['taxonomy'], JSON_UNESCAPED_UNICODE);
    }

    if (isset($data['hero_image']) && is_array($data['hero_image'])) {
        $first = reset($data['hero_image']);
        $data['hero_image'] = is_string($first) ? $first : null;
    }

    return $data;
}


}
