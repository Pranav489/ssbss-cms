<?php

namespace App\Filament\Resources\ImpactMetrics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables;
use App\Models\ImpactMetric;

class ImpactMetricsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('uploads')
                    ->circular()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('number')
                    ->searchable()
                    ->sortable()
                    ->description(fn (ImpactMetric $record): string => $record->label),
                
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('icon')
                    ->label('Icon')
                    ->icon(fn ($state): string => match($state) {
                        'Users' => 'heroicon-o-user-group',
                        'Home' => 'heroicon-o-home',
                        'Heart' => 'heroicon-o-heart',
                        'Shield' => 'heroicon-o-shield-check',
                        default => 'heroicon-o-cube',
                    })
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('highlight')
                    ->boolean()
                    ->label('Highlighted')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->filters([
                 Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
                
                Tables\Filters\TernaryFilter::make('highlight')
                    ->label('Highlighted'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
