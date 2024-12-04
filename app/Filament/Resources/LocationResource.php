<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Region;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Location;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Municipality;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LocationResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LocationResource\RelationManagers;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    // protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'MIESCOR Management';

    protected static ?int $navigationSort = 4;

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
                        ->required()
                        ->dehydrated()
                        ->default('Philippines'),
                    Select::make('region_id')
                        ->label('Region')
                        ->placeholder('Region')
                        ->options(Region::all()->pluck('region_name', 'id')->toArray())
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            $region = $get('region_id');
                            if ($region === null) {
                                $set('province_id', null);
                                $set('municipality_id', null);
                                $set('barangay_id', null);
                            }
                        })
                        ->reactive()
                        ->searchable()
                        ->required(),
                    Select::make('province_id')
                        ->label('Province')
                        ->placeholder('Province')
                        ->preload()
                        ->searchable()
                        ->options(fn (Get $get): Collection => Province::query()
                                ->where('region_id', $get('region_id'))
                                ->select('id', 'province_name')
                                ->get()
                                ->pluck('province_name', 'id'))
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            $province = $get('province_id');
                            if ($province === null) {
                                $set('municipality_id', null);
                                $set('barangay_id', null);
                            }
                        })
                        ->reactive(),
                    Select::make('municipality_id')
                        ->label('City')
                        ->placeholder('City')
                        ->preload()
                        ->searchable()
                        ->reactive()
                        ->options(fn (Get $get): Collection => Municipality::query()
                                ->where('province_id', $get('province_id'))
                                ->select('id', 'municipality_name')
                                ->get()
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
                TextColumn::make('location_name')
                    ->label('Location Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('parent_address')
                    ->label('Parent Location')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location_address')
                    ->label('Address')
                    ->searchable(),
                TextColumn::make('location_country')
                    ->label('Country')
                    ->searchable(),
                TextColumn::make('region.region_name')
                    ->label('Region')
                    ->searchable(),
                TextColumn::make('province.province_name')
                    ->label('Province')
                    ->searchable(),
                TextColumn::make('municipality.municipality_name')
                    ->label('City')
                    ->searchable(),
                TextColumn::make('location_zip')
                    ->label('Zip')
                    ->searchable(),
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
