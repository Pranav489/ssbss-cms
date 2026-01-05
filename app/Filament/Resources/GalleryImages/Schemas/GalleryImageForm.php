<?php

namespace App\Filament\Resources\GalleryImages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\GalleryImage;
use Filament\Forms\Components\RichEditor;

class GalleryImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Image Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->helperText('Optional title for the image'),
                        
                        Forms\Components\Textarea::make('description')
                            ->rows(2)
                            ->maxLength(500)
                            ->helperText('Brief description of the image'),
                        
                        Forms\Components\Select::make('category')
                            ->options(GalleryImage::availableCategories())
                            ->searchable()
                            ->nullable()
                            ->helperText('Optional category for filtering'),
                        
                        Forms\Components\TextInput::make('image_alt')
                            ->label('Alt Text')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Describe the image for accessibility (required)'),
                    ])->columns(2),
                
                Section::make('Image Upload')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Gallery Image')
                            ->required()
                            ->image()
                            ->disk('uploads')
                            ->directory('gallery')
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth(1920)
                            ->imageResizeTargetHeight(1080)
                            ->maxSize(5120) // 5MB
                            ->helperText('Recommended size: 1920x1080px, Max: 5MB')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->rules(['image', 'mimes:jpeg,png,jpg,webp', 'max:5120']),
                        
                        Forms\Components\Placeholder::make('image_preview')
                            ->label('Current Image')
                            ->content(function ($record) {
                                if (!$record) return 'No image uploaded';
                                
                                $html = '<div style="margin-top: 10px;">';
                                $html .= '<img src="' . $record->image_url . '" style="max-width: 200px; border-radius: 8px; border: 1px solid #e5e7eb;" alt="' . $record->image_alt . '">';
                                $html .= '</div>';
                                
                                return $html;
                            })
                            ->hidden(fn ($operation) => $operation === 'create')
                            ->columnSpanFull(),
                    ]),
                
                Section::make('Display Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Show this image in the gallery'),
                        
                        Forms\Components\Toggle::make('featured')
                            ->label('Featured')
                            ->default(false)
                            ->helperText('Highlight this image in featured section'),
                    ])->columns(3),
            ]);
    }
}
