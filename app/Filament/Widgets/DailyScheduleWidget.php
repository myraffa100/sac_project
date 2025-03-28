<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Schedule;
use Carbon\Carbon;

class DailyScheduleWidget extends Widget
{
    protected static ?int $sort = 2;
    protected static string $view = 'filament.widgets.schedule-widget';

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $today = Carbon::now()->locale('en')->isoFormat('dddd');

        $now = Carbon::today(); // Tanggal hari ini (YYYY-MM-DD)

        $schedules = Schedule::where('hari', $today)
            ->whereDate('start_date', '<=', $now)  // Pastikan start_date sudah dimulai
            ->whereDate('end_date', '>=', $now)    // Pastikan masih dalam periode aktif
            ->with('member', 'coach')
            ->get();



        return [
            'schedules' => $schedules,
        ];
    }
}
