<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\DailyScheduleWidget;
use App\Filament\Widgets\MemberStatsWidget;

class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [
            // MemberStatsWidget::class,  // Data Member
            // DailyScheduleWidget::class, // Schedule
        ];
    }
}

