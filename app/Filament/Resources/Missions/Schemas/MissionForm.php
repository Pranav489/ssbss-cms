<?php

namespace App\Filament\Resources\Missions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Mission;
use Filament\Forms\Components\RichEditor;

class MissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Mission Content')
                    ->schema([
                        Forms\Components\TextInput::make('heading')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Our Mission & Vision'),

                        RichEditor::make('content')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'blockquote',
                                'h2',
                                'h3',
                                'bulletList',
                                'orderedList',
                                'link',
                            ])
                            ->fileAttachmentsDirectory('mission')
                            ->columnSpanFull(),
                    ]),

                Section::make('Quick Stats')
                    ->description('Add up to 4 key statistics to highlight')
                    ->schema([
                        Forms\Components\Repeater::make('quick_stats')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('value')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\Select::make('icon')
                                    ->options(Mission::availableStatIcons())
                                    ->searchable(),

                                Forms\Components\ColorPicker::make('color')
                                    ->default('#3b82f6')
                                    ->helperText('Optional: Choose color for this stat'),
                            ])
                            ->defaultItems(0)
                            ->maxItems(4)
                            ->columns(2)
                            ->collapsible()
                            ->cloneable()
                            ->itemLabel(fn(array $state): ?string => $state['label'] ?? null),

                        Forms\Components\TextInput::make('districts_covered')
                            ->label('Districts Covered')
                            ->placeholder('Nashik, Ahmednagar, Palghar')
                            ->helperText('Separate multiple districts with commas')
                            ->maxLength(255),
                    ]),

                Section::make('Mission Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Featured Image')
                            ->image()
                            ->directory('mission')
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('4:3')
                            ->maxSize(2048),

                        Forms\Components\TextInput::make('image_alt')
                            ->label('Image Alt Text')
                            ->maxLength(255)
                            ->requiredWith('image_path'),
                    ])->collapsible(),

                Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Show this section on the website'),
                    ])
            ]);
    }
}
