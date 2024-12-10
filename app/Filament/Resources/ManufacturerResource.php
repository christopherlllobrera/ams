<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Manufacturer;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ManufacturerResource\Pages;
use App\Filament\Resources\ManufacturerResource\RelationManagers;

class ManufacturerResource extends Resource
{
    protected static ?string $model = Manufacturer::class;

    // protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Specification Management';
    protected static ?int $navigationSort = 3;

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
                    TextInput::make('manufacturer_name')
                        ->label('Manufacturer Name')
                        ->placeholder('Manufacturer Name')
                        ->columnSpanFull()
                        ->required(),
                    TextInput::make('URL')
                        ->label('URL')
                        ->prefix('https://')
                        ->suffix('.com')
                        ->placeholder('URL')
                        ->required(),
                    TextInput::make('support_url')
                        ->label('Support URL')
                        ->prefix('https://')
                        ->suffix('.com')
                        ->placeholder('Support URL'),
                    TextInput::make('manufacturer_email')
                        ->label('Email')
                        ->placeholder('Manufacturer Email')
                        ->email()
                        ->required(),
                    TextInput::make('manufacturer_phone')
                        ->label('Phone')
                        ->placeholder('Manufacturer Phone')
                        ->required(),
                    FileUpload::make('manufacturer_attachment')
                        ->label('Image')
                        ->columnSpanFull()
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('manufacturer_name')
                    ->label('Manufacturer Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('URL')
                    ->label('URL')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('manufacturer_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('manufacturer_phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),

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
            'index' => Pages\ListManufacturers::route('/'),
            'create' => Pages\CreateManufacturer::route('/create'),
            'view' => Pages\ViewManufacturer::route('/{record}'),
            'edit' => Pages\EditManufacturer::route('/{record}/edit'),
        ];
    }
}
