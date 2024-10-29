<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AssetLifeCycle;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Filament\Resources\AssetLifeCycleResource\Pages;

class AssetLifeCycleResource extends Resource
{
    protected static ?string $model = AssetLifeCycle::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Asset Life Cycle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Asset Life Cycle Information')
                    ->schema([
                        TextInput::make('status')
                            ->label('Status')
                            ->required(),
                        TextArea::make('definition')
                            ->label('Definition')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')

                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('definition')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListAssetLifeCycles::route('/'),
            'create' => Pages\CreateAssetLifeCycle::route('/create'),
            'edit' => Pages\EditAssetLifeCycle::route('/{record}/edit'),
        ];
    }
}
