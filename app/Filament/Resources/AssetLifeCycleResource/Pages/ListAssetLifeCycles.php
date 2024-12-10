<?php

namespace App\Filament\Resources\AssetLifeCycleResource\Pages;

use App\Filament\Resources\AssetLifeCycleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetLifeCycles extends ListRecords
{
    protected static string $resource = AssetLifeCycleResource::class;

    protected static ?string $title = 'Status';
    protected static ?string $breadcrumb = 'Asset Status';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create New'),
        ];
    }
}
