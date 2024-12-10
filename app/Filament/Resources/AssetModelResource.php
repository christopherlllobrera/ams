<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\AssetModel;
use Filament\Tables\Table;
use App\Models\Manufacturer;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\AssetModelResource\Pages;
use Filament\Tables\Columns\TextColumn;

class AssetModelResource extends Resource
{
    protected static ?string $model = AssetModel::class;

    // protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $navigationLabel = 'Model';

    protected static ?string $navigationGroup = 'Specification Management';


    protected static ?int $navigationSort = 1;


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
                        TextInput::make('asset_model_name')
                            ->label('Model Name')
                            ->placeholder('Model Name')
                            ->columnSpanFull()
                            ->required(),
                        // Select::make('asset_model_number')//select
                        //     ->label('Model No.')
                        //     ->required(),
                        Select::make('manufacturer_id')
                            ->label('Manufacturer')
                            ->placeholder('Manufacturer')
                            ->options(Manufacturer::all()->pluck('manufacturer_name', 'id')->toArray())
                            ->required(),
                        TextArea::make('model_notes')
                            ->label('Model Notes')
                            ->placeholder('Model Notes')
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
                            // ->required()
                            ,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('asset_model_name')->label('Model'),
                TextColumn::make('Manufacturer.manufacturer_name'),
                TextColumn::make('model_notes'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListAssetModels::route('/'),
            'create' => Pages\CreateAssetModel::route('/create'),
            'edit' => Pages\EditAssetModel::route('/{record}/edit'),
        ];
    }
}
