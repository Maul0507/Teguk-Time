<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah User per Bulan';

    protected static ?int $sort = 0;

    protected function getData(): array
    {
        $users = User::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $values = [];

        foreach ($users as $item) {
            $labels[] = Carbon::create()->month($item->bulan)->format('F');
            $values[] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengguna',
                    'data' => $values,
                    'borderColor' => '#10b981', // warna garis (hijau tailwind)
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'fill' => true,
                    'tension' => 0.4, // melengkungkan garis
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
