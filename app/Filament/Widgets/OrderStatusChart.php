<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderStatusChart extends ChartWidget
{
    protected ?string $heading = 'Distribution des Commandes';

    protected function getData(): array
    {
        $data = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Commandes',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => [
                        '#f59e0b', // warning
                        '#0ea5e9', // info (confirmee)
                        '#6366f1', // primary (en_preparation)
                        '#3b82f6', // blue (expediee)
                        '#22c55e', // success
                        '#ef4444', // danger
                    ],
                ],
            ],
            'labels' => $data->keys()->map(fn($status) => match($status) {
                'en_attente' => 'En Attente',
                'confirmee' => 'Confirmée',
                'en_preparation' => 'En préparation',
                'expediee' => 'Expédiée',
                'livree' => 'Livrée',
                'annulee' => 'Annulée',
                default => $status,
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
