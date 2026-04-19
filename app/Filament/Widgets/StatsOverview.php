<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Chiffre d\'Affaires', number_format(\App\Models\Order::where('payment_status', 'paye')->sum('total_amount'), 0, ',', ' ') . ' FCFA')
                ->description('Total des ventes encaissées (Payées)')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Commandes à traiter', \App\Models\Order::where('status', 'en_attente')->count())
                ->description('Nouvelles commandes reçues')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),
            Stat::make('Alerte Stock', \App\Models\ProductVariant::whereColumn('stock_qty', '<=', 'min_stock')->count())
                ->description('Produits sous le seuil critique')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
