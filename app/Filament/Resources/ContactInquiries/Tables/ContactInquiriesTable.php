<?php

namespace App\Filament\Resources\ContactInquiries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;
use App\Models\ContactInquiry;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\BulkAction;

class ContactInquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                
                Tables\Columns\BadgeColumn::make('type')
                    ->formatStateUsing(fn ($state) => ContactInquiry::availableTypes()[$state] ?? $state)
                    ->colors([
                        'primary' => 'general',
                        'success' => 'donation',
                        'warning' => 'volunteer',
                        'info' => 'partnership',
                        'gray' => 'other',
                    ])
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->formatStateUsing(fn ($state) => ContactInquiry::availableStatuses()[$state] ?? $state)
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'reviewed',
                        'primary' => 'contacted',
                        'success' => 'resolved',
                        'danger' => 'spam',
                    ])
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Submitted'),
                
                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->label('Assigned To')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(ContactInquiry::availableTypes()),
                
                SelectFilter::make('status')
                    ->options(ContactInquiry::availableStatuses()),
                
                SelectFilter::make('donation_type')
                    ->options(ContactInquiry::availableDonationTypes())
                    ->label('Donation Type'),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('From Date'),
                        DatePicker::make('created_until')
                            ->label('Until Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('markContacted')
                    ->label('Mark Contacted')
                    ->icon('heroicon-o-phone')
                    ->action(fn (ContactInquiry $record) => $record->update(['status' => 'contacted']))
                    ->color('primary')
                    ->visible(fn (ContactInquiry $record) => $record->status !== 'contacted' && $record->status !== 'resolved'),
                
                Action::make('markResolved')
                    ->label('Resolve')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn (ContactInquiry $record) => $record->update(['status' => 'resolved']))
                    ->color('success')
                    ->visible(fn (ContactInquiry $record) => $record->status !== 'resolved'),
                
                Action::make('email')
                    ->label('')
                    ->icon('heroicon-o-envelope')
                    ->url(fn (ContactInquiry $record) => 'mailto:' . $record->email)
                    ->openUrlInNewTab(),
                
                Action::make('call')
                    ->label('')
                    ->icon('heroicon-o-phone')
                    ->url(fn (ContactInquiry $record) => 'tel:' . preg_replace('/[^0-9+]/', '', $record->phone))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('markAsContacted')
                        ->label('Mark as Contacted')
                        ->icon('heroicon-o-phone')
                        ->action(fn ($records) => $records->each->update(['status' => 'contacted'])),
                    
                    BulkAction::make('markAsResolved')
                        ->label('Mark as Resolved')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn ($records) => $records->each->update(['status' => 'resolved'])),
                    
                    BulkAction::make('markAsSpam')
                        ->label('Mark as Spam')
                        ->icon('heroicon-o-trash')
                        ->action(fn ($records) => $records->each->update(['status' => 'spam']))
                        ->color('danger'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
