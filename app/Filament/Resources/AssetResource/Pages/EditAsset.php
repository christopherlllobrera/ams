<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditAsset extends EditRecord
{
    protected static string $resource = AssetResource::class;

    public function getTitle(): string
    {
        return 'Update Asset: ' . $this->record->company_number;
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            // Actions\DeleteAction::make(),
            // $this->getSaveFormAction()->formId('form'),
            $this->getCancelFormAction(),
        ];
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Asset updated')
            ->body('The asset ' . $this->record->company_number . 'has been updated successfully.')
            ->sendToDatabase(auth()->user());
    }
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->hidden(),
            $this->getCancelFormAction()->hidden(),
        ];
    }
}
