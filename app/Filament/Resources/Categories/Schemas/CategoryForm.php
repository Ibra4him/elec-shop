<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        \Filament\Forms\Components\Tabs\Tab::make('Général')
                            ->schema([
                                Select::make('parent_id')
                                    ->relationship('parent', 'name', fn ($query) => $query->whereNull('parent_id'))
                                    ->label('Catégorie Parente')
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Racine'),
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('icon')
                                    ->label('Icône (Heroicon/Lucide)')
                                    ->placeholder('heroicon-o-variable'),
                                Textarea::make('description')
                                    ->columnSpanFull(),
                                TextInput::make('position')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->label('Actif')
                                    ->default(true),
                            ])->columns(2),
                        
                        \Filament\Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(60),
                                Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
