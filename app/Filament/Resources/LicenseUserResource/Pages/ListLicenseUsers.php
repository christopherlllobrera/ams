<?php

namespace App\Filament\Resources\LicenseUserResource\Pages;

use App\Filament\Resources\LicenseUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLicenseUsers extends ListRecords
{
    protected static string $resource = LicenseUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create New'),
        ];
    }
}
