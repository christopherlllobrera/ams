<?php

namespace App\Filament\Resources\AssetLifeCycleResource\Pages;

use App\Filament\Resources\AssetLifeCycleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetLifeCycle extends EditRecord
{
    protected static string $resource = AssetLifeCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
