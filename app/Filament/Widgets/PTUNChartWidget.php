<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PTUNChartWidget extends ChartWidget
{
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Statistik Data PTUN';
    protected static ?string $pollingInterval = null;
    public ?string $filter = 'per_tahun';

    protected function getFilters(): ?array
    {
        return [
            'per_tahun' => 'Jumlah Data per Tahun',
            'pertumbuhan_kumulatif' => 'Pertumbuhan Kumulatif Harian',
            'gabungan' => 'Jumlah Data per Tahun dan Kumulatif Data',
        ];
    }

    protected function getType(): string
    {
        return match ($this->filter) {
            'per_tahun' => 'bar',
            'pertumbuhan_kumulatif' => 'line',
            'gabungan' => 'bar', // Chart.js mixed chart berbasis bar
        };
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
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
        $filter = $this->filter;

        if ($filter === 'per_tahun') {
            $data = DB::table('p_t_u_n_s')
                ->select('tahun', DB::raw('COUNT(*) as total'))
                ->whereNotNull('tahun')
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get();

            $labels = $data->pluck('tahun');
            $values = $data->pluck('total');

            return [
                'datasets' => [
                    [
                        'type' => 'bar',
                        'label' => 'Jumlah Data per Tahun',
                        'data' => $values,
                        'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                        'borderColor' => 'rgba(54, 162, 235, 1)',
                        'borderWidth' => 1,
                    ],
                ],
                'labels' => $labels,
            ];
        } elseif ($filter === 'pertumbuhan_kumulatif') {
            $dailyData = DB::table('p_t_u_n_s')
                ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('tanggal')
                ->get();

            $labels = [];
            $cumulative = [];
            $total = 0;

            foreach ($dailyData as $row) {
                $total += $row->jumlah;
                $labels[] = $row->tanggal;
                $cumulative[] = $total;
            }

            return [
                'datasets' => [
                    [
                        'type' => 'line',
                        'label' => 'Pertumbuhan Kumulatif Harian',
                        'data' => $cumulative,
                        'borderColor' => 'rgba(255, 99, 132, 1)',
                        'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                        'fill' => false,
                        'tension' => 0.4,
                    ],
                ],
                'labels' => $labels,
            ];
        } else { // gabungan
            // Data per tahun
            $dataPerTahun = DB::table('p_t_u_n_s')
                ->select('tahun', DB::raw('COUNT(*) as total'))
                ->whereNotNull('tahun')
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get();

            $labels = $dataPerTahun->pluck('tahun')->toArray();
            $barData = $dataPerTahun->pluck('total')->toArray();

            // Buat data kumulatif dari barData
            $lineData = [];
            $cumulativeTotal = 0;
            foreach ($barData as $jumlah) {
                $cumulativeTotal += $jumlah;
                $lineData[] = $cumulativeTotal;
            }

            return [
                'datasets' => [
                    [
                        'type' => 'bar',
                        'label' => 'Jumlah Data per Tahun',
                        'data' => $barData,
                        'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                        'borderColor' => 'rgba(54, 162, 235, 1)',
                        'borderWidth' => 1,
                    ],
                    [
                        'type' => 'line',
                        'label' => 'Kumulatif Data',
                        'data' => $lineData,
                        'borderColor' => 'rgba(255, 99, 132, 1)',
                        'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                        'fill' => false,
                        'tension' => 0.4,
                    ],
                ],
                'labels' => $labels,
            ];
        }
    }
}
