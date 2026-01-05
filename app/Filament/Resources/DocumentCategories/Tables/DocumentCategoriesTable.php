<?php

namespace App\Filament\Resources\DocumentCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;
use App\Models\DocumentCategory;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\Documents\DocumentResource;

class DocumentCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (DocumentCategory $record): string => $record->slug),
                
                // Fix the documents_count column
                Tables\Columns\TextColumn::make('documents_count')
                    ->label('Documents')
                    ->getStateUsing(fn (DocumentCategory $record): int => $record->documents()->count())
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('view_documents')
                    ->label('View Docs')
                    ->icon('heroicon-o-document-text')
                    ->url(fn (DocumentCategory $record): string => DocumentResource::getUrl('index', ['tableFilters[category_id]' => $record->id])),
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
