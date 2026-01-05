<?php

namespace App\Filament\Resources\JoinMissions\Pages;

use App\Filament\Resources\JoinMissions\JoinMissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJoinMission extends CreateRecord
{
    protected static string $resource = JoinMissionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Ensure only one record can exist
    protected function beforeCreate(): void
    {
        // Delete any existing record
        $this->getModel()::query()->delete();
    }
}
