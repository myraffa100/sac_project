<?php

namespace App\Filament\Resources\ScheduleCoachResource\Pages;

use App\Filament\Resources\ScheduleCoachResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Group;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class ViewScheduleCoach extends ViewRecord
{
    protected static string $resource = ScheduleCoachResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Detail Jadwal Coach')
                ->description('Informasi jadwal latihan coach.')
                ->schema([
                    TextEntry::make('coach.nama')
                        ->label('Nama Coach')
                        ->color('primary')
                        ->weight('bold')
                        ->size('lg'),

                    TextEntry::make('hari')
                        ->label('Hari Latihan')
                        ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state)
                        ->badge(),

                    TextEntry::make('sesi')
                        ->label('Sesi Latihan')
                        ->formatStateUsing(fn($state) => match ($state) {
                            'pagi' => 'Sesi Pagi (08:00 - 10:00)',
                            'sore' => 'Sesi Sore (16:00 - 17:30)',
                            'full_day' => 'Full Day (08:00 - 17:30)',
                            default => $state,
                        })
                        ->color(fn($state) => match ($state) {
                            'pagi' => 'info',
                            'sore' => 'success',
                            'full_day' => 'warning',
                            default => 'gray',
                        }),
                ])
                ->columns(1)
                ->collapsible(),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
