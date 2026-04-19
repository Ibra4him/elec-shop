<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label('N° Commande')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('user.name')
                    ->label('Client')
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('mad')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'en_attente' => 'gray',
                        'confirmee' => 'primary',
                        'en_preparation' => 'warning',
                        'expediee' => 'info',
                        'livree' => 'success',
                        'annulee' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('payment_status')
                    ->label('Paiement')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'en_attente' => 'En attente',
                        'confirmee' => 'Confirmée',
                        'en_preparation' => 'En préparation',
                        'expediee' => 'Expédiée',
                        'livree' => 'Livrée',
                        'annulee' => 'Annulée',
                    ]),
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                \Filament\Actions\Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn (\App\Models\Order $record): string => (new \App\Services\OrderService(new \App\Services\CartService(), new \App\Services\StockService()))->getWhatsAppLink($record))
                    ->openUrlInNewTab(),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
