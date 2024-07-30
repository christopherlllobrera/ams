<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Asset;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AssetResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssetResource\RelationManagers;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Asset Details')
                        ->schema([
                    Select::make('companies_id')
                        ->label('Company')
                        ->placeholder('Select a company'),
                    TextInput::make('asset_tag')
                        ->label('Asset Tag')
                        ->placeholder('Enter the asset tag')
                        //->required()
                        ,
                    TextInput::make('asset_name')
                        ->label('Asset Name')
                        ->placeholder('Enter the asset name')
                        //->required()
                        ,
                    Select::make('asset__models_id')
                        ->label('Asset Type')
                        ->placeholder('Select an asset type'),
                    TextInput::make('serial_number')
                        ->label('Serial Number')
                        ->placeholder('Serial number'),
                    Select::make('status')
                        ->label('Status')
                        ->placeholder('Status'),
                    Select::make('locations_id')
                        ->label('Location')
                        ->placeholder('Location'),
                    Select::make('requestable')
                        ->label('Requestable')
                        ->placeholder('Requestable'),
                    TextInput::make('assigned_to')
                        ->label('Assigned To')
                        ->placeholder('Assigned to'),
                    DatePicker::make('assigned_date')
                        ->label('Assigned Date')
                        ->placeholder('Assigned date'),
                    DatePicker::make('return_date')
                        ->label('Return Date')
                        ->placeholder('Return date'),
                    Select::make('asset_actions')
                        ->label('Asset Actions')
                        ->placeholder('Asset actions'),
                    TextArea::make('asset_note')
                        ->label('Notes')
                        ->placeholder('Notes')
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
                        //->required(),
                        ])
                        ->columns([
                            'sm' => 1,
                            'md' => 1,
                            'lg' => 2,
                            'xl' => 3,
                            '2xl' => 3,
                        ])
                        ->columnSpan([
                            'sm' => 1,
                            'md' => 1,
                            'lg' => 2,
                            'xl' => 3,
                            '2xl' => 3,
                        ]),
                    Wizard\Step::make('Purchase Details')
                        ->schema([
                            Select::make('suppliers_id')
                                ->label('Supplier')
                                ->placeholder('Supplier'),
                            TextInput::make('order_number')
                                ->label('Order Number')
                                ->placeholder('Order number'),
                            TextInput::make('purchase_order_number')
                                ->label('Purchase Order Number')
                                ->placeholder('Purchase order number'),
                            TextInput::make('purchase_cost')
                                ->label('Purchase Cost')
                                ->placeholder('Purchase cost'),
                            TextInput::make('purchase_receipt')
                                ->label('Purchase Receipt')
                                ->placeholder('Purchase receipt'),
                            DatePicker::make('purchase_date')
                                ->label('Purchase Date')
                                ->placeholder('Purchase Date'),
                            TextInput::make('delivery_receipt')
                                ->label('Delivery Receipt')
                                ->placeholder('Delivery receipt'),
                            TextInput::make('warranty')
                                ->label('Warranty')
                                ->placeholder('Warranty'),
                            TextArea::make('warranty_terms')
                                ->label('Warranty Terms')
                                ->placeholder('Warranty terms')
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
                        ])->columns([
                            'sm' => 1,
                            'md' => 1,
                            'lg' => 2,
                            'xl' => 3,
                            '2xl' => 3,
                        ])
                        ->columnSpan([
                            'sm' => 1,
                            'md' => 1,
                            'lg' => 2,
                            'xl' => 3,
                            '2xl' => 3,
                        ]),
                    Wizard\Step::make('Specifications')
                        ->schema([
                            TextInput::make('operating_system')
                                ->label('Operating System')
                                ->placeholder('Operating system'),
                            TextInput::make('processor')
                                ->label('Processor')
                                ->placeholder('Processor'),
                            TextInput::make('generation')
                                ->label('Generation')
                                ->placeholder('Generation'),
                            TextInput::make('ram')
                                ->label('RAM')
                                ->placeholder('RAM'),
                            TextInput::make('hdd')
                                ->label('HDD')
                                ->placeholder('HDD'),
                            TextInput::make('ssd')
                                ->label('SSD')
                                ->placeholder('SSD'),
                            TextInput::make('gpu')
                                ->label('GPU')
                                ->placeholder('GPU'),
                            TextInput::make('color')
                                ->label('Color')
                                ->placeholder('Color'),
                            TextInput::make('mac_wifi')
                                ->label('MAC WiFi')
                                ->placeholder('MAC WiFi'),
                            TextInput::make('mac_lan')
                                ->label('MAC LAN')
                                ->placeholder('MAC LAN'),
                            TextInput::make('cost_center')
                                ->label('Cost Center')
                                ->placeholder('Cost center'),
                            TextInput::make('trend_micro')
                                ->label('Trend Micro')
                                ->placeholder('Trend Micro'),
                            TextInput::make('rapid_seven')
                                ->label('Rapid Seven')
                                ->placeholder('Rapid Seven'),
                        ])->columns([
                            'sm' => 1,
                            'md' => 1,
                            'lg' => 2,
                            'xl' => 3,
                            '2xl' => 3,
                        ]),
                ])->columnSpanFull()
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'view' => Pages\ViewAsset::route('/{record}'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
