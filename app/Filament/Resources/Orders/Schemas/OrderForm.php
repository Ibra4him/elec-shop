<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                TextInput::make('order_number')
                    ->required(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('tax_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('shipping_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('status')
                    ->options([
            'en_attente' => 'En attente',
            'confirmee' => 'Confirmee',
            'en_preparation' => 'En preparation',
            'expediee' => 'Expediee',
            'livree' => 'Livree',
            'annulee' => 'Annulee',
        ])
                    ->default('en_attente')
                    ->required(),
                Textarea::make('delivery_address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('payment_method')
                    ->required(),
                Select::make('payment_status')
                    ->options([
            'en_attente' => 'En attente',
            'payee' => 'Payee',
            'echouee' => 'Echouee',
            'remboursee' => 'Remboursee',
        ])
                    ->default('en_attente')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
