<?php

namespace App\Filament\Resources\JoinMissions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\JoinMission;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Grid;


class JoinMissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Main Content')
                    ->schema([
                        Forms\Components\Textarea::make('statement')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000)
                            ->placeholder('Join us in making a difference in the lives of vulnerable children...')
                            ->helperText('This is the main statement/quote that appears in the section')
                            ->columnSpanFull(),
                    ]),
                
                Section::make('Impact Statistics')
                    ->description('These numbers will be displayed prominently in the section')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('children_helped')
                                    ->label('Children Helped')
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0)
                                    ->suffix('+')
                                    ->helperText('Number of children directly helped'),
                                
                                Forms\Components\TextInput::make('families_reunited')
                                    ->label('Families Reunited')
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0)
                                    ->suffix('+')
                                    ->helperText('Number of families reunited'),
                            ]),
                        
                        Forms\Components\TextInput::make('lives_changed')
                            ->label('Lives Changed')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->suffix('+')
                            ->helperText('Overall impact measurement'),
                        
                        Forms\Components\Placeholder::make('stats_preview')
                            ->label('Preview')
                            ->content(function ($get) {
                                $children = number_format($get('children_helped') ?? 0);
                                $families = number_format($get('families_reunited') ?? 0);
                                $lives = number_format($get('lives_changed') ?? 0);
                                
                                return "Will display as: {$children}+ Children Helped • {$families}+ Families Reunited • {$lives}+ Lives Changed";
                            })
                            ->columnSpanFull(),
                    ]),
                
                Section::make('Featured Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Background/Featured Image')
                            ->disk('uploads')
                            ->image()
                            ->directory('join-mission')
                            ->maxSize(2048),
                        
                        Forms\Components\TextInput::make('image_alt')
                            ->label('Image Alt Text')
                            ->maxLength(255)
                            ->requiredWith('image_path')
                            ->helperText('Describe the image for accessibility'),
                    ])->collapsible(),
                
                Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Show this section on the website'),
                        
                        Forms\Components\Placeholder::make('last_updated')
                            ->label('Last Updated')
                            ->content(fn ($record) => $record ? $record->updated_at->diffForHumans() : 'Never'),
                    ]),
            ]);
    }
}
