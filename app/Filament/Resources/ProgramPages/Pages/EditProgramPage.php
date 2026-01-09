<?php

namespace App\Filament\Resources\ProgramPages\Pages;

use App\Filament\Resources\ProgramPages\ProgramPageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramPage extends EditRecord
{
    protected static string $resource = ProgramPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
