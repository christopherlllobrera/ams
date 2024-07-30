<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Licenses;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LicensesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LicensesResource\RelationManagers;
use DateTime;

class LicensesResource extends Resource
{
    protected static ?string $model = Licenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 2;

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
                    TextInput::make('software_name')
                        ->label('Software Name')
                        ->placeholder('Software Name')
                        ->columnSpanFull()
                        ->required(),
                    TextInput::make('product_key')
                        ->label('Product Key')
                        ->placeholder('Product Key')
                        ->columnSpanFull()
                        ->required(),
                    Select::make('category_id')
                        ->label('Category')
                        ->placeholder('Category')
                        ->required(),
                    TextInput::make('seat')
                        ->label('Seat')
                        ->placeholder('Seat')
                        ->required(),
                    Select::make('company_id')
                        ->options(
                            Licenses::all()->pluck('company_name', 'id')
                        )
                        ->label('Company Name')
                        ->placeholder('Company Name')
                        ->required(),

                    Select::make('manufacturer_id')
                        ->options(
                            Licenses::all()->pluck('manufacturer_name', 'id')
                        )
                        ->label('Manufacturer Name')
                        ->placeholder('Manufacturer Name')
                        ->required(),
                    TextInput::make('license_to_name')
                        ->label('License To Name')
                        ->placeholder('License To Name')
                        ->required(),
                    TextInput::make('license_to_email')
                        ->label('License To Email')
                        ->placeholder('License To Email')
                        ->required()
                        ->email(),
                    TextArea::make('license_notes')
                        ->label('License Notes')
                        ->placeholder('License Notes')
                        ->required()
                        ->columnSpanFull()
                        ->autosize(true)
                            ->rows(5)
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
                            }),
                        ])->columnspan(2)
                        ->columns(2),
                Section::make()
                ->columns([
                    'sm' => 1,
                    'md' => 1,
                    'lg' => 1,
                    'xl' => 1,
                    '2xl' => 1,
                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 1,
                    'lg' => 1,
                    'xl' => 1,
                    '2xl' => 1,
                ])
                ->schema([
                    TextInput::make('license_order_number')
                        ->label('Order Number')
                        ->placeholder('Order Number')
                        ->required(),
                    TextInput::make('license_purchase_order_number')
                        ->label('Purchase Order Number')
                        ->placeholder('Purchase Order Number')
                        ->required(),
                    TextInput::make('license_purchase_cost')
                        ->label('Purchase Cost')
                        ->placeholder('Purchase Cost')
                        ->required(),
                    DatePicker::make('license_purchase_date')
                        ->label('Purchase Date')
                        ->required(),
                    DatePicker::make('license_expiration_date')
                        ->label('Expiration Date')
                        ->required(),
                    Select::make('depreciation')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No',
                        ])
                        ->label('Depreciation')
                        ->required(),
                    Toggle::make('reassignable')
                        ->onColor('success')
                        ->offColor('danger')
                        ->label('Reassignable')
                        ->required(),
                    Toggle::make('maintained')
                        ->onColor('success')
                        ->offColor('danger')
                        ->label('Maintained')
                        ->required(),
                ])
            ])->columns(3);
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
            'index' => Pages\ListLicenses::route('/'),
            'create' => Pages\CreateLicenses::route('/create'),
            'view' => Pages\ViewLicenses::route('/{record}'),
            'edit' => Pages\EditLicenses::route('/{record}/edit'),
        ];
    }
}
