<?php

namespace App\Filament\Resources;

use DateTime;
use Filament\Forms;
use Filament\Tables;
use App\Models\Licenses;
use App\Models\Supplier;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use App\Models\Manufacturer;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LicensesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LicensesResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class LicensesResource extends Resource
{
    protected static ?string $model = Licenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('License Details')
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
                            ->required(),
                        TextInput::make('product_key')
                            ->label('Product Key')
                            ->placeholder('Product Key')
                            ->required(),
                        Select::make('categories_id')
                            ->label('Category')
                            ->placeholder('Category')
                            ->options([
                                'Productivity Software' => 'Productivity Software',
                                'Security Software' => 'Security Software',
                                'Operating Software' => 'Operating Software',
                                'Multimedia Software' => 'Multimedia Software',
                                'Business Software' => 'Business Software',
                                
                            ]),
                        TextInput::make('seat')
                            ->label('Seat')
                            ->placeholder('Seat')
                            ->numeric()
                            ->required(),
                        Select::make('supplier_id')
                            ->options(Supplier::query()->pluck('supplier_name', 'id')->toArray())
                            ->label('Supplier Name')->placeholder('Company Name')
                            ->searchable()->preload(),
                        Select::make('manufacturer_id')
                            ->options(Manufacturer::query()->pluck('manufacturer_name', 'id')->toArray())
                            ->label('Manufacturer Name')->placeholder('Manufacturer Name')
                            ->searchable()->preload(),
                        TextInput::make('registered_name')
                            ->label('Registered Name')
                            ->placeholder('Registered Name')
                            ->required(),
                        TextInput::make('registered_email')
                            ->label('Registered Email')
                            ->placeholder('Registered Email')
                            ->required()
                            ->email(),
                        TextArea::make('license_notes')
                            ->label('License Notes')
                            ->placeholder('License Notes')
                            ->columnSpanFull()->autosize(true)
                            ->rows(2)
                            ->live()->reactive()
                            ->hint(function ($state) {
                                $singleSmsCharactersCount = 255;
                                $charactersCount = strlen($state);
                                $smsCount = 0;
                                if ($charactersCount > 0) {
                                    $smsCount = ceil(strlen($state) / $singleSmsCharactersCount);
                                }
                                $leftCharacters = $singleSmsCharactersCount - ($charactersCount % $singleSmsCharactersCount);
                                return $leftCharacters . ' characters';
                            }),
                        FileUpload::make('license_attachment')->label('Attachment')
                            ->multiple()->columnSpanFull()
                            ->acceptedFileTypes(['image/*', 'application/vnd.ms-excel', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->uploadingMessage('Uploading License Attachment...')
                            //Storage Setting
                            ->preserveFilenames()->maxSize(50000) //50MB
                            ->disk('public')->directory('License Attachment')
                            ->visibility('public')->deletable(false)
                            ->previewable()->downloadable()->openable()->reorderable(),
                    ])
                    ->columnspan(2)->columns(2),
                Section::make('Purchase Detail')
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
                            ->label('Purchase Order No')
                            ->placeholder('Purchase Order No')
                            ->required()
                        ,
                        TextInput::make('license_purchase_cost')
                            ->label('Purchase Cost')
                            ->placeholder('Purchase Cost')
                            ->required()
                            ->mask(RawJs::make('$money($input)'))
                            ->inputMode('decimal')->prefix('₱'),
                        DatePicker::make('license_purchase_date')
                            ->label('Purchase Date')
                            ->required(),
                        DatePicker::make('license_expiration_date')
                            ->label('Expiration Date')
                            ->required(),
                    ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('software_name')->label('Software'),
                TextColumn::make('categories_id')->label('Category'),
                TextColumn::make('seat')->label('Seat'),
                TextColumn::make('supplier_id')->label('Supplier'),
                TextColumn::make('manufacturer_id')->label('Manufacturer'),
                TextColumn::make('registered_name')->label('Registered Name'),
                TextColumn::make('registered_email')->label('Registered Email'),
                TextColumn::make('license_notes')->label('Notes')->wrap(2),
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
