<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class MemberStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        $totalMembers = Member::count();
        $activeMembers = Member::where('status_keanggotaan', 'aktif')->count();
        $inactiveMembers = Member::where('status_keanggotaan', 'nonaktif')->count();

        return [
            Card::make('Total Anggota', number_format($totalMembers))
                ->icon('heroicon-o-users')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'p-4 shadow-md rounded-lg bg-gray-100',
                ]),

            Card::make('Anggota Aktif', number_format($activeMembers))
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->extraAttributes([
                    'class' => 'p-4 shadow-md rounded-lg bg-green-100',
                ]),

            Card::make('Anggota Tidak Aktif', number_format($inactiveMembers))
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'p-4 shadow-md rounded-lg bg-red-100',
                ]),
        ];
    }
}
