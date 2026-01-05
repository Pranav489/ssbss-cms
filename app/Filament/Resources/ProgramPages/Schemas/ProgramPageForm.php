<?php

namespace App\Filament\Resources\ProgramPages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\ProgramPage;
use Filament\Forms\Components\RichEditor;

class ProgramPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Program Page Content')
                    ->tabs([
                        Tab::make('Basic Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Page Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                $set('slug', Str::slug($state));
                                            }),

                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->helperText('URL-friendly version of the title'),

                                        Forms\Components\Select::make('category')
                                            ->options(ProgramPage::availableCategories())
                                            ->required()
                                            ->searchable(),

                                        Forms\Components\Select::make('category_icon')
                                            ->options(ProgramPage::availableCategoryIcons())
                                            ->searchable()
                                            ->helperText('Icon for category display'),

                                        Forms\Components\TextInput::make('tagline')
                                            ->maxLength(255)
                                            ->helperText('Short tagline that appears below the title'),
                                    ])->columns(2),

                                Section::make('Hero Section')
                                    ->schema([
                                        Forms\Components\FileUpload::make('hero_image')
                                            ->label('Hero Image')
                                            ->image()
                                            ->disk('uploads')
                                            ->directory('program-pages')
                                            ->imageEditor()
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('16:9')
                                            ->maxSize(2048),

                                        Forms\Components\TextInput::make('hero_alt')
                                            ->label('Hero Image Alt Text')
                                            ->maxLength(255)
                                            ->requiredWith('hero_image'),

                                        // For hero_stats field (update it like this):
                                        Forms\Components\Repeater::make('hero_stats')
                                            ->label('Hero Statistics')
                                            ->schema([
                                                Forms\Components\TextInput::make('value')
                                                    ->required()
                                                    ->maxLength(50),
                                                Forms\Components\TextInput::make('label')
                                                    ->required()
                                                    ->maxLength(100),
                                            ])
                                            ->defaultItems(0)
                                            ->maxItems(4)
                                            ->columns(2)
                                            ->collapsible()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),
                                    ])->columns(2),

                                // Replace the Overview section with:
                                Section::make('Overview')
                                    ->schema([
                                        Forms\Components\Repeater::make('overview')
                                            ->label('Overview Content')
                                            ->schema([
                                                Forms\Components\Textarea::make('content')
                                                    ->label('Paragraph')
                                                    ->required()
                                                    ->rows(3)
                                                    ->helperText('Each paragraph will be displayed separately')
                                                    ->columnSpanFull(),
                                            ])
                                            ->defaultItems(0)
                                            ->grid(1)
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                // Ensure we return an array
                                                return is_array($state) ? $state : [];
                                            }),
                                    ]),
                            ]),

                        Tab::make('Content Sections')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Location Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('location')
                                            ->maxLength(255),

                                        Forms\Components\Textarea::make('address')
                                            ->rows(2),

                                        Forms\Components\TextInput::make('coordinates')
                                            ->helperText('Latitude,Longitude for Google Maps'),

                                        Forms\Components\Textarea::make('google_maps_embed')
                                            ->rows(3)
                                            ->helperText('Paste Google Maps embed code'),

                                        Forms\Components\FileUpload::make('featured_image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->disk('uploads')
                                            ->directory('program-pages')
                                            ->imageEditor(),

                                        Forms\Components\TextInput::make('featured_image_alt')
                                            ->label('Featured Image Alt Text')
                                            ->maxLength(255)
                                            ->requiredWith('featured_image'),
                                    ])->columns(2),

                                Section::make('Registration & Highlights')
                                    ->schema([
                                        Forms\Components\TextInput::make('registration_number')
                                            ->maxLength(100),

                                        Forms\Components\TextInput::make('registration_authority')
                                            ->maxLength(255),

                                        Forms\Components\Repeater::make('highlights')
                                            ->schema([
                                                Forms\Components\TextInput::make('highlight')
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->defaultItems(0)
                                            ->collapsible()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),
                                    ]),

                                Section::make('Statistics')
                                    ->schema([
                                        Forms\Components\Repeater::make('statistics')
                                            ->schema([
                                                Forms\Components\TextInput::make('value')
                                                    ->required()
                                                    ->maxLength(50),
                                                Forms\Components\TextInput::make('label')
                                                    ->required()
                                                    ->maxLength(100),
                                            ])
                                            ->defaultItems(0)
                                            ->columns(2)
                                            ->collapsible()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),
                                    ]),
                            ]),

                        Tab::make('Detailed Sections')
                            ->icon('heroicon-o-view-columns')
                            ->schema([
                                // Categories Section
                                Section::make('Categories/Types')
                                    ->schema([
                                        Forms\Components\TextInput::make('categories_title')
                                            ->maxLength(255)
                                            ->default('Categories'),

                                        Forms\Components\Textarea::make('categories_description')
                                            ->rows(2),

                                        Forms\Components\Repeater::make('categories')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required()
                                                    ->maxLength(100),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2)
                                                    ->maxLength(500),
                                                Forms\Components\TextInput::make('icon_emoji')
                                                    ->maxLength(10)
                                                    ->helperText('Emoji icon'),
                                                Forms\Components\Textarea::make('eligibility')
                                                    ->rows(2)
                                                    ->maxLength(500),
                                            ])
                                            ->defaultItems(0)
                                            ->grid(2)
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),
                                    ]),

                                // Services Section
                                Section::make('Services & Facilities')
                                    ->schema([
                                        Forms\Components\TextInput::make('services_title')
                                            ->maxLength(255)
                                            ->default('Our Services'),

                                        Forms\Components\Textarea::make('services_description')
                                            ->rows(2),

                                        Forms\Components\Repeater::make('services')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required()
                                                    ->maxLength(100),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2)
                                                    ->maxLength(500),
                                                Forms\Components\Textarea::make('details')
                                                    ->rows(2)
                                                    ->maxLength(1000)
                                                    ->helperText('Detailed description'),
                                                Forms\Components\Select::make('icon')
                                                    ->options(ProgramPage::availableServiceIcons())
                                                    ->searchable(),
                                                Forms\Components\Select::make('color')
                                                    ->options(ProgramPage::availableServiceColors())
                                                    ->default('blue'),
                                                Forms\Components\Textarea::make('eligibility')
                                                    ->rows(2)
                                                    ->maxLength(500),
                                            ])
                                            ->defaultItems(0)
                                            ->grid(2)
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),
                                    ]),

                                // Process Steps
                                Section::make('Process & Timeline')
                                    ->schema([
                                        Forms\Components\TextInput::make('process_title')
                                            ->maxLength(255)
                                            ->default('How It Works'),

                                        Forms\Components\Textarea::make('process_description')
                                            ->rows(2),

                                        Forms\Components\Repeater::make('process_steps')
                                            ->schema([
                                                Forms\Components\TextInput::make('step_number')
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('title')
                                                    ->required()
                                                    ->maxLength(100),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2)
                                                    ->maxLength(500),
                                                Forms\Components\TextInput::make('duration')
                                                    ->maxLength(50)
                                                    ->helperText('e.g., "1-2 days", "Immediate"'),
                                            ])
                                            ->defaultItems(0)
                                            ->grid(2)
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),

                                        Forms\Components\Textarea::make('process_note')
                                            ->rows(2)
                                            ->helperText('Additional notes about the process'),
                                    ]),
                            ]),

                        Tab::make('Documents & Media')
                            ->icon('heroicon-o-folder')
                            ->schema([
                                // Required Documents
                                Section::make('Required Documents')
                                    ->schema([
                                        Forms\Components\Repeater::make('required_documents')
                                            ->schema([
                                                Forms\Components\TextInput::make('document')
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->defaultItems(0)
                                            ->collapsible()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),

                                        Forms\Components\Textarea::make('documents_note')
                                            ->rows(2)
                                            ->helperText('Additional notes about documents'),
                                    ]),

                                // Success Stories
                                Section::make('Success Stories')
                                    ->schema([
                                        Forms\Components\Repeater::make('success_stories')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required()
                                                    ->maxLength(100),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2)
                                                    ->maxLength(500),
                                                Forms\Components\TextInput::make('benefit')
                                                    ->maxLength(255)
                                                    ->helperText('Key benefit/outcome'),
                                                Forms\Components\FileUpload::make('image_url')
                                                    ->label('Image')
                                                    ->image()
                                                    ->disk('uploads')
                                                    ->directory('program-pages/stories'),
                                                Forms\Components\TextInput::make('alt')
                                                    ->label('Image Alt Text')
                                                    ->maxLength(255)
                                                    ->requiredWith('image_url'),
                                            ])
                                            ->defaultItems(0)
                                            ->grid(2)
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),
                                    ]),

                                // Gallery
                                Section::make('Gallery')
                                    ->schema([
                                        Forms\Components\TextInput::make('gallery_title')
                                            ->maxLength(255)
                                            ->default('Gallery'),

                                        Forms\Components\Textarea::make('gallery_description')
                                            ->rows(2),

                                        Forms\Components\Repeater::make('gallery')
                                            ->schema([
                                                Forms\Components\FileUpload::make('url')
                                                    ->label('Image')
                                                    ->image()
                                                    ->disk('uploads')
                                                    ->directory('program-pages/gallery'),
                                                Forms\Components\TextInput::make('alt')
                                                    ->label('Alt Text')
                                                    ->maxLength(255)
                                                    ->requiredWith('url'),
                                                Forms\Components\TextInput::make('caption')
                                                    ->maxLength(255),
                                            ])
                                            ->defaultItems(0)
                                            ->grid(2)
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->mutateDehydratedStateUsing(function ($state) {
                                                return is_array($state) ? $state : [];
                                            }),
                                    ]),
                            ]),

                        Tab::make('Contact & Settings')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                // Contact Information
                                Section::make('Contact Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('contact_title')
                                            ->maxLength(255)
                                            ->default('Contact Us'),

                                        Forms\Components\Textarea::make('contact_description')
                                            ->rows(2),

                                        Forms\Components\TextInput::make('contact_phone')
                                            ->tel()
                                            ->maxLength(20),

                                        Forms\Components\TextInput::make('contact_email')
                                            ->email()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('contact_hours')
                                            ->maxLength(100)
                                            ->helperText('e.g., "Mon-Fri, 9AM-5PM"'),
                                    ])->columns(2),

                                // Settings
                                Section::make('Settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->default(true)
                                            ->helperText('Show this program page on the website'),

                                        Forms\Components\Placeholder::make('preview_link')
                                            ->label('Preview Link')
                                            ->content(function ($record) {
                                                if ($record) {
                                                    // Point to your React app URL
                                                    return 'http://localhost:5173/programs/' . $record->slug;
                                                }
                                                return 'Save first to generate preview link';
                                            })
                                            ->columnSpanFull(),
                                    ])->columns(2),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}
