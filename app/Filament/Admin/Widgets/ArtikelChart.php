<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Articles;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ArtikelChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Artikel per Bulan';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = Articles::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $values = [];

        foreach ($data as $item) {
            $labels[] = Carbon::create()->month($item->bulan)->format('F'); // Nama bulan
            $values[] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Artikel',
                    'data' => $values,
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // bisa 'line', 'pie', dll
    }
}
