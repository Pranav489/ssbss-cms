<?php

namespace App\Filament\Resources\JoinMissions\Pages;

use App\Filament\Resources\JoinMissions\JoinMissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJoinMissions extends ListRecords
{
    protected static string $resource = JoinMissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Create Join Our Mission Section'),
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
