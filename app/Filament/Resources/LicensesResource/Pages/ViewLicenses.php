<?php

namespace App\Filament\Resources\LicensesResource\Pages;

use App\Filament\Resources\LicensesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLicenses extends ViewRecord
{
    protected static string $resource = LicensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
