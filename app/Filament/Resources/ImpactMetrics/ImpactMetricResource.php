<?php

namespace App\Filament\Resources\ImpactMetrics;

use App\Filament\Resources\ImpactMetrics\Pages\CreateImpactMetric;
use App\Filament\Resources\ImpactMetrics\Pages\EditImpactMetric;
use App\Filament\Resources\ImpactMetrics\Pages\ListImpactMetrics;
use App\Filament\Resources\ImpactMetrics\Schemas\ImpactMetricForm;
use App\Filament\Resources\ImpactMetrics\Tables\ImpactMetricsTable;
use App\Models\ImpactMetric;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ImpactMetricResource extends Resource
{
    protected static ?string $model = ImpactMetric::class;
    protected static string | UnitEnum | null $navigationGroup = 'Home Page';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Impact Numbers';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    public static function form(Schema $schema): Schema
    {
        return ImpactMetricForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ImpactMetricsTable::configure($table);
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
            'index' => ListImpactMetrics::route('/'),
            'create' => CreateImpactMetric::route('/create'),
            'edit' => EditImpactMetric::route('/{record}/edit'),
        ];
    }
}
