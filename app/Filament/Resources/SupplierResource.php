<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Country;
use Filament\Forms\Get;
use App\Models\Supplier;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Municipality;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\SupplierResource\Pages;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 7;

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
                            ->label('Contact Name')
                            ->placeholder('Contact Name')
                            ->required(),
                        TextInput::make('supplier_contact_phone')
                            ->label('Contact Phone')
                            ->placeholder('Contact Phone')
                            ->required(),
                        TextInput::make('supplier_email')
                            ->email()
                            ->label('Email')
                            ->placeholder('Email')
                            ->required(),
                        TextInput::make('supplier_fax')
                            ->label('Fax')
                            ->placeholder('Fax')
                            ->required(),
                        TextInput::make('supplier_website')
                            ->label('Website')
                            ->placeholder('Website')
                            ->url()
                            ->suffixIcon('heroicon-m-globe-alt')
                            ->suffixIconColor('gray')
                            ->required(),
                        TextArea::make('supplier_address')
                            ->label('Address')
                            ->placeholder('Address')
                            ->columnSpanFull()
                            ->required(),
                        Select::make('country')
                            ->label('Country')
                            ->placeholder('Country')
                            ->options(Country::all()->pluck('country_name', 'id')->toArray())
                            ->reactive()
                            ->required(),
                        Select::make('province_id')
                            ->label('Province')
                            ->placeholder('Province')
                            ->relationship('provinces', 'province_name')
                            ->live(),
                        Select::make('municipality_id')
                            ->label('City')
                            ->placeholder('City')
                            ->preload()
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
                        FileUpload::make('supplier_attachment')
                            ->label('Image')
                            ->columnSpanFull()
                            ->required(),
                    ]),

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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'view' => Pages\ViewSupplier::route('/{record}'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
