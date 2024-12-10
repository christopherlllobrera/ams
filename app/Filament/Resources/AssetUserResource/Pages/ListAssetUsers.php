<?php

namespace App\Filament\Resources\AssetUserResource\Pages;

use App\Filament\Resources\AssetUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetUsers extends ListRecords
{
    protected static string $resource = AssetUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create New'),
        ];
    }
}
