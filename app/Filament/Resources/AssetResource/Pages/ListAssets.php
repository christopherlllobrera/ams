<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListAssets extends ListRecords
{
    protected static string $resource = AssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create New'),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'Available' => Tab::make()->query(function ($query) {
                return $query->whereHas('assetlifecycle', function ($query) {
                    $query->where('status', 'Available');
                });
            }),
            'Deployed' => Tab::make()->query(function ($query) {
                return $query->whereHas('assetlifecycle', function ($query) {
                    $query->where('status', 'Deployed');
                });
            }),
            'For Repair' => Tab::make()->query(function ($query) {
                return $query->whereHas('assetlifecycle', function ($query) {
                    $query->where('status', 'For Repair');
                });
            }),
            'Missing' => Tab::make()->query(function ($query) {
                return $query->whereHas('assetlifecycle', function ($query) {
                    $query->where('status', 'Missing');
                });
            }),
            'For Disposal' => Tab::make()->query(function ($query) {
                return $query->whereHas('assetlifecycle', function ($query) {
                    $query->where('status', 'For Disposal');
                });
            }),
            'Disposed' => Tab::make()->query(function ($query) {
                return $query->whereHas('assetlifecycle', function ($query) {
                    $query->where('status', 'Disposed');
                });
            }),
        ];
    }
}
