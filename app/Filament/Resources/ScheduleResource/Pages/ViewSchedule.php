<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Group;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class ViewSchedule extends ViewRecord
{
    protected static string $resource = ScheduleResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Detail Jadwal Latihan')
                ->description('Informasi jadwal latihan member.')
                ->schema([
                    TextEntry::make('member.nama')
                        ->label('Nama Member')
                        ->color('primary')
                        ->weight('bold')
                        ->size('lg'),

                    TextEntry::make('hari')
                        ->label('Hari Latihan')
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

                    Group::make([
                        TextEntry::make('start_date')
                            ->label('Tanggal Mulai')
                            ->date()
                            ->color('info'),

                        TextEntry::make('end_date')
                            ->label('Tanggal Berakhir')
                            ->date()
                            ->color('warning'),
                    ])->columns(2),
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
