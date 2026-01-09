<?php

namespace App\Filament\Resources\ProgramPages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Form;
class ProgramPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Program Page')
                    ->tabs([
                        Tab::make('Basic Information')
                            ->schema([
                                Section::make('Basic Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->disabled(fn($context) => $context === 'edit'),
                                        Forms\Components\TextInput::make('tagline')
                                            ->required(),
                                        Forms\Components\Select::make('category')
                                            ->options([
                                                'welfare' => 'Welfare',
                                                'shelter' => 'Shelter',
                                                'adoption' => 'Adoption',
                                                'outreach' => 'Outreach',
                                            ])
                                            ->required(),
                                        Forms\Components\Select::make('category_icon')
                                            ->options([
                                                'Shield' => 'Shield',
                                                'Home' => 'Home',
                                                'Heart' => 'Heart',
                                                'Users' => 'Users',
                                                'Wallet' => 'Wallet',
                                            ])
                                            ->nullable(),
                                        Forms\Components\Textarea::make('overview')
                                            ->rows(4)
                                            ->required(),
                                    ])->columns(2),

                                Section::make('Location & Registration')
                                    ->schema([
                                        Forms\Components\TextInput::make('location')
                                            ->required(),
                                        Forms\Components\Textarea::make('address')
                                            ->rows(2),
                                        Forms\Components\TextInput::make('coordinates'),
                                        Forms\Components\TextInput::make('registration_number'),
                                        Forms\Components\TextInput::make('registration_authority'),
                                    ])->columns(2),

                                Section::make('Status')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->default(true)
                                            ->label('Active'),
                                        Forms\Components\TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                    ])->columns(2),
                            ]),

                        Tab::make('Media & Stats')
                            ->schema([
                                Section::make('Hero Section')
                                    ->schema([
                                        Forms\Components\FileUpload::make('hero_image')
                                            ->image()
                                            ->disk('uploads')
                                            ->directory('program-pages/hero')
                                            ->imageEditor(),
                                        Forms\Components\TextInput::make('hero_alt'),
                                        Forms\Components\Repeater::make('hero_stats')
                                            ->schema([
                                                Forms\Components\TextInput::make('value')
                                                    ->required(),
                                                Forms\Components\TextInput::make('label')
                                                    ->required(),
                                            ])
                                            ->defaultItems(0)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Statistics')
                                    ->schema([
                                        Forms\Components\Repeater::make('statistics')
                                            ->schema([
                                                Forms\Components\TextInput::make('value')
                                                    ->required(),
                                                Forms\Components\TextInput::make('label')
                                                    ->required(),
                                            ])
                                            ->defaultItems(0),
                                    ]),

                                Section::make('Highlights')
                                    ->schema([
                                        Forms\Components\TagsInput::make('highlights')
                                            ->placeholder('Add a highlight')
                                            ->separator(',')
                                            ->splitKeys(['Tab', 'Enter'])
                                            ->helperText('Press Enter or Tab after each highlight')
                                            ->reorderable(),
                                    ]),
                            ]),

                        Tab::make('Content Sections')
                            ->schema([
                                Section::make('Categories')
                                    ->schema([
                                        Forms\Components\TextInput::make('categories_title'),
                                        Forms\Components\Textarea::make('categories_description')
                                            ->rows(2),
                                        Forms\Components\Repeater::make('categories')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2),
                                                Forms\Components\Select::make('icon')
                                                    ->options([
                                                        'Home' => 'Home',
                                                        'Heart' => 'Heart',
                                                        'Users' => 'Users',
                                                        'Shield' => 'Shield',
                                                        'BookOpen' => 'Book Open',
                                                        'GraduationCap' => 'Graduation Cap',
                                                        'Briefcase' => 'Briefcase',
                                                        'Droplet' => 'Droplet',
                                                        'Apple' => 'Apple',
                                                        'Stethoscope' => 'Stethoscope',
                                                        'MessageCircle' => 'Message Circle',
                                                        'HandHeart' => 'Hand Heart',
                                                        'Building' => 'Building',
                                                        'MapPin' => 'Map Pin',
                                                        'Train' => 'Train',
                                                        'Bus' => 'Bus',
                                                        'ShoppingBag' => 'Shopping Bag',
                                                        'Church' => 'Church',
                                                        'Scales' => 'Scales',
                                                        'Wheelchair' => 'Wheelchair',
                                                        'FileText' => 'File Text',
                                                        'CheckCircle' => 'Check Circle',
                                                        'Search' => 'Search',
                                                        'MedicalCross' => 'Medical Cross',
                                                        'Wallet' => 'Wallet',
                                                        'Star' => 'Star',
                                                        'Target' => 'Target',
                                                        'Lightbulb' => 'Lightbulb',
                                                        'Rocket' => 'Rocket',
                                                        'Tree' => 'Tree',
                                                        'Sun' => 'Sun',
                                                    ])
                                                    ->searchable()
                                                    ->placeholder('Select an icon'),
                                                Forms\Components\TextInput::make('eligibility'),
                                            ])
                                            ->defaultItems(0)
                                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? null),
                                    ]),

                                Section::make('Services')
                                    ->schema([
                                        Forms\Components\TextInput::make('services_title'),
                                        Forms\Components\Textarea::make('services_description')
                                            ->rows(2),
                                        Forms\Components\Repeater::make('services')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2),
                                                Forms\Components\Textarea::make('details')
                                                    ->rows(2),
                                                Forms\Components\TextInput::make('icon'),
                                                Forms\Components\TextInput::make('color'),
                                                Forms\Components\TextInput::make('eligibility'),
                                            ])
                                            ->defaultItems(0),
                                    ]),
                            ]),

                        Tab::make('Process & Success')
                            ->schema([
                                Section::make('Process Steps')
                                    ->schema([
                                        Forms\Components\TextInput::make('process_title'),
                                        Forms\Components\Textarea::make('process_description')
                                            ->rows(2),
                                        Forms\Components\Repeater::make('process_steps')
                                            ->schema([
                                                Forms\Components\TextInput::make('step_number')
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2),
                                                Forms\Components\TextInput::make('duration'),
                                            ])
                                            ->defaultItems(0),
                                        Forms\Components\Textarea::make('process_note')
                                            ->rows(2),
                                    ]),

                                Section::make('Success Stories')
                                    ->schema([
                                        Forms\Components\Repeater::make('success_stories')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->rows(2),
                                                Forms\Components\TextInput::make('benefit'),
                                                Forms\Components\TextInput::make('image_url'),
                                                Forms\Components\TextInput::make('alt'),
                                            ])
                                            ->defaultItems(0),
                                    ]),
                            ]),

                        Tab::make('Gallery & Documents')
                            ->schema([
                                Section::make('Gallery')
                                    ->schema([
                                        Forms\Components\TextInput::make('gallery_title'),
                                        Forms\Components\Textarea::make('gallery_description')
                                            ->rows(2),
                                        Forms\Components\Repeater::make('gallery')
                                            ->schema([
                                                Forms\Components\FileUpload::make('url')
                                                ->image()
                                                ->disk(('uploads'))
                                                ->maxSize(2048),
                                                Forms\Components\TextInput::make('alt'),
                                                Forms\Components\TextInput::make('caption'),
                                            ])
                                            ->defaultItems(0),
                                    ]),

                                Section::make('Documents')
                                    ->schema([
                                        Forms\Components\Textarea::make('required_documents')
                                            ->rows(4),
                                        Forms\Components\Textarea::make('documents_note')
                                            ->rows(2),
                                    ]),
                            ]),

                        Tab::make('Contact Information')
                            ->schema([
                                Section::make('Contact Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('contact_title'),
                                        Forms\Components\Textarea::make('contact_description')
                                            ->rows(2),
                                        Forms\Components\TextInput::make('contact_phone'),
                                        Forms\Components\TextInput::make('contact_email')
                                            ->email(),
                                        Forms\Components\TextInput::make('contact_hours'),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
