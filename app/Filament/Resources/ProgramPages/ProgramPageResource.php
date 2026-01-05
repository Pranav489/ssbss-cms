<?php

namespace App\Filament\Resources\ProgramPages;

use App\Filament\Resources\ProgramPages\Pages\CreateProgramPage;
use App\Filament\Resources\ProgramPages\Pages\EditProgramPage;
use App\Filament\Resources\ProgramPages\Pages\ListProgramPages;
use App\Filament\Resources\ProgramPages\Schemas\ProgramPageForm;
use App\Filament\Resources\ProgramPages\Tables\ProgramPagesTable;
use App\Models\ProgramPage;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProgramPageResource extends Resource
{
    protected static ?string $model = ProgramPage::class;
    protected static string|UnitEnum|null $navigationGroup = 'Website Content';
    // protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Program Page';
    protected static ?string $pluralModelLabel = 'Program Pages';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function form(Schema $schema): Schema
    {
        return ProgramPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramPagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProgramPages::route('/'),
            'create' => CreateProgramPage::route('/create'),
            'edit' => EditProgramPage::route('/{record}/edit'),
        ];
    }
}
