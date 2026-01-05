<?php

namespace App\Filament\Resources\ContactInquiries\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\ContactInquiry;

class ContactInquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inquiry Information')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->options(ContactInquiry::availableTypes())
                            ->required()
                            ->reactive(),
                        
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                        
                        Forms\Components\TextInput::make('subject')
                            ->maxLength(255)
                            ->visible(fn ($get) => $get('type') === 'general'),
                        
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),
                
                Section::make('Donation Details')
                    ->schema([
                        Forms\Components\Select::make('donation_type')
                            ->options(ContactInquiry::availableDonationTypes())
                            ->visible(fn ($get) => $get('type') === 'donation'),
                        
                        Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->prefix('₹')
                            ->visible(fn ($get) => $get('type') === 'donation'),
                        
                        Forms\Components\Select::make('purpose')
                            ->options(ContactInquiry::availablePurposes())
                            ->visible(fn ($get) => $get('type') === 'donation'),
                    ])->columns(3)
                    ->visible(fn ($get) => $get('type') === 'donation'),
                
                Section::make('Administration')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options(ContactInquiry::availableStatuses())
                            ->required()
                            ->default('pending'),
                        
                        Forms\Components\Select::make('assigned_to')
                            ->relationship('assignedTo', 'name')
                            ->searchable()
                            ->preload(),
                        
                        Forms\Components\Textarea::make('admin_notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
                
                Section::make('Metadata')
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('user_agent')
                            ->disabled()
                            ->columnSpanFull(),
                        
                        Forms\Components\KeyValue::make('metadata')
                            ->disabled(),
                    ])->columns(2)
                    ->collapsed(),
            ]);
    }
}
