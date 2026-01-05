<?php

namespace App\Filament\Resources\Missions\Pages;

use App\Filament\Resources\Missions\MissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMission extends CreateRecord
{
    protected static string $resource = MissionResource::class;

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
