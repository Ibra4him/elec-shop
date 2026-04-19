<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Détails de la Commande')
                    ->schema([
                        TextEntry::make('order_number')
                            ->label('N° Commande')
                            ->weight('bold')
                            ->copyable(),
                        TextEntry::make('status')
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
                        TextEntry::make('user.name')
                            ->label('Client'),
                        TextEntry::make('created_at')
                            ->label('Date')
                            ->dateTime(),
                    ])->columns(4),

                \Filament\Schemas\Components\Section::make('Articles')
                    ->schema([
                        \Filament\Infolists\Components\RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                TextEntry::make('product_name')
                                    ->label('Produit'),
                                TextEntry::make('variant_details')
                                    ->label('Variante')
                                    ->badge(),
                                TextEntry::make('unit_price')
                                    ->label('Prix Unitaire')
                                    ->money('mad'),
                                TextEntry::make('quantity')
                                    ->label('Quantité'),
                                TextEntry::make('total_price')
                                    ->label('Total')
                                    ->money('mad')
                                    ->weight('bold'),
                            ])->columns(5),
                    ]),

                \Filament\Schemas\Components\Grid::make(2)
                    ->schema([
                        \Filament\Schemas\Components\Section::make('Livraison & Paiement')
                            ->schema([
                                TextEntry::make('delivery_address')
                                    ->label('Adresse de livraison'),
                                TextEntry::make('payment_method')
                                    ->label('Méthode de Paiement'),
                                TextEntry::make('payment_status')
                                    ->label('Statut Paiement')
                                    ->badge(),
                            ])->columnSpan(1),
                        
                        \Filament\Schemas\Components\Section::make('Récapitulatif')
                            ->schema([
                                TextEntry::make('subtotal')
                                    ->label('Sous-total')
                                    ->money('mad'),
                                TextEntry::make('shipping_amount')
                                    ->label('Frais de port')
                                    ->money('mad'),
                                TextEntry::make('total_amount')
                                    ->label('TOTAL')
                                    ->money('mad')
                                    ->weight('bold')
                                    ->size('lg')
                                    ->color('primary'),
                            ])->columnSpan(1),
                    ]),
            ]);
    }
}
