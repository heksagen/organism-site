<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpeciesResource\Pages;
use App\Filament\Resources\SpeciesResource\RelationManagers;
use App\Models\Species;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;


class SpeciesResource extends Resource
{
    protected static ?string $model = Species::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('common_name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('scientific_name')
                ->maxLength(255),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('Used in URL: /species/{slug}')
                ->maxLength(255),

            Forms\Components\Textarea::make('short_intro')
                ->rows(3)
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('hero_image')
    ->disk('public')
    ->directory('species/hero')
    ->visibility('public')
    ->image()
    ->imagePreviewHeight('150')
    ->openable()
    ->downloadable()
    ->maxSize(5120)
    ->preserveFilenames(false),



            Forms\Components\Toggle::make('is_published')
                ->default(true),

            Forms\Components\TextInput::make('sort_order')
                ->numeric()
                ->default(0),
                Forms\Components\Section::make('Taxonomic Classification')
    ->description('Fixed biological ranks for this species')
    ->schema([
        Forms\Components\Grid::make(2)->schema([
            Forms\Components\TextInput::make('taxonomy.kingdom')
                ->label('Kingdom')
                ->required(),

            Forms\Components\TextInput::make('taxonomy.phylum')
                ->label('Phylum')
                ->required(),

            Forms\Components\TextInput::make('taxonomy.subphylum')
                ->label('Subphylum'),

            Forms\Components\TextInput::make('taxonomy.class')
                ->label('Class')
                ->required(),

            Forms\Components\TextInput::make('taxonomy.order')
                ->label('Order')
                ->required(),

            Forms\Components\TextInput::make('taxonomy.family')
                ->label('Family')
                ->required(),

            Forms\Components\TextInput::make('taxonomy.genus')
                ->label('Genus')
                ->required(),

            Forms\Components\TextInput::make('taxonomy.species')
                ->label('Species')
                ->required(),
        ]),
    ]),

                
        ]);
}


    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('sort_order')->sortable(),
            Tables\Columns\TextColumn::make('common_name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('scientific_name')->searchable(),
            Tables\Columns\IconColumn::make('is_published')->boolean()->sortable(),
            Tables\Columns\TextColumn::make('slug')->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\ImageColumn::make('hero_image')
    ->disk('public')
    ->square(),
        ])
        ->defaultSort('sort_order')
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}


    public static function getRelations(): array
{
    return [
        \App\Filament\Resources\SpeciesResource\RelationManagers\SectionsRelationManager::class,
        \App\Filament\Resources\SpeciesResource\RelationManagers\ImagesRelationManager::class,
        \App\Filament\Resources\SpeciesResource\RelationManagers\ReferencesRelationManager::class,
    ];
}


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpecies::route('/'),
            'create' => Pages\CreateSpecies::route('/create'),
            'edit' => Pages\EditSpecies::route('/{record}/edit'),
        ];
    }
}
