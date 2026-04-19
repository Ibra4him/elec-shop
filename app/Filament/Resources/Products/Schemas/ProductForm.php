<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Tabs::make('Tabs')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Informations Générales')
                            ->schema([
                                \Filament\Schemas\Components\Grid::make(3)
                                    ->schema([
                                        Select::make('category_id')
                                            ->label('Catégorie')
                                            ->relationship('category', 'name')
                                            ->required()
                                            ->preload()
                                            ->searchable(),
                                        Select::make('brand_id')
                                            ->label('Marque')
                                            ->relationship('brand', 'name')
                                            ->preload()
                                            ->searchable(),
                                        Select::make('status')
                                            ->label('Statut')
                                            ->options([
                                                'actif' => 'Actif',
                                                'inactif' => 'Inactif',
                                                'brouillon' => 'Brouillon'
                                            ])
                                            ->default('brouillon')
                                            ->required(),
                                    ]),
                                TextInput::make('name')
                                    ->label('Nom du produit')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('short_description')
                                    ->label('Description courte')
                                    ->maxLength(500),
                                Textarea::make('description')
                                    ->label('Description longue')
                                    ->columnSpanFull(),
                                \Filament\Schemas\Components\Grid::make(2)
                                    ->schema([
                                        TextInput::make('base_price')
                                            ->label('Prix de base')
                                            ->required()
                                            ->numeric()
                                            ->suffix('FCFA'),
                                        Toggle::make('is_featured')
                                            ->label('Mettre en avant')
                                            ->default(false),
                                    ]),
                            ]),

                        \Filament\Schemas\Components\Tabs\Tab::make('Spécifications Techniques')
                            ->schema([
                                \Filament\Forms\Components\Repeater::make('specifications')
                                    ->label('Caractéristiques techniques')
                                    ->relationship('specifications')
                                    ->schema([
                                        TextInput::make('key')
                                            ->label('Propriété (ex: Ampérage)')
                                            ->required(),
                                        TextInput::make('value')
                                            ->label('Valeur (ex: 16A)')
                                            ->required(),
                                        TextInput::make('position')
                                            ->label('Ordre')
                                            ->numeric()
                                            ->default(0),
                                    ])
                                    ->columns(3)
                                    ->defaultItems(0)
                                    ->reorderableWithButtons(),
                            ]),

                        \Filament\Schemas\Components\Tabs\Tab::make('Médias')
                            ->schema([
                                \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('product_images')
                                    ->collection('product_images')
                                    ->label('Images du produit')
                                    ->multiple()
                                    ->image()
                                    ->reorderable(),
                            ]),

                        \Filament\Schemas\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Titre Meta')
                                    ->maxLength(60),
                                Textarea::make('meta_description')
                                    ->label('Description Meta')
                                    ->maxLength(160),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
