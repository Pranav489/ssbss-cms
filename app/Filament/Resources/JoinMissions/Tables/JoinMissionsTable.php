<?php

namespace App\Filament\Resources\JoinMissions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;


class JoinMissionsTable
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
                
                Tables\Columns\TextColumn::make('statement')
                    ->label('Statement')
                    ->limit(100)
                    ->wrap()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('children_helped')
                    ->label('Children')
                    ->formatStateUsing(fn ($state): string => number_format($state) . '+')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('families_reunited')
                    ->label('Families')
                    ->formatStateUsing(fn ($state): string => number_format($state) . '+')
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Last Updated'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url('/join-our-mission', true),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
            ->modifyQueryUsing(fn ($query) => $query->limit(1));
    }
}
