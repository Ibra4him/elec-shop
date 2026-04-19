<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Stock & Prix')
                    ->schema([
                        TextInput::make('sku')
                            ->label('SKU')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('price')
                            ->label('Prix')
                            ->required()
                            ->numeric()
                            ->prefix('DH'),
                        TextInput::make('promo_price')
                            ->label('Prix Promo')
                            ->numeric()
                            ->prefix('DH'),
                        TextInput::make('stock_qty')
                            ->label('Quantité en stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('min_stock')
                            ->label('Seuil d\'alerte')
                            ->required()
                            ->numeric()
                            ->default(5),
                        Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Attributs de la variante')
                    ->description('Sélectionnez les attributs qui définissent cette variante (ex: Couleur, Tension)')
                    ->schema([
                        \Filament\Forms\Components\Select::make('attributeValues')
                            ->label('Valeurs d\'attributs')
                            ->relationship('attributeValues', 'value')
                            ->multiple()
                            ->preload()
                            ->createOptionForm([
                                \Filament\Forms\Components\Select::make('attribute_id')
                                    ->relationship('attribute', 'name')
                                    ->required(),
                                TextInput::make('value')
                                    ->required(),
                            ])
                            ->required(),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('sku')
            ->columns([
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('promo_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('cost_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('stock_qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('min_stock')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
