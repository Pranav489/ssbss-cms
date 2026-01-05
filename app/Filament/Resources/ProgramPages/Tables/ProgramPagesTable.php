<?php

namespace App\Filament\Resources\ProgramPages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;
use App\Models\ProgramPage;

class ProgramPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        $categories = ProgramPage::availableCategories();
                        return $categories[$state] ?? $state;
                    }),
                
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(ProgramPage::availableCategories()),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->recordActions([
                 EditAction::make(),
                DeleteAction::make(),
                Action::make('view')
    ->label('Preview')
    ->icon('heroicon-o-eye')
    ->url(fn (ProgramPage $record): string => 'http://localhost:5173/programs/' . $record->slug, true),
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
