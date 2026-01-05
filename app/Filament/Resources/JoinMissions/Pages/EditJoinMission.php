<?php

namespace App\Filament\Resources\JoinMissions\Pages;

use App\Filament\Resources\JoinMissions\JoinMissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJoinMission extends EditRecord
{
    protected static string $resource = JoinMissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
