<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Document;
use Filament\Forms\Components\RichEditor;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Document Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(100),
                            ]),
                        
                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])->columns(2),
                
                Section::make('File Upload')
                ->schema([
                    Forms\Components\FileUpload::make('file_path')
                        ->label('Document File')
                        ->required()
                        ->preserveFilenames()
                        ->acceptedFileTypes([
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            'image/jpeg',
                            'image/png',
                            'application/zip',
                            'text/plain',
                        ])
                        ->maxSize(10240) // 10MB
                        ->disk('uploads')
                        ->directory('documents')
                        ->visibility('public')
                        ->helperText('Max file size: 10MB. Allowed: PDF, DOC, DOCX, XLS, XLSX, PPT, JPG, PNG, ZIP, TXT')
                        ->afterStateUpdated(function ($state, callable $set, $livewire) {
                            if ($state instanceof TemporaryUploadedFile) {
                                // Get file size from the uploaded file object
                                $size = $state->getSize();
                                $set('file_size', self::formatBytes($size));
                                
                                // Set file type based on extension
                                $extension = $state->getClientOriginalExtension();
                                $set('file_type', strtoupper($extension));
                                
                                // Set icon based on file type
                                $icons = [
                                    'pdf' => 'FileText',
                                    'doc' => 'FileText',
                                    'docx' => 'FileText',
                                    'xls' => 'FileSpreadsheet',
                                    'xlsx' => 'FileSpreadsheet',
                                    'ppt' => 'File',
                                    'pptx' => 'File',
                                    'jpg' => 'FileImage',
                                    'jpeg' => 'FileImage',
                                    'png' => 'FileImage',
                                    'zip' => 'FileArchive',
                                    'txt' => 'FileText',
                                ];
                                $set('icon', $icons[strtolower($extension)] ?? 'File');
                            }
                        })
                        ->reactive() // Add this to make it reactive
                        ->afterStateHydrated(function ($state, callable $set) {
                            // When editing existing document, set file type from database
                            if ($state && !$state instanceof TemporaryUploadedFile) {
                                $extension = pathinfo($state, PATHINFO_EXTENSION);
                                $set('file_type', strtoupper($extension));
                            }
                        }),
                    
                    Forms\Components\TextInput::make('file_name')
                        ->label('Display Name')
                        ->maxLength(255)
                        ->helperText('Optional: Custom name for download with extension (e.g., "Annual-Report-2024.pdf")'),
                    
                    // REMOVE the disabled() condition from file_type
                    Forms\Components\Select::make('file_type')
                        ->options(Document::availableFileTypes())
                        ->required()
                        ->default('PDF')
                        // Remove this line: ->disabled(fn ($get) => !empty($get('file_path')))
                        ->dehydrated() // Ensure it gets saved
                        ->afterStateHydrated(function ($state, callable $set, $get) {
                            // If file_type is empty but file_path exists, set it from file extension
                            if (empty($state) && $get('file_path')) {
                                $extension = pathinfo($get('file_path'), PATHINFO_EXTENSION);
                                $set('file_type', strtoupper($extension));
                            }
                        }),
                    
                    Forms\Components\TextInput::make('file_size')
                        ->label('File Size')
                        ->disabled()
                        ->dehydrated() // This ensures the value is saved to the database
                        ->helperText('Auto-calculated from uploaded file'),
                    
                    Forms\Components\Select::make('icon')
                        ->options(Document::availableIcons())
                        ->searchable()
                        ->helperText('Icon name for React component')
                        ->afterStateHydrated(function ($state, callable $set, $get) {
                            // If icon is empty but file_path exists, set it from file extension
                            if (empty($state) && $get('file_path')) {
                                $extension = pathinfo($get('file_path'), PATHINFO_EXTENSION);
                                $icons = [
                                    'pdf' => 'FileText',
                                    'doc' => 'FileText',
                                    'docx' => 'FileText',
                                    'xls' => 'FileSpreadsheet',
                                    'xlsx' => 'FileSpreadsheet',
                                    'ppt' => 'File',
                                    'pptx' => 'File',
                                    'jpg' => 'FileImage',
                                    'jpeg' => 'FileImage',
                                    'png' => 'FileImage',
                                    'zip' => 'FileArchive',
                                    'txt' => 'FileText',
                                ];
                                $set('icon', $icons[strtolower($extension)] ?? 'File');
                            }
                        }),
                ])->columns(2),
                
                Section::make('Metadata')
                    ->schema([
                        Forms\Components\DatePicker::make('upload_date')
                            ->required()
                            ->default(now()),
                        
                        Forms\Components\TextInput::make('download_count')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->helperText('Auto-incremented when downloaded'),
                        
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        
                        Forms\Components\Toggle::make('featured')
                            ->label('Featured')
                            ->default(false)
                            ->helperText('Highlight this document'),
                    ])->columns(3),
                
                Section::make('File Information')
                    ->schema([
                        Forms\Components\Placeholder::make('file_info')
                            ->label('Current File')
                            ->content(function ($record) {
                                if (!$record) return 'No file uploaded';
                                
                                return "
                                    File: {$record->file_name}<br>
                                    Type: {$record->file_type}<br>
                                    Downloads: {$record->download_count}<br>
                                    Last Updated: {$record->updated_at->format('Y-m-d H:i')}
                                ";
                            })
                            ->hidden(fn ($operation) => $operation === 'create'),
                    ])->collapsible(),
            ]);
    }
    private static function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
