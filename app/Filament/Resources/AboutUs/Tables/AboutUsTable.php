<?php

namespace App\Filament\Resources\AboutUs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;
use App\Models\AboutUs;

class AboutUsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('about_image_path')
                    ->label('About Image')
                    ->disk('uploads')
                    ->circular()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('header_description')
                    ->label('Header')
                    ->limit(100)
                    ->wrap()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('stats_summary')
                    ->label('Content Summary')
                    ->getStateUsing(function (AboutUs $record) {
                        $summary = [];
                        if ($record->header_stats) {
                            $summary[] = count($record->header_stats) . ' stats';
                        }
                        if ($record->team_members) {
                            $summary[] = count($record->team_members) . ' team';
                        }
                        return implode(', ', $summary);
                    })
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Last Updated'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url('/about-us', true),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn ($query) => $query->limit(1));
    }
}
