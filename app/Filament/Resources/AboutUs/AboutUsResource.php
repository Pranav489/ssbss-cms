<?php

namespace App\Filament\Resources\AboutUs;

use App\Filament\Resources\AboutUs\Pages\CreateAboutUs;
use App\Filament\Resources\AboutUs\Pages\EditAboutUs;
use App\Filament\Resources\AboutUs\Pages\ListAboutUs;
use App\Filament\Resources\AboutUs\Schemas\AboutUsForm;
use App\Filament\Resources\AboutUs\Tables\AboutUsTable;
use App\Models\AboutUs;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;
    protected static string|UnitEnum|null $navigationGroup = 'About Page';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationLabel = 'About Us Page';
    protected static ?string $modelLabel = 'About Us Page';
    protected static ?string $pluralModelLabel = 'About Us Page';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    public static function form(Schema $schema): Schema
    {
        return AboutUsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutUsTable::configure($table);
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
            'index' => ListAboutUs::route('/'),
            'create' => CreateAboutUs::route('/create'),
            'edit' => EditAboutUs::route('/{record}/edit'),
            // 'view' => ViewAboutUs::route('/{record}'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->limit(1);
    }
}
