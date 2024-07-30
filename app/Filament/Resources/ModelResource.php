<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Asset_Model;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ModelResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ModelResource\RelationManagers;

class ModelResource extends Resource
{
    protected static ?string $model = Asset_Model::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $navigationLabel = 'Asset Models';
    protected static ?int $navigationSort = 3;
    protected static ?string $breadcrumb = 'Asset Models';
    protected static ?string $slug = 'asset-models';

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
                    ->label('Asset Model Name')
                    ->placeholder('Model Name')
                    ->columnSpanFull()
                    ->required(),
                Select::make('asset_model_number')//select
                    ->label('Model No.')
                    ->required(),
                Select::make('manufacturers_id')
                    ->label('Manufacturer')
                    ->placeholder('Manufacturer')
                    ->required(),
                Select::make('categories_id')//select
                    ->label('Category')
                    ->placeholder('Category')
                    ->required(),
                Select::make('depreciation')//select
                    ->label('Depreciation')
                    ->placeholder('Depreciation')
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
            'index' => Pages\ListModels::route('/'),
            'create' => Pages\CreateModel::route('/create'),
            'edit' => Pages\EditModel::route('/{record}/edit'),
        ];
    }
}
