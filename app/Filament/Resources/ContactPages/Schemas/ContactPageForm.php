<?php

namespace App\Filament\Resources\ContactPages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\ContactPage;
class ContactPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Contact Page Content')
                    ->tabs([
                        Tabs\Tab::make('Headquarters')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Section::make('Headquarters Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('headquarters_title')
                                            ->default('Headquarters')
                                            ->maxLength(255),
                                        
                                        Forms\Components\Textarea::make('headquarters_address')
                                            ->required()
                                            ->rows(3)
                                            ->maxLength(500),
                                        
                                        Forms\Components\TextInput::make('headquarters_phone')
                                            ->required()
                                            ->maxLength(20),
                                        
                                        Forms\Components\TextInput::make('headquarters_email')
                                            ->required()
                                            ->email()
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('headquarters_hours')
                                            ->required()
                                            ->maxLength(100)
                                            ->helperText('e.g., Monday to Friday: 9:00 AM - 6:00 PM'),
                                    ])->columns(2),
                            ]),
                        
                        Tab::make('Centers & Locations')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Section::make('Centers')
                                    ->description('Add your various centers/locations')
                                    ->schema([
                                        Forms\Components\Repeater::make('centers')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(100),
                                                
                                                Forms\Components\Textarea::make('location')
                                                    ->required()
                                                    ->rows(2)
                                                    ->maxLength(500),
                                                
                                                Forms\Components\TextInput::make('phone')
                                                    ->required()
                                                    ->maxLength(20),
                                                
                                                Forms\Components\TextInput::make('email')
                                                    ->email()
                                                    ->maxLength(255),
                                                
                                                Forms\Components\Select::make('icon')
                                                    ->options(ContactPage::availableCenterIcons())
                                                    ->searchable(),
                                            ])
                                            ->defaultItems(0)
                                            ->grid(2)
                                            ->collapsible()
                                            ->cloneable()
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        Tab::make('Emergency Contact')
                            ->icon('heroicon-o-exclamation-triangle')
                            ->schema([
                                Section::make('Emergency Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('emergency_title')
                                            ->default('Emergency Contact')
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('child_helpline')
                                            ->required()
                                            ->maxLength(20)
                                            ->default('1098'),
                                        
                                        Forms\Components\TextInput::make('whatsapp_number')
                                            ->required()
                                            ->maxLength(20),
                                        
                                        Forms\Components\TextInput::make('emergency_email')
                                            ->required()
                                            ->email()
                                            ->maxLength(255),
                                        
                                        Forms\Components\Textarea::make('emergency_note')
                                            ->rows(2)
                                            ->maxLength(500)
                                            ->helperText('Additional information about emergency contacts'),
                                    ])->columns(2),
                                
                                Section::make('Quick Actions')
                                    ->description('Quick action buttons for users')
                                    ->schema([
                                        Forms\Components\Repeater::make('quick_actions')
                                            ->schema([
                                                Forms\Components\TextInput::make('label')
                                                    ->required()
                                                    ->maxLength(50),
                                                
                                                Forms\Components\Select::make('icon')
                                                    ->options(ContactPage::availableActionIcons())
                                                    ->searchable(),
                                                
                                                Forms\Components\Select::make('type')
                                                    ->options(ContactPage::availableActionTypes())
                                                    ->required(),
                                                
                                                Forms\Components\TextInput::make('value')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->helperText('Phone number, email, or URL'),
                                            ])
                                            ->defaultItems(0)
                                            ->maxItems(5)
                                            ->grid(2)
                                            ->collapsible()
                                            ->cloneable()
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        Tab::make('Contact Form')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Form Settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('form_title')
                                            ->default('Get In Touch')
                                            ->maxLength(255),
                                        
                                        Forms\Components\Textarea::make('form_description')
                                            ->rows(2)
                                            ->maxLength(500)
                                            ->helperText('Description shown above the form'),
                                        
                                        Forms\Components\TextInput::make('general_form_title')
                                            ->default('General Inquiry')
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('donation_form_title')
                                            ->default('Donation Inquiry')
                                            ->maxLength(255),
                                    ])->columns(2),
                            ]),
                        
                        Tab::make('Map & Location')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Section::make('Map Settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('map_title')
                                            ->default('Find Us')
                                            ->maxLength(255),
                                        
                                        Forms\Components\Textarea::make('google_maps_embed')
                                            ->rows(4)
                                            ->helperText('Paste Google Maps embed code'),
                                        
                                        Forms\Components\TextInput::make('coordinates')
                                            ->maxLength(100)
                                            ->helperText('Latitude,Longitude for maps'),
                                    ]),
                            ]),
                        
                        Tab::make('Settings')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true)
                                    ->helperText('Show contact page on website'),
                                
                                Forms\Components\Placeholder::make('preview_link')
                                    ->label('Preview Link')
                                    ->content(url('/contact'))
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }
}
