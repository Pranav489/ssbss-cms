<?php

namespace App\Filament\Resources\JoinMissions;

use App\Filament\Resources\JoinMissions\Pages\CreateJoinMission;
use App\Filament\Resources\JoinMissions\Pages\EditJoinMission;
use App\Filament\Resources\JoinMissions\Pages\ListJoinMissions;
use App\Filament\Resources\JoinMissions\Schemas\JoinMissionForm;
use App\Filament\Resources\JoinMissions\Tables\JoinMissionsTable;
use App\Models\JoinMission;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JoinMissionResource extends Resource
{
    protected static ?string $model = JoinMission::class;
    protected static string|UnitEnum|null $navigationGroup = 'Home Page';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Join Our Mission';
    protected static ?string $modelLabel = 'Join Our Mission Section';
    protected static ?string $pluralModelLabel = 'Join Our Mission Section';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHandRaised;

    public static function form(Schema $schema): Schema
    {
        return JoinMissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JoinMissionsTable::configure($table);
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
            'index' => ListJoinMissions::route('/'),
            'create' => CreateJoinMission::route('/create'),
            'edit' => EditJoinMission::route('/{record}/edit'),
            // 'view' => ViewJoinMission::route('/{record}'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->limit(1);
    }
}
