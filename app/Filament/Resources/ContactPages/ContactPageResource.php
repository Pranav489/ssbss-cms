<?php

namespace App\Filament\Resources\ContactPages;

use App\Filament\Resources\ContactPages\Pages\CreateContactPage;
use App\Filament\Resources\ContactPages\Pages\EditContactPage;
use App\Filament\Resources\ContactPages\Pages\ListContactPages;
use App\Filament\Resources\ContactPages\Schemas\ContactPageForm;
use App\Filament\Resources\ContactPages\Tables\ContactPagesTable;
use App\Models\ContactPage;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactPageResource extends Resource
{
    protected static ?string $model = ContactPage::class;
     protected static string|UnitEnum|null $navigationGroup = 'Pages';
    // protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Contact Page';
    protected static ?string $modelLabel = 'Contact Page';
    protected static ?string $pluralModelLabel = 'Contact Page';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;

    public static function form(Schema $schema): Schema
    {
        return ContactPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactPagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactPages::route('/'),
            'create' => CreateContactPage::route('/create'),
            'edit' => EditContactPage::route('/{record}/edit'),
            // 'view' => ViewContactPage::route('/{record}'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->limit(1);
    }
}
