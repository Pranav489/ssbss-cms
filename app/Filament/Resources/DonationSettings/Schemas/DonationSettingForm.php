<?php

namespace App\Filament\Resources\DonationSettings\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\DonationSetting;
class DonationSettingForm
{

protected static array $lucideIcons = [
        // Bank & Building Icons
        'Building' => 'Building (Bank)',
        'Bank' => 'Bank',
        'Home' => 'Home (Shelter)',
        'House' => 'House',
        'Building2' => 'Building 2',
        'Landmark' => 'Landmark',
        
        // People & Users
        'User' => 'User',
        'UserPlus' => 'User Plus',
        'UsersRound' => 'Users Round',
        'UserRound' => 'User Round',
        
        // Finance & Donation
        'CreditCard' => 'Credit Card',
        'Banknote' => 'Banknote (Money)',
        'Wallet' => 'Wallet',
        'Coins' => 'Coins',
        'IndianRupee' => 'Indian Rupee',
        'DollarSign' => 'Dollar Sign',
        
        // Calendar & Time
        'Calendar' => 'Calendar',
        'CalendarDays' => 'Calendar Days',
        'Clock' => 'Clock',
        'CalendarClock' => 'Calendar Clock',
        
        // Security & Trust
        'Shield' => 'Shield (Security)',
        'ShieldCheck' => 'Shield Check',
        'Lock' => 'Lock',
        'LockKeyhole' => 'Lock Keyhole',
        'Key' => 'Key',
        
        // Documents & Files
        'FileText' => 'File Text (Document)',
        'File' => 'File',
        'Folder' => 'Folder',
        'Archive' => 'Archive',
        'BookOpen' => 'Book Open',
        
        // Communication
        'Mail' => 'Mail (Email)',
        'Phone' => 'Phone',
        'MessageSquare' => 'Message Square',
        'MessageCircle' => 'Message Circle',
        
        // Location & Maps
        'MapPin' => 'Map Pin (Location)',
        'Navigation' => 'Navigation',
        'Globe' => 'Globe',
        'Map' => 'Map',
        
        // Impact & Stats
        'Heart' => 'Heart (Love)',
        'Star' => 'Star',
        'Trophy' => 'Trophy',
        'Award' => 'Award',
        'Medal' => 'Medal',
        'Target' => 'Target',
        
        // General Icons
        'CheckCircle' => 'Check Circle',
        'Info' => 'Info',
        'AlertCircle' => 'Alert Circle',
        'HelpCircle' => 'Help Circle',
        'Settings' => 'Settings',
        'Wrench' => 'Wrench',
        
        // Children & Care
        'Baby' => 'Baby',
        'Child' => 'Child',
        'Users' => 'Users',
        'HeartHandshake' => 'Heart Handshake',
        'HandHeart' => 'Hand Heart',
        
        // Education
        'GraduationCap' => 'Graduation Cap',
        'School' => 'School',
        'Pencil' => 'Pencil',
        
        // Health
        'Stethoscope' => 'Stethoscope',
        'HeartPulse' => 'Heart Pulse',
        'Cross' => 'Cross (Medical)',
        'FirstAid' => 'First Aid',
    ];
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Donation Page Settings')
                    ->tabs([
                        // Basic Information Tab
                        Tab::make('Basic Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Hero Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Page Title')
                                            ->default('Bank Transfer Details')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\Textarea::make('description')
                                            ->label('Hero Description')
                                            ->rows(3)
                                            ->required(),
                                        
                                        Forms\Components\FileUpload::make('hero_image')
                                            ->label('Hero Background Image')
                                            ->image()
                                            ->directory('donation-page')
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('16:9')
                                            ->imageResizeTargetWidth('1920')
                                            ->imageResizeTargetHeight('1080')
                                            ->helperText('Recommended size: 1920x1080px'),
                                    ]),
                                    
