<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoachesResource\Pages;
use App\Models\Coach;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class CoachesResource extends Resource
{
    protected static ?string $model = Coach::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Pelatih';
    protected static ?string $navigationGroup = 'Manajemen Klub';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Pelatih')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama lengkap')
                    ->columnSpanFull(),

                TextInput::make('nomor_hp')
                    ->label('Nomor HP')
                    ->tel()
                    ->required()
                    ->maxLength(15)
                    ->prefixIcon('heroicon-o-phone')
                    ->placeholder('08xxxxxxxxxx'),

                Select::make('spesialisasi')
                    ->label('Spesialisasi')
                    ->options([
                        'Regular' => 'Regular',
                        'Progresif' => 'Progresif',
                    ])
                    ->required()
                    ->searchable()
                    ->placeholder('Pilih spesialisasi'),

                FileUpload::make('foto')
                    ->label('Foto Profil')
                    ->image()
                    ->directory('uploads/coaches')
                    ->maxSize(2048)
                    ->columnSpanFull(),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn(string $state) => strtoupper($state))
                    ->color('primary'),

                TextColumn::make('nomor_hp')
                    ->label('Nomor HP')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('spesialisasi')
                    ->label('Spesialisasi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Regular' => 'Regular',
                        'Progresif' => 'Progresif',
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCoaches::route('/'),
            'create' => Pages\CreateCoaches::route('/create'),
            'edit' => Pages\EditCoaches::route('/{record}/edit'),
            'view' => Pages\ViewCoaches::route('/{record}'),
        ];
    }
}
