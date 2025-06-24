<?php

namespace App\Filament\Resources\PolarChartDashboardResource\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class DashboardChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?string $icon = 'heroicon-o-chart-pie';
    protected static ?string $title = 'Polar Area Chart';
    protected static ?int $minHeight = 200;

    protected function getData(): array
    {
        // Status labels and corresponding colors
        $statusLabels = [
            0 => 'Red',       // Pending
            1 => 'Green',     // Paid
            2 => 'Yellow',    // On Its Way
            3 => 'Grey',      // Cancelled
            4 => 'Blue',      // Delivered
        ];

        $statusColors = [
            0 => 'rgb(255, 99, 132)',   // Red
            1 => 'rgb(75, 192, 192)',   // Green
            2 => 'rgb(255, 205, 86)',   // Yellow
            3 => 'rgb(201, 203, 207)',  // Grey
            4 => 'rgb(54, 162, 235)',   // Blue
        ];

        // Get counts grouped by status
        $orders = Order::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $data = [];
        $colors = [];
        $labels = [];

        foreach ($statusLabels as $status => $label) {
            $labels[] = $label;
            $data[] = $orders[$status] ?? 0;
            $colors[] = $statusColors[$status];
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Orders by Status',
                    'data' => $data,
                    'backgroundColor' => $colors,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
