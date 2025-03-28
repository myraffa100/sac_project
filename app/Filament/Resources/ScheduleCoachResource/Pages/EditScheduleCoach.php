<?php

namespace App\Filament\Resources\ScheduleCoachResource\Pages;

use App\Filament\Resources\ScheduleCoachResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScheduleCoach extends EditRecord
{
    protected static string $resource = ScheduleCoachResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
