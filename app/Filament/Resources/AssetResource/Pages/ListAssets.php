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
            // 'Available' => Tab::make()->query(fn ($query) => $query->where('status', 'Available')),
            // 'Pending' => Tab::make()->query(fn ($query) => $query->where('status', 'Pending')),
            // 'Deployed' => Tab::make()->query(fn ($query) => $query->where('status', 'Deployed')),
            // 'Under Repair' => Tab::make()->query(fn ($query) => $query->where('status', 'Under Repair')),
            // 'In Storage' => Tab::make()->query(fn ($query) => $query->where('status', 'In Storage')),
            // 'Missing' => Tab::make()->query(fn ($query) => $query->where('status', 'Missing')),
            // 'Stolen' => Tab::make()->query(fn ($query) => $query->where('status', 'Stolen')),
            // 'Rental' => Tab::make()->query(fn ($query) => $query->where('status', 'Rental')),
            // 'Donated' => Tab::make()->query(fn ($query) => $query->where('status', 'Donated')),
            // 'Disposed' => Tab::make()->query(fn ($query) => $query->where('status', 'Disposed')),
            // 'Out of Service' => Tab::make()->query(fn ($query) => $query->where('status', 'Out of Service')),
            // 'Sold' => Tab::make()->query(fn ($query) => $query->where('status', 'Sold')),

        ];
    }
}
