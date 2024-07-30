<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Filament\Resources\LocationResource\RelationManagers;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->columns([
                    'sm' => 1,
                    'md' => 1,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 1,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                ->schema([
                    TextInput::make('location_name')
                        ->label('Location Name')
                        ->placeholder('Location Name')
                        ->required(),
                    TextInput::make('parent_location')
                        ->label('Parent Location')
                        ->placeholder('Parent Location')
                        ->required(),
                    TextArea::make('location_address')
                        ->label('Address')
                        ->placeholder('Address')
                        ->autosize(true)
                            ->rows(2)
                            ->columnSpanFull()
                            ->hint(function ($state) {
                                $singleSmsCharactersCount = 255;
                                $charactersCount = strlen($state);
                                $smsCount = 0;
                                if ($charactersCount > 0) {
                                    $smsCount = ceil(strlen($state) / $singleSmsCharactersCount);
                                }
                                $leftCharacters = $singleSmsCharactersCount - ($charactersCount % $singleSmsCharactersCount);

                                return $leftCharacters.' characters';
                            })
                        ->required(),
                    TextInput::make('location_city')
                        ->label('City')
                        ->placeholder('City')
                        ->required(),
                    TextInput::make('location_region')
                        ->label('Region')
                        ->placeholder('Region')
                        ->required(),
                    TextInput::make('location_country')
                        ->label('Country')
                        ->placeholder('Country')
                        ->required(),
                    TextInput::make('location_zip')
                        ->label('Zip')
                        ->placeholder('Zip')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'view' => Pages\ViewLocation::route('/{record}'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
