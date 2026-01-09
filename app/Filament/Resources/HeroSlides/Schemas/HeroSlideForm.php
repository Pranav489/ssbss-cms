<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\HeroSlide;
class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slide Information')
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
                            ->options(HeroSlide::availableIcons())
                            ->searchable()
                            ->helperText('Select icon name for React component'),
                        
                        Forms\Components\TextInput::make('stats')
                            ->label('Statistics/Stats Text')
                            ->maxLength(255),
                    ])->columns(2),
                
                Section::make('Media & Links')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Hero Image')
                            ->disk('uploads')
                            ->image()
                            ->directory('hero-slides'),
                        
                        Forms\Components\TextInput::make('image_alt')
                            ->label('Image Alt Text')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('cta_link')
                            ->label('CTA Link/Slug')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Auto-generated from title, but can be customized')
                            ->prefix('/programs/'),
                    ]),
                
                Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
