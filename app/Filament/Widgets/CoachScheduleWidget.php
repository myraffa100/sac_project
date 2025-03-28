<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\CoachSchedule;
use Carbon\Carbon;

class CoachScheduleWidget extends Widget
{
    protected static ?int $sort = 3;
    protected static string $view = 'filament.widgets.coach-schedule-widget';
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $today = Carbon::now()->format('l'); // Ambil nama hari dalam bahasa Inggris
        $now = Carbon::today(); // Simpan tanggal hari ini sekali saja

        // Ambil jadwal pelatih yang aktif untuk hari ini
        $coachSchedules = CoachSchedule::whereJsonContains('hari', $today)
            ->where(function ($query) use ($now) {
                $query->whereDate('start_date', '<=', $now)
                      ->whereDate('end_date', '>=', $now);
            })
            ->with('coach')
            ->get();

        return [
            'coachSchedules' => $coachSchedules,
            'today' => $today
        ];
    }
}
