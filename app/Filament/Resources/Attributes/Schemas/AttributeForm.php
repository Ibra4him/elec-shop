<?php

namespace App\Filament\Resources\Attributes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AttributeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Détails de l\'attribut')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('type')
                            ->options([
                                'text' => 'Texte',
                                'number' => 'Nombre',
                                'color' => 'Couleur',
                                'select' => 'Sélection',
                            ])
                            ->default('select')
                            ->required(),
                        Toggle::make('is_filterable')
                            ->label('Filtrable')
                            ->default(true),
                        Toggle::make('is_visible')
                            ->label('Visible sur la fiche')
                            ->default(true),
                        TextInput::make('position')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('Valeurs possibles')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('values')
                            ->relationship('values')
                            ->schema([
                                TextInput::make('value')
                                    ->required(),
                                \Filament\Forms\Components\ColorPicker::make('color_code')
                                    ->hidden(fn (callable $get) => $get('../../type') !== 'color'),
                                TextInput::make('position')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(3)
                            ->defaultItems(0),
                    ]),
            ]);
    }
}
