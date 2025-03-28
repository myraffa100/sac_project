<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class ViewMember extends ViewRecord
{
    protected static string $resource = MemberResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('👤 Informasi Member')
                ->description('Detail lengkap tentang member.')
                ->schema([
                    ImageEntry::make('foto')
                        ->label(' ')
                        ->circular()
                        ->size(160)
                        ->extraAttributes([
                            'class' => 'flex justify-center items-center mx-auto',
                        ]),

                    TextEntry::make('nama')
                        ->label('Nama Lengkap')
                        ->icon('heroicon-o-user')
                        ->color('primary')
                        ->weight('bold')
                        ->size('xl')
                        ->extraAttributes(['class' => 'text-center']),

                    TextEntry::make('status_keanggotaan')
                        ->label('Status Keanggotaan')
                        ->icon('heroicon-o-check-circle')
                        ->badge()
                        ->formatStateUsing(fn($state) => $state === 'aktif' ? '✅ Aktif' : '❌ Nonaktif')
                        ->color(fn($state) => $state === 'aktif' ? 'success' : 'danger')
                        ->extraAttributes(['class' => 'text-center']),
                ])
                ->columns(1)
                ->extraAttributes(['class' => 'bg-white p-6 rounded-lg shadow-md text-center'])
                ->collapsible(),

            Section::make('📞 Detail Kontak')
                ->description('Informasi kontak dan alamat member.')
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
                ->columns(2)
                ->extraAttributes(['class' => 'bg-gray-50 p-4 rounded-lg shadow-sm'])
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
