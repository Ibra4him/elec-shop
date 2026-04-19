<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'Meilleures Ventes';
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderItem::query()
                    ->selectRaw('MAX(id) as id, product_name, SUM(quantity) as total_qty, SUM(total_price) as revenue')
                    ->groupBy('product_name')
                    ->orderByDesc('total_qty')
                    ->limit(5)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('product_name')
                    ->label('Produit'),
                TextColumn::make('total_qty')
                    ->label('Quantité Vendue')
                    ->badge()
                    ->color('info'),
                TextColumn::make('revenue')
                    ->label('Revenu Généré')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', ' ') . ' FCFA')
                    ->sortable(),
            ]);
    }
}
