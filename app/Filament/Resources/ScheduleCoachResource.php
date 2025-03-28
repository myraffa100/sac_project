<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleCoachResource\Pages;
use App\Models\Coach;
use App\Models\CoachSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ScheduleCoachResource extends Resource
{
    protected static ?string $model = CoachSchedule::class;

    // Tambahkan ikon sidebar & label lebih menarik
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('coach_id')
                ->label('Coach')
                ->options(fn() => Coach::pluck('nama', 'id')->toArray())
                ->searchable()
                ->required(),

            Forms\Components\CheckboxList::make('hari')
                ->label('Training Days')
                ->options([
                    'Monday' => 'Monday',
                    'Tuesday' => 'Tuesday',
                    'Wednesday' => 'Wednesday',
                    'Thursday' => 'Thursday',
                    'Friday' => 'Friday',
                    'Saturday' => 'Saturday',
                    'Sunday' => 'Sunday',
                ])
                ->columns(2)
                ->required(),

            Forms\Components\Select::make('sesi')
                ->label('Sesi')
                ->options([
                    'pagi' => 'Sesi Pagi (08:00 - 10:00)',
                    'sore' => 'Sesi Sore (16:00 - 17:30)',
                    'full_day' => 'Full Day (08:00 - 17:30)',
                ])
                ->default('sore')
                ->required(),

            Forms\Components\Grid::make(2) // Grid dengan 2 kolom
                ->schema([
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Start Date')
                        ->required(),

                    Forms\Components\DatePicker::make('end_date')
                        ->label('End Date')
                        ->required(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('coach.nama')
                    ->label('Coach')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('hari')
                    ->label('Hari Latihan')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : strval($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('sesi')
                    ->label('Sesi')
                    ->sortable()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'pagi' => 'Sesi Pagi (08:00 - 10:00)',
                        'sore' => 'Sesi Sore (16:00 - 17:30)',
                        'full_day' => 'Full Day (08:00 - 17:30)',
                        default => ucfirst($state),
                    }),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScheduleCoaches::route('/'),
            'create' => Pages\CreateScheduleCoach::route('/create'),
            'edit' => Pages\EditScheduleCoach::route('/{record}/edit'),
            'view' => Pages\ViewScheduleCoach::route('/{record}'),
        ];
    }
}
