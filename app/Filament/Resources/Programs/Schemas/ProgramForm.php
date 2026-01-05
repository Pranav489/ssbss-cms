<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Program;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Program Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('cta_link', \Illuminate\Support\Str::slug($state))),
                        
                        Forms\Components\TextInput::make('subtitle')
                            ->maxLength(255),
                        
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('icon')
                            ->options(Program::availableIcons())
                            ->required()
                            ->searchable()
                            ->helperText('Select icon name for React component'),
                    ])->columns(2),
                
                Section::make('Features')
                    ->description('List key features of the program')
                    ->schema([
                        Forms\Components\Repeater::make('features')
                            ->schema([
                                Forms\Components\TextInput::make('feature')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->defaultItems(0)
                            ->itemLabel(fn (array $state): ?string => $state['feature'] ?? null)
                            ->collapsible()
                            ->cloneable()
                            ->grid(2),
                    ])->collapsible(),
                
                Section::make('Statistics')
                    ->description('Add key statistics for the program')
                    ->schema([
                        Forms\Components\Repeater::make('stats')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->required()
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('value')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->defaultItems(0)
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->columns(2)
                            ->collapsible()
                            ->cloneable(),
                    ])->collapsible(),
                
                Section::make('Media & Link')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Program Image')
                            ->image()
                            ->directory('programs')
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->maxSize(2048),
                        
                        Forms\Components\TextInput::make('image_alt')
                            ->label('Image Alt Text')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('cta_link')
                            ->label('CTA Link/Slug')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Auto-generated from title, but can be customized')
                            ->prefix('/programs/'),
                    ])->columns(2),
                
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
                        
                        Forms\Components\Toggle::make('featured')
                            ->label('Featured Program')
                            ->default(false)
                            ->inline(false)
                            ->helperText('Highlight as featured program'),
                    ])->columns(3),
            ]);
    }
}
