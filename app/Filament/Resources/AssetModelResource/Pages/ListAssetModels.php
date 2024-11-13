<?php

namespace App\Filament\Resources\AssetModelResource\Pages;

use App\Filament\Resources\AssetModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetModels extends ListRecords
{
    protected static string $resource = AssetModelResource::class;
    protected static ?string $title = 'Asset Model';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
