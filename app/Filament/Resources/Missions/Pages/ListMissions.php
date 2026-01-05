<?php

namespace App\Filament\Resources\Missions\Pages;

use App\Filament\Resources\Missions\MissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMissions extends ListRecords
{
    protected static string $resource = MissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Create Mission Section'),
        ];
    }

    // Redirect to edit if record exists
    public function mount(): void
    {
        $record = $this->getModel()::first();
        
        if ($record) {
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        }
    }
}
