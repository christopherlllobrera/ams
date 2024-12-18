<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateAsset extends CreateRecord
{
    protected static string $resource = AssetResource::class;
    protected static bool $canCreateAnother = false;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                 ->label('Save'),
            $this->getCancelFormAction()
                    ->label('Cancel'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Asset created')
            ->body('The asset ' . $this->record->company_number . 'has been created successfully.')
            ->sendToDatabase(auth()->user());
    }
}
