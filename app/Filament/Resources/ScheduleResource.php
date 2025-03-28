<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\Member;
use App\Models\Coach;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                    ->label('Member')
                    ->options(fn() => Member::pluck('nama', 'id')->toArray())
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('coach_id')
                    ->label('Coach')
                    ->options(fn() => Coach::pluck('nama', 'id')->toArray())
                    ->searchable()
                    ->required(),

                    Forms\Components\Select::make('hari')
                    ->label('Training Day')
                    ->options([
                        'Monday' => 'Monday',
                        'Tuesday' => 'Tuesday',
                        'Wednesday' => 'Wednesday',
                        'Thursday' => 'Thursday',
                        'Friday' => 'Friday',
                        'Saturday' => 'Saturday',
                        'Sunday' => 'Sunday',
                    ])
                    ->required(),
                
                Forms\Components\Select::make('sesi')
                    ->label('Sesi')
                    ->options([
                        'pagi' => 'Sesi Pagi (08:00 - 10:00)',
                        'sore' => 'Sesi Sore (16:00 - 17:30)',
                    ])
                    ->default('sore')
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->default(Carbon::now())
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Berakhir')
                    ->default(fn($get) => Carbon::parse($get('start_date'))->addMonth())

                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('member.nama')
                    ->label('Member')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('coach.nama')
                    ->label('Coach')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('hari')
                    ->label('Hari Latihan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sesi')
                    ->label('Sesi')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state === 'pagi' ? 'Sesi Pagi (08:00 - 10:00)' : 'Sesi Sore (16:00 - 17:30)'),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Berakhir')
                    ->date(),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
            'view' => Pages\ViewSchedule::route('/{record}'),
        ];
    }
}
