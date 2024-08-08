<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Location;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Municipality;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LocationResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LocationResource\RelationManagers;
use App\Models\Province;

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
                        //
                    TextInput::make('location_country')
                        ->label('Country')
                        ->placeholder('Country')
                        ->required(),
                    Select::make('region_id')
                        ->label('Region')
                        ->placeholder('Region')
                        ->relationship('regions', 'region_name')
                        ->live()
                        ->required(),
                    Select::make('province_id')
                        ->label('Province')
                        ->placeholder('Province')
                        ->preload()
                        ->options(fn (Get $get): Collection => Province::query()
                        ->where('region_id', $get('region_id'))->get()
                        ->pluck('province_name', 'id'))
                        ->live(),
                    Select::make('municipality_id')
                        ->label('City')
                        ->placeholder('City')
                        ->preload()
                        ->searchable()
                        ->options(fn (Get $get): Collection => Municipality::query()
                            ->where('province_id', $get('province_id'))->get()
                            ->pluck('municipality_name', 'id')),
                    TextInput::make('location_zip')
                        ->label('Zip')
                        ->placeholder('Zip')
                        ->numeric()
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
