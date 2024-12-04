<?php

namespace App\Filament\Resources;

use DatePeriod;
use Carbon\Carbon;
use Filament\Tables;
use App\Models\Asset;
use App\Models\Company;
use App\Models\Project;
use App\Models\Location;
use App\Models\Supplier;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\AssetModel;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use App\Models\AssetLifeCycle;
use App\Models\AssetCategories;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\View\TablesRenderHook;
use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\Pages\EditAsset;
use App\Filament\Resources\AssetResource\Pages\ViewAsset;
use App\Filament\Resources\AssetResource\RelationManagers\UserRelationManager;
use App\Filament\Resources\AssetResource\RelationManagers\AssetuserRelationManager;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

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
                            ->searchable()->preload()
                            ->required(),
                        TextInput::make('asset_code')->label('Asset Code')->hint('Generated from SAP'),
                        TextInput::make('serial_number')->label('Serial Number')->minLength(12)->maxLength(13),
                        Select::make('asset_type')
                            ->label('Type')
                            ->options([
                                'Laptop' => 'Laptop',
                                'Desktop' => 'Desktop',
                                'Monitor' => 'Monitor',
                                'Printer' => 'Printer',
                                'Networking Equipment' => 'Networking Equipment',
                                'Communication Equipment' => 'Communication Equipment',
                                'Peripherals' => 'Peripherals',
                            ])
                            ->live()
                            // ->afterStateUpdated(function (callable $get, callable $set) {
                            //     $year = Carbon::now()->format('Y');
                            //     $typeCodeMap = [
                            //         'Computer' => '01',
                            //         'Communication Equipment' => '02',
                            //         'Networking Equipment' => '03',
                            //         'Storage Devices' => '04',
                            //         'Servers' => '05',
                            //         'Peripherals' => '06',
                            //         'Office Supplies & Equipment' => '07',
                            //         'Consumables' => '08',
                            //         'Wiring' => '09',
                            //         'Other' => '10'
                            //     ];
                            //     $selectedType = $get('asset_type');
                            //     $typeCode = $typeCodeMap[$selectedType] ?? '00';
                            //     $lastAsset = Asset::where('company_number', 'LIKE', "OE-{$typeCode}-{$year}-%")
                            //         ->orderBy('company_number', 'desc')
                            //         ->first();
                            //     if ($lastAsset) {
                            //         $parts = explode('-', $lastAsset->company_number);
                            //         $lastNumber = (int) $parts[3];
                            //         $newNumber = str_pad(++$lastNumber, 4, '0', STR_PAD_LEFT);
                            //     } else {
                            //         $newNumber = '0001';
                            //     }
                            //     $companyNumber = "OE-{$typeCode}-{$year}-{$newNumber}";
                            //     $set('company_number', $companyNumber);
                            // })
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $year = now()->format('Y');
                                $typeCodeMap = [
                                    'Laptop' => '01',
                                    'Desktop' => '02',
                                    'Monitor' => '03',
                                    'Printer' => '04',
                                    'Networking Equipment' => '05',
                                    'Communication Equipment' => '06',
                                    'Peripherals' => '07',
                                ];

                                $selectedType = $get('asset_type');
                                $typeCode = $typeCodeMap[$selectedType] ?? '00';

                                $lastAsset = Asset::where('company_number', 'LIKE', "OE-{$typeCode}-{$year}-%")
                                    ->orderBy('company_number', 'desc')
                                    ->first();

                                if ($lastAsset) {
                                    $parts = explode('-', $lastAsset->company_number);
                                    $lastNumber = (int)$parts[3];
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
                                $categoriesMap = [
                                    'Laptop' => ['N/A'],
                                    'Desktop' => ['N/A'],
                                    'Monitor' => ['N/A'],
                                    'Printer' => ['N/A'],
                                    'Networking Equipment' => [
                                        'Firewall', 'Router', 'Switch', 'Access Point', 'Network Rack',
                                        'Network Cabinet', 'Patch Panels', 'Cable Management Tools',
                                    ],
                                    'Communication Equipment' => [
                                        'IP Phone', 'Smart Phone', 'Tablet',
                                    ],
                                    'Peripherals' => [
                                        'Keyboard', 'Mouse', 'Printer', 'Scanner', 'Projector', 'Webcam',
                                        'Speaker', 'Headset', 'Microphone', 'Docking Station', 'USB Hub',
                                        'UPS', 'Surge Protector', 'Charger', 'Battery', 'Power Supply', 'Laptop Bag',
                                    ],
                                ];

                                $assetType = $get('asset_type');
                                return $categoriesMap[$assetType] ?? [];
                            })
                            ->reactive()
                            // ->required()
                            ->searchable()->preload()->live()
                            ->disabled(fn (callable $get) => !$get('asset_type'))
                            ,
                        TextInput::make('company_number')->label('Company Number')
                            ->dehydrated()
                            ->readOnly()->required()
                            ,
                        Select::make('asset_model_id')->label('Asset Model')
                            ->options(AssetModel::query()->pluck('asset_model_name', 'id'))
                            ->searchable()->preload()
                            ->columnStart([
                                'xl' => 2,
                                'md' => 1
                            ]),
                        Select::make('assetlifecycle_id')->label('Status')
                            ->options(AssetLifeCycle::query()->pluck('status', 'id'))->required(),
                        Select::make('location_id')->label('Location')
                            ->options(Location::all()->pluck('location_name', 'id'))
                            ->columnStart(1),
                        Select::make('department_id')->label('Department')
                            ->options(Department::all()->pluck('department_name', 'id'))
                            ->searchable()->preload(),
                        Select::make('project_id')->label('Cost Center')->hint('WBS')
                            ->options(Project::query()->pluck('cost_center_name', 'id'))
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
                        DatePicker::make('start_of_warranty')->label('Warranty Start')
                            ->helperText('Warranty Terms'),
                        DatePicker::make('end_of_warranty')->label('Warranty End')
                            ->helperText('Warranty Terms'),
                        TextInput::make('good_receipt')->label('GR')->hint('Good Receipt')
                            ,
                        FileUpload::make('asset_attachment')->label('Attachment')
                            ->multiple()->columnSpanFull()
                            ->acceptedFileTypes(['image/*', 'application/vnd.ms-excel', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->uploadingMessage('File uploading ...')
                            //Storage Setting
                            ->preserveFilenames()->maxSize(50000) //50MB
                            ->disk('public')->directory('Warranty Terms')
                            ->visibility('public')->deletable(false)
                            ->previewable()->downloadable()->openable()->reorderable(),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 4,
                        '2xl' => 4,
                    ])
                    ->columnSpan([
                        'sm' => 1,
                        'md' => 2,
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
                        TextInput::make('RAM')->label('RAM')->suffix('GB')->numeric(),
                        TextInput::make('storage')->label('Storage')->suffix('GB')->numeric(),
                        TextInput::make('GPU')->label('GPU'),
                        TextInput::make('color')->label('Color'),
                        TextInput::make('MAC_address')->label('MAC Address'),
                        FileUpload::make('image')->label('Image Attachment')
                            ->multiple()->columnSpanFull()
                            ->acceptedFileTypes(['image/*', 'application/vnd.ms-excel', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->uploadingMessage('File uploading ...')
                            //Storage Setting
                            ->preserveFilenames()->maxSize(50000) //50MB
                            ->disk('public')->directory('Warranty Terms')
                            ->visibility('public')->deletable(false)
                            ->previewable()->downloadable()->openable()->reorderable(),
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
        //]
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.company_name')->label('Company')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('company_number')->label('Company No.')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('AssetModel.asset_model_name')->label('Model')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('asset_code')->label('Asset Code')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('asset_type')->label('Type')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('asset_categories')->label('Categories')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('location.location_name')->label('Location')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('department.department_name')->label('Department')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('project.cost_center_name')->label('Project')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('assetlifecycle.status')->label('Status')->searchable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

            ])
            ->filters([
                SelectFilter::make('asset_type')
                    ->label('Type')
                    ->options(AssetCategories::query()->distinct()->pluck('asset_type', 'asset_type')->toArray()),
                SelectFilter::make('assetlifecycle_id')
                    ->label('Status')
                    ->options(AssetLifeCycle::query()->pluck('status', 'id')),
                SelectFilter::make('assetlifecycle_id')
                    ->label('Location')
                    ->options(Location::all()->pluck('location_name', 'id')),
                SelectFilter::make('department_id')->label('Department')
                    ->options(Department::all()->pluck('department_name', 'id')),
                SelectFilter::make('project_id')->label('Cost Center')
                    ->options(Project::query()->pluck('cost_center_name', 'id')),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Jan 01, '.now()->subYear()->format('Y')),
                        DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Asset from '.Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Asset until '.Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                fn (Model $record): string => AssetResource::getUrl('edit', ['record' => $record->id]),
            )
            ;
    }


    public static function getRelations(): array
    {
        return [
            AssetuserRelationManager::class,
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
    // public static function getRecordSubNavigation(Page $page): array
    // {
    //     return $page->generateNavigationItems([
    //         ViewAsset::class,
    //         EditAsset::class,
    //     ]);
    // }


}