                                Section::make('Page Status')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Page Active')
                                            ->default(true)
                                            ->helperText('Toggle to show/hide donation page'),
                                    ]),
                            ]),
                            
                        // Bank Accounts Tab
                        Tab::make('Bank Accounts')
                            ->icon('heroicon-o-building-library')
                            ->schema([
                                Section::make('Bank Accounts')
                                    ->description('Add up to 3 bank accounts')
                                    ->schema([
                                        Forms\Components\Repeater::make('bank_accounts')
                                            ->label('')
                                            ->schema([
                                                Forms\Components\TextInput::make('account_name')
                                                    ->label('Account Name')
                                                    ->required()
                                                    ->maxLength(255),
                                                    
                                                Forms\Components\TextInput::make('bank_name')
                                                    ->label('Bank Name')
                                                    ->required()
                                                    ->maxLength(255),
                                                    
                                                Forms\Components\TextInput::make('account_number')
                                                    ->label('Account Number')
                                                    ->required()
                                                    ->maxLength(50),
                                                    
                                                Forms\Components\TextInput::make('ifsc_code')
                                                    ->label('IFSC Code')
                                                    ->required()
                                                    ->maxLength(20),
                                                    
                                                Forms\Components\Select::make('icon')
                                                    ->label('Lucide React Icon')
                                                    ->options(static::$lucideIcons)
                                                    ->searchable()
                                                    ->required()
                                                    ->default('Building'),
                                            ])
                                            ->defaultItems(3)
                                            ->minItems(1)
                                            ->maxItems(3)
                                            ->grid(2)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                            
                        // Donation Options Tab
                        Tab::make('Donation Options')
                            ->icon('heroicon-o-currency-rupee')
                            ->schema([
                                Section::make('Donation Options')
                                    ->description('Suggested donation amounts with impact descriptions')
                                    ->schema([
                                        Forms\Components\Repeater::make('donation_options')
                                            ->label('')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Option Title')
                                                    ->required()
                                                    ->maxLength(100),
                                                    
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Description')
                                                    ->rows(2)
                                                    ->required(),
                                                    
                                                Forms\Components\TextInput::make('amount')
                                                    ->label('Amount & Impact')
                                                    ->required()
                                                    ->maxLength(100),
                                                    
                                                Forms\Components\Select::make('icon')
                                                    ->label('Lucide React Icon')
                                                    ->options(static::$lucideIcons)
                                                    ->searchable()
                                                    ->required()
                                                    ->default('Banknote'),
                                            ])
                                            ->defaultItems(3)
                                            ->minItems(1)
                                            ->maxItems(5)
                                            ->grid(2)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                            
                        // Certifications Tab
                        Tab::make('Certifications')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Section::make('Certifications & Trust Badges')
                                    ->schema([
                                        Forms\Components\Repeater::make('certifications')
                                            ->label('')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Certification Title')
                                                    ->required()
                                                    ->maxLength(100),
                                                    
                                                Forms\Components\TextInput::make('description')
                                                    ->label('Description')
                                                    ->required()
                                                    ->maxLength(200),
                                                    
                                                Forms\Components\Select::make('icon')
                                                    ->label('Lucide React Icon')
                                                    ->options(static::$lucideIcons)
                                                    ->searchable()
                                                    ->required()
                                                    ->default('FileText'),
                                            ])
                                            ->defaultItems(4)
                                            ->minItems(1)
                                            ->maxItems(6)
                                            ->grid(2)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                            
                        // Impact Stats Tab
                        Tab::make('Impact Statistics')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Section::make('Impact Statistics')
                                    ->description('Stats to show in the impact section')
                                    ->schema([
                                        Forms\Components\Repeater::make('impact_stats')
                                            ->label('')
                                            ->schema([
                                                Forms\Components\TextInput::make('label')
                                                    ->label('Stat Label')
                                                    ->required()
                                                    ->maxLength(100),
                                                    
                                                Forms\Components\TextInput::make('value')
                                                    ->label('Stat Value')
                                                    ->required()
                                                    ->maxLength(50),
                                                    
                                                Forms\Components\Select::make('icon')
                                                    ->label('Lucide React Icon')
                                                    ->options(static::$lucideIcons)
                                                    ->searchable()
                                                    ->required()
                                                    ->default('Home'),
                                            ])
                                            ->defaultItems(4)
                                            ->minItems(1)
                                            ->maxItems(6)
                                            ->grid(2)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                            
                        // Instructions Tab
                        Tab::make('Instructions')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Donation Instructions')
                                    ->schema([
                                        Forms\Components\Repeater::make('instructions')
                                            ->label('')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Instruction Title')
                                                    ->required()
                                                    ->maxLength(100),
                                                    
                                                Forms\Components\Textarea::make('description')
                                                    ->label('Instruction Description')
                                                    ->rows(2)
                                                    ->required(),
                                                    
                                                Forms\Components\Select::make('icon')
                                                    ->label('Lucide React Icon')
                                                    ->options([
                                                        'CheckCircle' => 'Check Circle (✅)',
                                                        'Mail' => 'Mail (📧)',
                                                        'FileText' => 'File Text (📄)',
                                                        'Banknote' => 'Banknote (💰)',
                                                        'Clock' => 'Clock (⏰)',
                                                        'Lock' => 'Lock (🔒)',
                                                        'AlertCircle' => 'Alert Circle (⚠️)',
                                                        'Info' => 'Info (ℹ️)',
                                                        'HelpCircle' => 'Help Circle (❓)',
                                                        'Star' => 'Star (⭐)',
                                                        'Heart' => 'Heart (❤️)',
                                                        'ThumbsUp' => 'Thumbs Up (👍)',
                                                    ])
                                                    ->searchable()
                                                    ->required()
                                                    ->default('CheckCircle'),
                                            ])
                                            ->defaultItems(6)
                                            ->minItems(1)
                                            ->maxItems(10)
                                            ->grid(2)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
