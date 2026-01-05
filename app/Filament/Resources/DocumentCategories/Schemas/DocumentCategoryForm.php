<?php

namespace App\Filament\Resources\DocumentCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\DocumentCategory;

class DocumentCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->helperText('URL-friendly version of the name'),
                        
                        Forms\Components\Select::make('icon')
                            ->options(DocumentCategory::availableIcons())
                            ->searchable()
                            ->helperText('Icon name for React component'),
                        
                        Forms\Components\Textarea::make('description')
                            ->rows(2)
                            ->maxLength(500),
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
                            ->helperText('Show this category on the website'),
                        
                        Forms\Components\Placeholder::make('documents_count')
                            ->label('Documents in this category')
                            ->content(fn ($record): string => $record ? $record->documents_count : '0')
                            ->hidden(fn ($operation) => $operation === 'create'),
                    ])->columns(3),
            ]);
    }
}
