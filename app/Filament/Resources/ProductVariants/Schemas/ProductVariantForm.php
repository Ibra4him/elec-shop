<?php

namespace App\Filament\Resources\ProductVariants\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductVariantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('price')
                    ->label('Prix de vente')
                    ->required()
                    ->numeric()
                    ->suffix('FCFA'),
                TextInput::make('promo_price')
                    ->label('Prix promo')
                    ->numeric()
                    ->default(null)
                    ->suffix('FCFA'),
                TextInput::make('cost_price')
                    ->label('Prix d\'achat')
                    ->numeric()
                    ->default(null)
                    ->suffix('FCFA'),
                TextInput::make('stock_qty')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('min_stock')
                    ->required()
                    ->numeric()
                    ->default(5),
                TextInput::make('weight')
                    ->numeric()
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
