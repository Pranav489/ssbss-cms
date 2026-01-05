<?php

namespace App\Filament\Resources\ProgramPages\Pages;

use App\Filament\Resources\ProgramPages\ProgramPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramPages extends ListRecords
{
    protected static string $resource = ProgramPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
