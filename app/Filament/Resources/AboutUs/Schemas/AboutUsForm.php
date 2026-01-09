<?php

namespace App\Filament\Resources\AboutUs\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\AboutUs;
use Filament\Forms\Components\RichEditor;

class AboutUsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Header Section')
                    ->schema([
                        Forms\Components\Textarea::make('header_description')
                            ->required()
                            ->rows(3)
                            ->maxLength(1000)
                            ->helperText('Brief introduction that appears at the top of the page')
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('header_stats')
                            ->label('Header Statistics')
                            ->schema([
                                Forms\Components\TextInput::make('heading')
                                    ->required()
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('number')
                                    ->required()
                                    ->maxLength(20),
                            ])
                            ->defaultItems(0)
                            ->maxItems(4)
                            ->columns(2)
                            ->collapsible()
                            ->cloneable()
                            ->helperText('Add key statistics to display in the header (max 4)')
                            ->columnSpanFull(),
                    ])->columnSpanFull(),

                // About Content Section
                Section::make('About Content')
                    ->schema([
                        RichEditor::make('about_content')
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
                            ->fileAttachmentsDirectory('about-us')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('about_image_path')
                            ->label('About Us Image')
                            ->disk('uploads')
                            ->image()
                            ->directory(directory: 'about-us')
                            ->maxSize(2048),

                        Forms\Components\TextInput::make('about_image_alt')
                            ->label('Image Alt Text')
                            ->maxLength(255)
                            ->requiredWith('about_image_path'),
                    ])->columns(2),

                // Registrations & Certifications
                Section::make('Registrations & Certifications')
                    ->description('List all legal registrations and certifications')
                    ->schema([
                        Forms\Components\Repeater::make('registrations')
                            ->schema([
                                Forms\Components\TextInput::make('certificate')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('number')
                                    ->required()
                                    ->maxLength(50),

                                Forms\Components\TextInput::make('date')
                                    ->maxLength(50),

                                Forms\Components\Select::make('icon')
                                    ->options(AboutUs::availableRegistrationIcons())
                                    ->searchable(),
                            ])
                            ->defaultItems(0)
                            ->columns(4)
                            ->collapsible()
                            ->cloneable()
                            ->grid(2)
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('show_registrations')
                            ->label('Show this section on page')
                            ->default(true)
                            ->inline(false),
                    ])->collapsible(),

                // Objectives
                Section::make('Objectives & Goals')
                    ->schema([
                        Forms\Components\Repeater::make('objectives')
                            ->schema([
                                Forms\Components\TextInput::make('objective')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->cloneable()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('show_objectives')
                            ->label('Show this section on page')
                            ->default(true)
                            ->inline(false),
                    ])->collapsible(),

                // Projects
                Section::make('Projects & Programs')
                    ->schema([
                        Forms\Components\Repeater::make('projects')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('location')
                                    ->maxLength(100),

                                Forms\Components\Textarea::make('description')
                                    ->rows(2)
                                    ->maxLength(255),

                                Forms\Components\Select::make('icon')
                                    ->options(AboutUs::availableProjectIcons())
                                    ->searchable(),
                            ])
                            ->defaultItems(0)
                            ->columns(2)
                            ->collapsible()
                            ->cloneable()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('show_projects')
                            ->label('Show this section on page')
                            ->default(true)
                            ->inline(false),
                    ])->collapsible(),

                // Team Members
                Section::make('Team Members')
                    ->description('Add executive committee members')
                    ->schema([
                        Forms\Components\Repeater::make('team_members')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('position')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\FileUpload::make('image_url')
                                    ->label('Profile Image')
                                    ->disk('uploads')
                                    ->image()
                                    ->directory('team-members')
                                    ->circleCropper(),
                                    // ->maxSize(1024),

                                Forms\Components\TextInput::make('image_alt')
                                    ->label('Image Alt Text')
                                    ->maxLength(255)
                                    ->requiredWith('image_url'),
                            ])
                            ->defaultItems(0)
                            ->columns(2)
                            ->collapsible()
                            ->cloneable()
                            ->grid(2)
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('show_team')
                            ->label('Show this section on page')
                            ->default(true)
                            ->inline(false),
                    ])->collapsible(),

                // Settings
                Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Page')
                            ->default(true)
                            ->helperText('Show the About Us page on the website'),

                        Forms\Components\Placeholder::make('stats')
                            ->label('Content Statistics')
                            ->content(function ($get) {
                                $stats = [];
                                $stats[] = 'Header Stats: ' . count($get('header_stats') ?? []);
                                $stats[] = 'Registrations: ' . count($get('registrations') ?? []);
                                $stats[] = 'Objectives: ' . count($get('objectives') ?? []);
                                $stats[] = 'Projects: ' . count($get('projects') ?? []);
                                $stats[] = 'Team Members: ' . count($get('team_members') ?? []);
                                return implode(' | ', $stats);
                            })
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
