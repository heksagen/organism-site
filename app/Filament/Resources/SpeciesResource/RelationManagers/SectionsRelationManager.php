<?php

namespace App\Filament\Resources\SpeciesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    public function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Select::make('title')
    ->label('Title')
    ->required()
    ->options([
        'Geography & Distribution' => 'Geography & Distribution',
        'Morphological Features / Identification' => 'Morphological Features / Identification',
        'Habitat & Ecology' => 'Habitat & Ecology',
        'Reproduction & Life Cycle' => 'Reproduction & Life Cycle',
        'Economic / Cultural Importance' => 'Economic / Cultural Importance',
        'Conservation Status / Threats' => 'Conservation Status / Threats',
        'Fun Facts / Trivia' => 'Fun Facts / Trivia',
    ])
    ->searchable()
    ->reactive()
    ->afterStateUpdated(function ($state, callable $set) {
        $map = [
            'Geography & Distribution' => 'geography',
            'Morphological Features / Identification' => 'morphology',
            'Habitat & Ecology' => 'habitat_ecology',
            'Reproduction & Life Cycle' => 'reproduction_lifecycle',
            'Economic / Cultural Importance' => 'economic_cultural',
            'Conservation Status / Threats' => 'conservation',
            'Fun Facts / Trivia' => 'fun_facts',
        ];

        if (isset($map[$state])) {
            $set('key', $map[$state]);
        }
    }),

        Forms\Components\TextInput::make('key')
    ->label('Key (auto-filled)')
    ->required()
    ->disabled()          // user cannot edit
    ->dehydrated(true)    // still saves to DB even though disabled
    ->helperText('Auto-generated from Title to ensure images appear under the correct section.')
    ->maxLength(255),

        Forms\Components\Toggle::make('is_enabled')->default(true),

        Forms\Components\TextInput::make('sort_order')->numeric()->default(0),

        Forms\Components\Textarea::make('content')
            ->rows(10)
            ->columnSpanFull(),
    ]);
}


    public function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('key')->toggleable(),
            Tables\Columns\IconColumn::make('is_enabled')->boolean()->sortable(),
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
