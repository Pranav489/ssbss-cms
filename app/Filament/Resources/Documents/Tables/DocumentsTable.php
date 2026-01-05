<?php

namespace App\Filament\Resources\Documents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;
use App\Models\Document;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable()
                ->limit(50),
            
            Tables\Columns\TextColumn::make('category.name')
                ->label('Category')
                ->searchable()
                ->sortable()
                ->badge(),
            
            Tables\Columns\TextColumn::make('file_type')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'PDF' => 'danger',
                    'DOC', 'DOCX' => 'primary',
                    'XLS', 'XLSX' => 'success',
                    default => 'gray',
                })
                ->sortable(),
            
            // Use the formatted file size
            Tables\Columns\TextColumn::make('file_size')
                ->label('Size')
                ->formatStateUsing(fn (Document $record): string => $record->formatted_file_size)
                ->sortable()
                ->searchable(),
            
            Tables\Columns\TextColumn::make('download_count')
                ->label('Downloads')
                ->sortable(),
            
            Tables\Columns\IconColumn::make('is_active')
                ->boolean()
                ->sortable(),
            
            Tables\Columns\IconColumn::make('featured')
                ->boolean()
                ->label('Featured')
                ->sortable(),
            
            Tables\Columns\TextColumn::make('upload_date')
                ->date()
                ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
                
                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Featured'),
            ])
            ->recordActions([
            EditAction::make(),
            DeleteAction::make(),
            Action::make('download')
                ->label('')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function (Document $record) {
                    // Get full path to file
                    $filePath = public_path('uploads/' . $record->file_path);
                    
                    // Check if file exists
                    if (!file_exists($filePath)) {
                        throw new \Exception("File not found: " . $record->file_path);
                    }
                    
                    // Increment download count
                    $record->increment('download_count');
                    
                    // Get file name with proper extension
                    $downloadName = $record->file_name;
                    
                    // If no custom name, use original filename
                    if (empty($downloadName)) {
                        $downloadName = basename($record->file_path);
                    }
                    // Ensure the custom name has an extension
                    else {
                        $extension = pathinfo($record->file_path, PATHINFO_EXTENSION);
                        if (!str_contains($downloadName, '.')) {
                            $downloadName .= '.' . $extension;
                        }
                    }
                    
                    // Get proper content type
                    $contentTypes = [
                        'pdf' => 'application/pdf',
                        'doc' => 'application/msword',
                        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'xls' => 'application/vnd.ms-excel',
                        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'ppt' => 'application/vnd.ms-powerpoint',
                        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                        'jpg' => 'image/jpeg',
                        'jpeg' => 'image/jpeg',
                        'png' => 'image/png',
                        'zip' => 'application/zip',
                        'txt' => 'text/plain',
                    ];
                    
                    $fileExtension = strtolower(pathinfo($record->file_path, PATHINFO_EXTENSION));
                    $contentType = $contentTypes[$fileExtension] ?? 'application/octet-stream';
                    
                    // Return file with proper headers
                    return response()->download(
                        $filePath,
                        $downloadName,
                        [
                            'Content-Type' => $contentType,
                            'Content-Disposition' => 'attachment; filename="' . $downloadName . '"',
                        ]
                    );
                })
                ->color('success'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order');
    }
}
