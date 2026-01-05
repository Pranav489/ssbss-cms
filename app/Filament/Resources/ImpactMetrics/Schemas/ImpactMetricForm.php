<?php

namespace App\Filament\Resources\ImpactMetrics\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\ImpactMetric;

class ImpactMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Metric Information')
                    ->schema([
                        Forms\Components\TextInput::make('number')
                            ->required()
                            ->maxLength(50)
                            ->label('Number/Value (e.g., 275+, 13+)')
                            ->helperText('Include + sign if applicable'),
                        
                        Forms\Components\TextInput::make('label')
                            ->required()
                            ->maxLength(100)
                            ->label('Metric Label'),
                        
                        Forms\Components\Textarea::make('description')
                            ->rows(2)
                            ->maxLength(255)
                            ->label('Description/Subtext'),
                        
                        Forms\Components\Select::make('icon')
                            ->options(ImpactMetric::availableIcons())
                            ->required()
                            ->searchable()
                            ->helperText('Select icon name for React component'),
                    ])->columns(2),
                
                Section::make('Media & Link')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Background Image')
                            ->image()
                            ->directory('impact-metrics')
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('4:3')
                            ->maxSize(2048)
                            ->helperText('Optional background image'),
                        
                        Forms\Components\TextInput::make('image_alt')
                            ->label('Image Alt Text')
                            ->maxLength(255)
                            ->requiredWith('image_path'),
                        
                        Forms\Components\TextInput::make('project_link')
                            ->required()
                            ->maxLength(255)
                            ->label('Project Link/Slug')
                            ->helperText('e.g., /balsnehi, /about, /programs/...')
                            ->prefix('/'),
                    ]),
                
                Section::make('Display Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->inline(false),
                        
                        Forms\Components\Toggle::make('show_image')
                            ->label('Show Background Image')
                            ->default(true)
                            ->inline(false),
                        
                        Forms\Components\Toggle::make('highlight')
                            ->label('Highlight (Special Styling)')
                            ->default(false)
                            ->inline(false)
                            ->helperText('Apply special styling to this metric'),
                    ])->columns(2),
            ]);
    }
}
