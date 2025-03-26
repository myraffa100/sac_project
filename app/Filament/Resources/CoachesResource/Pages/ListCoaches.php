<?php

namespace App\Filament\Resources\CoachesResource\Pages;

use App\Filament\Resources\CoachesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoaches extends ListRecords
{
    protected static string $resource = CoachesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
