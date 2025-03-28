<?php

namespace App\Filament\Resources\CoachesResource\Pages;

use App\Filament\Resources\CoachesResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class ViewCoaches extends ViewRecord
{
    protected static string $resource = CoachesResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('👤 Informasi Pelatih')
                ->description('Detail lengkap tentang pelatih.')
                ->schema([
                    ImageEntry::make('foto')
                        ->label(false)
                        ->circular()
                        ->size(160) // Ukuran lebih besar
                        ->extraAttributes([
                            'class' => 'flex justify-center items-center mx-auto', // Pusatkan di semua layar
                        ]),

                    TextEntry::make('nama')
                        ->label('Nama Lengkap')
                        ->icon('heroicon-o-user')
                        ->color('primary')
                        ->weight('bold')
                        ->size('xl')
                        ->extraAttributes(['class' => 'text-center']), // Pusatkan teks

                    TextEntry::make('spesialisasi')
                        ->label('Spesialisasi')
                        ->icon('heroicon-o-academic-cap')
                        ->badge()
                        ->color(fn($state) => $state === 'Renang' ? 'success' : 'warning')
                        ->extraAttributes(['class' => 'text-center']), // Pusatkan teks
                ])
                ->columns(1)
                ->extraAttributes(['class' => 'p-6 text-center flex flex-col ']) // Pastikan seluruh elemen berada di tengah
                ->collapsible(),

            Section::make('📞 Detail Kontak')
                ->description('Informasi kontak dan alamat pelatih.')
                ->schema([
                    TextEntry::make('nomor_hp')
                        ->label('📱 Nomor HP')
                        ->icon('heroicon-o-phone')
                        ->copyable()
                        ->color('info')
                        ->weight('bold')
                        ->extraAttributes(['class' => 'text-lg']),

                    TextEntry::make('alamat')
                        ->label('📍 Alamat')
                        ->icon('heroicon-o-map')
                        ->color('gray'),
                ])
                ->columns(2) // Lebih rapi
                ->extraAttributes(['class' => 'p-4 flex flex-col ']) // Pusatkan jika di mobile
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
