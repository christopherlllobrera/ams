<?php

namespace App\Filament\Resources\AssetModelResource\Pages;

use Filament\Actions;
use Filament\Pages\Page;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AssetModelResource;

class ListAssetModels extends ListRecords
{
    protected static string $resource = AssetModelResource::class;
    protected static ?string $title = 'Model';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create New'),
        ];
    }

}
