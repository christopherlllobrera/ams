<?php

namespace App\Filament\Resources;

use DatePeriod;
use Carbon\Carbon;
use Filament\Tables;
use App\Models\Asset;
use App\Models\Company;
use App\Models\Project;
use App\Models\Location;
use Filament\Forms\Form;
use App\Models\AssetModel;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use App\Models\AssetLifeCycle;
use App\Models\AssetCategories;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\AssetResource\Pages;
use App\Models\Supplier;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'asset';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Asset Details')
                ->icon('heroicon-o-computer-desktop')
                    ->schema([
                        Select::make('company_id')->label('Company')
                            ->options(Company::query()->pluck('company_name', 'id'))
                            ->searchable()->preload(),
                        TextInput::make('asset_code')->label('Asset Code')->hint('Generated from SAP'),
                        TextInput::make('serial_number')->label('Serial Number'),
                        Select::make('asset_type')
                            ->label('Type')
                            ->options(
                                AssetCategories::query()
                                    ->distinct()
                                    ->pluck('asset_type', 'asset_type')
                                    ->toArray()
                            )
                            ->live()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $year = Carbon::now()->format('Y');
                                $typeCodeMap = [
                                    'Computer' => '01',
                                    'Communication Equipment' => '02',
                                    'Networking Equipment' => '03',
                                    'Storage Devices' => '04',
                                    'Servers' => '05',
                                    'Peripherals' => '06',
                                    'Office Supplies & Equipment' => '07',
                                    'Consumables' => '08',
                                    'Wiring' => '09',
                                    'Other' => '10'
                                ];
                                $selectedType = $get('asset_type');
                                $typeCode = $typeCodeMap[$selectedType] ?? '00';
                                $lastAsset = Asset::where('company_number', 'LIKE', "OE-{$typeCode}-{$year}-%")
                                    ->orderBy('company_number', 'desc')
                                    ->first();
                                if ($lastAsset) {
                                    $parts = explode('-', $lastAsset->company_number);
                                    $lastNumber = (int) $parts[3];
                                    $newNumber = str_pad(++$lastNumber, 4, '0', STR_PAD_LEFT);
                                } else {
                                    $newNumber = '0001';
                                }
                                $companyNumber = "OE-{$typeCode}-{$year}-{$newNumber}";
                                $set('company_number', $companyNumber);
                            })
                            ->searchable()->preload(),
                        Select::make('asset_categories')
                            ->label('Categories')
                            ->options(function (callable $get) {
                                $assetType = $get('asset_type');
                                if (!$assetType) {
                                    return [];
                                }
                                return AssetCategories::query()
                                    ->where('asset_type', $assetType)
                                    ->pluck('categories', 'categories')
                                    ->toArray();
                            })
                            ->reactive()
                            ->disabled(fn (callable $get) => !$get('asset_type')),
                        TextInput::make('company_number')->label('Company Number')
                            ->dehydrated()
                            ->readOnly()
                            ,
                        Select::make('asset_model_id')->label('Asset Model')
                            ->options(AssetModel::query()->pluck('asset_model_name', 'id'))
                            ->searchable()->preload()
                            ->columnStart([
                                'xl' => 2,
                                'md' => 1
                            ]),
                        Select::make('asset_status')->label('Status')
                            ->options(AssetLifeCycle::query()->pluck('status', 'id')),
                        Select::make('location_id')->label('Location')
                            ->options(Location::all()->pluck('location_name', 'id'))
                            ->columnStart(1),
                        Select::make('department_id')->label('Department')
                            ->options(Department::all()->pluck('department_name', 'id'))
                            ->searchable()->preload(),
                        Select::make('project_id')->label('Cost Center')->hint('WBS')
                            ->options(Project::query()->pluck('project_name', 'id'))
                            ->searchable()->preload(),
                        TextArea::make('asset_note')->label('Asset Note')
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
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
                Section::make('Purchase Details')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        Select::make('supplier_name')->label('Supplier Name')
                            ->options(Supplier::query()->pluck('supplier_name', 'id')),
                        TextInput::make('depreciation_cost')->label('Depreciation Cost')
                            ->mask(RawJs::make('$money($input)'))
                            ->inputMode('decimal')->prefix('₱'),
                        Select::make('depreciation_year')->label('Depreciation Year')
                            ->options(collect(range(2020, 2035))->reverse()->mapWithKeys(fn ($year) => [$year => $year])),
                        DatePicker::make('EOL_date')->label('EOL')->hint('End of Life'),
                        TextInput::make('purchase_receipt')->label('Purchase Receipt'),
                        DatePicker::make('purchase_date')->label('Purchase Date'),
                        TextInput::make('purchase_order')->label('Purchase Order'),
                        TextInput::make('purchase_cost')->label('Purchase Cost')
                            ->mask(RawJs::make('$money($input)'))
                            ->inputMode('decimal')->prefix('₱'),
                        TextInput::make('delivery_receipt')->label('Delivery Receipt')
                            ->columnStart(3),
                        TextInput::make('good_receipt')->label('GR')->hint('Good Receipt'),
                        FileUpload::make('warranty_terms')->label('Warranty Terms')
                            ->multiple()->columnSpanFull()
                            ->acceptedFileTypes(['image/*', 'application/vnd.ms-excel', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->uploadingMessage('Uploading Warranty Terms ...')
                            //Storage Setting
                            ->preserveFilenames()->maxSize(50000) //50MB
                            ->disk('public')->directory('Warranty Terms')
                            ->visibility('public')->deletable(false)
                            ->previewable()->downloadable()->openable()->reorderable(),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 1,
                        'lg' => 3,
                        'xl' => 4,
                        '2xl' => 4,
                    ])
                    ->columnSpan([
                        'sm' => 1,
                        'md' => 1,
                        'lg' => 2,
                        'xl' => 3,
                        '2xl' => 3,
                    ]),
                Section::make('Specification')
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->schema([
                        Select::make('operating_system')->label('Operating System')
                            ->options([
                                'Windows 7' => 'Windows 7',
                                'Windows 10 Pro' => 'Windows 10 Pro',
                                'Windows 11 Pro' => 'Windows 11 Pro',
                                'Windows Server 2012' => 'Windows Server 2012',
                                'Windows Server 2019' => 'Windows Server 2019',
                                'Windows Server 2022' => 'Windows Server 2022',
                            ]),
                        TextInput::make('processor')->label('Processor'),
                        TextInput::make('RAM')->label('RAM'),
                        TextInput::make('storage')->label('Storage'),
                        TextInput::make('GPU')->label('GPU'),
                        TextInput::make('color')->label('Color'),
                        TextInput::make('MAC_address')->label('MAC Address'),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 4,
                        'xl' => 4,
                        '2xl' => 4,
                    ])
                    ->columnSpan([
                        'sm' => 1,
                        'md' => 1,
                        'lg' => 2,
                        'xl' => 3,
                        '2xl' => 3,
                    ]),
            ]);
        //])
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_id'),
                TextColumn::make('company_number'),
                TextColumn::make('asset_model_id'),
                TextColumn::make('asset_code'),
                TextColumn::make('asset_type'),
                TextColumn::make('asset_categories'),
                TextColumn::make('asset_status'),

                TextColumn::make('location_id'),
                TextColumn::make('department_id'),
                TextColumn::make('project_id'),
                TextColumn::make('asset_status'),

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
