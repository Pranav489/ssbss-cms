<?php

namespace App\Filament\Resources\Missions;

use App\Filament\Resources\Missions\Pages\CreateMission;
use App\Filament\Resources\Missions\Pages\EditMission;
use App\Filament\Resources\Missions\Pages\ListMissions;
use App\Filament\Resources\Missions\Schemas\MissionForm;
use App\Filament\Resources\Missions\Tables\MissionsTable;
use App\Models\Mission;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MissionResource extends Resource
{
    protected static ?string $model = Mission::class;
     protected static string|UnitEnum|null $navigationGroup = 'Home Page';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Our Mission';
    protected static ?string $modelLabel = 'Mission Section';
    protected static ?string $pluralModelLabel = 'Mission Section';
    
    // Make it a singleton resource
    protected static bool $shouldRegisterNavigation = true;
    protected static bool $isScopedToTenant = false;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFlag;

    public static function form(Schema $schema): Schema
    {
        return MissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MissionsTable::configure($table);
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
            'index' => ListMissions::route('/'),
            'create' => CreateMission::route('/create'),
            'edit' => EditMission::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->limit(1);
    }
}
