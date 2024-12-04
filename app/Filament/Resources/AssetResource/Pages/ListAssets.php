<?php

namespace App\Filament\Resources\AssetResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Blade;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\AssetResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\View\TablesRenderHook;

class ListAssets extends ListRecords
{
    protected static string $resource = AssetResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make()
    //             ->label('Create New'),
    //     ];
    // }
    public function mount(): void
    {
        FilamentView::registerRenderHook(
            TablesRenderHook::TOOLBAR_START,
            function () {
                return Blade::render('<x-filament::button tag="a" href="{{ $link }}">Create Asset</x-filament::button>', [
                    'link' => self::$resource::getUrl('create')
                ]);
            }
        );
        parent::mount();
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
