<?php

namespace App\Filament\Resources\LicensesResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\LicensesResource;
use Livewire\Attributes\On;

class EditLicenses extends EditRecord
{
    protected static string $resource = LicensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getSaveFormAction()->formId('form')->label('Update'),
            $this->getCancelFormAction(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->hidden(),
            $this->getCancelFormAction()->hidden(),
        ];
    }
    #[On('refreshSeat')]
    public function refresh(): void
    {
    }
}
