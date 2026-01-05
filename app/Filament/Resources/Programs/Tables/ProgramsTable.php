<?php

namespace App\Filament\Resources\Programs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables;
use App\Models\Program;
use Filament\Actions\Action;

class ProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->circular()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('features')
                    ->label('Features')
                    ->formatStateUsing(fn ($state): string => count($state ?? []) . ' features')
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('featured')
                    ->boolean()
                    ->label('Featured')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
                
                Tables\Filters\TernaryFilter::make('featured')
                    ->label('Featured'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('view')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Program $record): string => '/programs/' . $record->cta_link, true),
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
