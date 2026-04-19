<?php

namespace App\Filament\Resources\ProductVariants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductVariantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->searchable(),
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
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state, $record): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= $record->min_stock => 'warning',
                        default => 'success',
                    }),
                TextColumn::make('min_stock')
                    ->label('Seuil Min')
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
            ->actions([
                EditAction::make(),
                \Filament\Actions\Action::make('adjust_stock')
                    ->label('Mouvement')
                    ->icon('heroicon-o-plus-circle')
                    ->color('info')
                    ->form([
                        \Filament\Forms\Components\Select::make('type')
                            ->options([
                                'entree' => 'Entrée (Réassort)',
                                'sortie' => 'Sortie (Perte/Vente)',
                                'ajustement' => 'Correctif Manuel',
                            ])
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('reason')
                            ->required()
                            ->default('Ajustement via dashboard'),
                    ])
                    ->action(function ($record, array $data): void {
                        $record->adjustStock(
                            $data['quantity'], 
                            $data['type'], 
                            $data['reason']
                        );
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Stock mis à jour avec succès')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
