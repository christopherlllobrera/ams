<?php

namespace App\Filament\Resources\ModelResource\Pages;

use App\Filament\Resources\ModelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModel extends CreateRecord
{
    protected static string $resource = ModelResource::class;
    protected static ?string $title = 'Create Asset Model';
    protected static bool $canCreateAnother = false;
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Save'),
            $this->getCancelFormAction(),
        ];
    }
}
