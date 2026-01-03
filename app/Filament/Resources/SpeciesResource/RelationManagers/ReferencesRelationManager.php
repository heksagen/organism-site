<?php

namespace App\Filament\Resources\SpeciesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReferencesRelationManager extends RelationManager
{
    protected static string $relationship = 'references';

    public function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Textarea::make('citation')
            ->required()
            ->rows(4)
            ->columnSpanFull(),

        Forms\Components\TextInput::make('link')->url()->nullable()->columnSpanFull(),

        Forms\Components\Select::make('type')
            ->options([
                'text' => 'Text source',
                'image' => 'Image source',
            ])
            ->nullable(),

        Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
    ]);
}


    public function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\TextColumn::make('type')->badge()->toggleable(),
            Tables\Columns\TextColumn::make('citation')->limit(50)->searchable(),
        ])
        ->defaultSort('sort_order')
        ->headerActions([
            Tables\Actions\CreateAction::make(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
}

}
