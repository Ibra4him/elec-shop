<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use App\Models\StockMovement;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\DateTimePicker;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Filters\SelectFilter;

class StockMovementResource extends Resource
{
    protected static ?string $model = StockMovement::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;
    
    protected static string|\UnitEnum|null $navigationGroup = 'Inventaire';
    
    protected static ?string $navigationLabel = 'Mouvements de Stock';

    protected static ?string $modelLabel = 'Mouvement de stock';

    protected static ?string $pluralModelLabel = 'Mouvements de stock';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('variant_id')
                    ->relationship('variant', 'sku')
                    ->searchable()
                    ->required()
                    ->preload(),
                Select::make('type')
                    ->options([
                        'entree' => 'Entrée (Achat/Retour)',
                        'sortie' => 'Sortie (Vente/Perte)',
                        'ajustement' => 'Ajustement Manuel',
                    ])
                    ->required()
                    ->live(),
                TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->helperText('Utilisez des nombres positifs. Sortie sera soustrait automatiquement.'),
                TextInput::make('reason')
                    ->required()
                    ->placeholder('Ex: Réapprovisionnement, Inventaire...'),
                TextInput::make('reference')
                    ->placeholder('Ex: Facture #123'),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(auth()->id())
                    ->disabled()
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Date')
                    ->sortable(),
                TextColumn::make('variant.sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('variant.product.name')
                    ->label('Produit')
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'entree' => 'success',
                        'sortie' => 'danger',
                        'ajustement' => 'warning',
                    }),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reason')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Par'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'entree' => 'Entrée',
                        'sortie' => 'Sortie',
                        'ajustement' => 'Ajustement',
                    ]),
            ])
            ->actions([
                // View action
            ])
            ->bulkActions([
                // Bulk actions
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\StockMovementResource\Pages\ListStockMovements::route('/'),
            'create' => \App\Filament\Resources\StockMovementResource\Pages\CreateStockMovements::route('/create'),
        ];
    }
}
