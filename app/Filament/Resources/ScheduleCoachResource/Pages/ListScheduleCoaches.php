<?php

namespace App\Filament\Resources\ScheduleCoachResource\Pages;

use App\Filament\Resources\ScheduleCoachResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScheduleCoaches extends ListRecords
{
    protected static string $resource = ScheduleCoachResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
