<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Models\Country;
use App\Models\Municipality;
use App\Models\Supplier;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    // protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Specification Management';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 3,
                        '2xl' => 3,
                    ])
                    ->columnSpan([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 3,
                        '2xl' => 3,
                    ])
                    ->schema([
                        TextInput::make('supplier_name')
                            ->label('Supplier Name')
                            ->placeholder('Supplier Name')
                            ->required(),
                        TextInput::make('supplier_contact_name')
                            //->required()
                            ->label('Contact Name')
                            ->placeholder('Contact Name'),
                        TextInput::make('supplier_contact_phone')
                            //->required()
                            ->label('Contact Phone')
                            ->placeholder('Contact Phone'),
                        TextInput::make('supplier_email')
                            //->required()
                            ->email()
                            ->label('Email')
                            ->placeholder('Email'),
                        TextInput::make('supplier_website')
                            //->required()
                            ->label('Website')
                            ->placeholder('Website')
                            ->url()
                            ->suffixIcon('heroicon-m-globe-alt')
                            ->suffixIconColor('gray'),
                        TextArea::make('supplier_address')
                            //->required()
                            ->label('Address')
                            ->placeholder('Address')
                            ->columnSpanFull(),
                        Select::make('country')
                            ->label('Country')
                            ->placeholder('Country')
                            ->options(Country::all()->pluck('country_name', 'id')->toArray())
                            //->required()
                            ->reactive(),
                        Select::make('province_id')
                            ->label('Province')
                            ->placeholder('Province')
                            ->relationship('provinces', 'province_name')
                            ->live(),
                        Select::make('municipality_id')
                            ->label('City')
                            ->placeholder('City')
                            ->preload()
                            ->nullable()
                            ->searchable()
                            ->options(fn (Get $get): Collection => Municipality::query()
                                ->where('province_id', $get('province_id'))->get()
                                ->pluck('municipality_name', 'id')),
                        TextArea::make('supplier_notes')
                            ->label('Notes')
                            ->placeholder('Notes')
                            ->columnSpanFull()
                            ->autosize(true)
                            ->rows(3)
                            ->reactive()
                            //->required()
                            ->hint(function ($state) {
                                $singleSmsCharactersCount = 255;
                                $charactersCount = strlen($state);
                                $smsCount = 0;
                                if ($charactersCount > 0) {
                                    $smsCount = ceil(strlen($state) / $singleSmsCharactersCount);
                                }
                                $leftCharacters = $singleSmsCharactersCount - ($charactersCount % $singleSmsCharactersCount);

                                return $leftCharacters.' characters';
                            }),
                        FileUpload::make('supplier_attachment')
                            ->label('Image')
                            //->required()
                            ->columnSpanFull(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('supplier_name')
                    ->label('Supplier Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('supplier_address')
                    ->label('Address')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('country')
                    ->label('Country')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('supplier_contact_name')
                    ->label('Contact Name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('supplier_contact_phone')
                    ->label('Contact Phone')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('supplier_fax')
                    ->label('Fax')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('supplier_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('supplier_website')
                    ->label('Website')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('supplier_notes')
                    ->label('Notes')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'view' => Pages\ViewSupplier::route('/{record}'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
