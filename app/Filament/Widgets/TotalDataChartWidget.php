<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TotalDataChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Statistik Jumlah Data Keseluruhan';
    protected static ?string $pollingInterval = null;

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                        'autoSkip' => false,
                    ],
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        $totals = [
            'Perkara PN' => DB::table('p_n_s')->count(),
            'Perkara PTUN' => DB::table('p_t_u_n_s')->count(),
            'Pengendalian' => DB::table('pengendalians')->count(),
            'Sengketa' => DB::table('sengketas')->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Data',
                    'data' => array_values($totals),
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                    ],
                    'borderColor' => [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => array_keys($totals),
        ];
    }
}
