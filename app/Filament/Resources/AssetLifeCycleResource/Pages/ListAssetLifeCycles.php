<?php

namespace App\Filament\Resources\AssetLifeCycleResource\Pages;

use App\Filament\Resources\AssetLifeCycleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetLifeCycles extends ListRecords
{
    protected static string $resource = AssetLifeCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
