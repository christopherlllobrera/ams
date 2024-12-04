<?php

namespace App\Filament\Resources\AssetUserResource\Pages;

use App\Filament\Resources\AssetUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetUser extends EditRecord
{
    protected static string $resource = AssetUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
