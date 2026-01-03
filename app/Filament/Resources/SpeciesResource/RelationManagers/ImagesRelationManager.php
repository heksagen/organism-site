<?php

namespace App\Filament\Resources\SpeciesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('image_path')
                ->label('Image path / URL')
                ->required()
                ->helperText('For now: paste an image URL or a storage path (e.g., species/images/tamaraw.jpg)')
                ->columnSpanFull(),

            // ✅ Change from TextInput to Select dropdown (fixed keys)
            Forms\Components\Select::make('section_key')
                ->label('Show under section (optional)')
                ->options([
                    'geography'    => 'Geography & Distribution',
                    'taxonomy'     => 'Taxonomic Classification',
                    'morphology'   => 'Morphological Features / Identification',
                    'habitat'      => 'Habitat & Ecology',
                    'reproduction' => 'Reproduction & Life Cycle',
                    'economic'     => 'Economic / Cultural Importance',
                    'conservation' => 'Conservation Status / Threats',
                    'fun_facts'    => 'Fun Facts / Trivia',
                    'gallery'      => 'Images Section Only (default)',
                ])
                ->default('gallery')
                ->searchable()
                ->helperText('Choose where this image should also appear inside the page (e.g., Geography).')
                ->columnSpanFull(),

            Forms\Components\TextInput::make('caption')
                ->label('Caption')
                ->maxLength(255)
                ->columnSpanFull(),

            Forms\Components\Textarea::make('credit')
                ->label('Credit / Source')
                ->rows(3)
                ->helperText('Put image credit/citation here (author, site, year, link).')
                ->columnSpanFull(),

            Forms\Components\TextInput::make('sort_order')
                ->label('Sort order')
                ->numeric()
                ->default(0),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\TextColumn::make('caption')->searchable()->limit(30),
                Tables\Columns\TextColumn::make('section_key')->label('Placement')->toggleable(),
                Tables\Columns\TextColumn::make('image_path')->label('Path/URL')->limit(30),
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
