<?php

namespace App\Filament\Resources\LicenseUserResource\Pages;

use App\Filament\Resources\LicenseUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLicenseUser extends EditRecord
{
    protected static string $resource = LicenseUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
