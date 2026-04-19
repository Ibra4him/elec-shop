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
                        '#3b82f6', // info
                        '#6366f1', // primary
                        '#22c55e', // success
                        '#ef4444', // danger
                    ],
                ],
            ],
            'labels' => $data->keys()->map(fn($status) => match($status) {
                'en_attente' => 'En Attente',
                'traitee' => 'Traitée',
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
