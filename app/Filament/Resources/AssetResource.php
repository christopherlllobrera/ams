<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\Department;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                    // ->compact()
                    ->schema([
                        TextInput::make('asset_tag')
                            ->label('Asset Tag')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('asset_name')
                            ->label('Asset Name')
                            ->placeholder('Company Asset Number')
                            ->required(),
                        Select::make('asset_models_id')
                            ->label('Asset Type')
                            ->options(
                                AssetModel::query()->pluck('asset_model_name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->placeholder('Select an asset type'),
                        TextInput::make('serial_number')
                            ->label('Serial Number')
                            ->placeholder('Serial number'),
                        Select::make('categories')
                            ->label('Category')
                            ->searchable()
                            ->preload()
                            ->options([
                                'Computers' => [
                                    'Desktop' => 'Desktop',
                                    'Laptop' => 'Laptop',
                                    'Workstation' => 'Workstation',
                                ],
                                'Mobile Devices' => [
                                    'Smartphone' => 'Smartphone',
                                    'Tablet' => 'Tablet',
                                    'Wearable' => 'Wearable',
                                ],
                                'Networking Equipment' => [
                                    'Router' => 'Router',
                                    'Switch' => 'Switch',
                                    'Access Point' => 'Access Point',
                                    'Network Rack' => 'Network Rack',
                                    'Network Cabinet' => 'Network Cabinet',
                                    'VPN' => 'VPN',
                                    'Intrusion Detection Systems (IDS)' => 'Intrusion Detection Systems (IDS)',
                                    'Patch Panels' => 'Patch Panels',
                                    'Cable Management Tools' => 'Cable Management Tools',
                                ],
                                'Storage Devices' => [
                                    'Hard Disk Drive' => 'Hard Disk Drive',
                                    'Solid State Drive' => 'Solid State Drive',
                                    'Network Attached Storage (NAS)' => 'Network Attached Storage (NAS)',
                                    'Backup Drive' => 'Backup Drive',
                                    'Flash Drive' => 'Flash Drive',
                                    'Memory Card' => 'Memory Card',

                                ],
                                'Peripherals' => [
                                    'Monitor' => 'Monitor',
                                    'Keyboard' => 'Keyboard',
                                    'Mouse' => 'Mouse',
                                    'Printer' => 'Printer',
                                    'Scanner' => 'Scanner',
                                    'Projector' => 'Projector',
                                    'Webcam' => 'Webcam',
                                    'Speaker' => 'Speaker',
                                    'Headset' => 'Headset',
                                    'Microphone' => 'Microphone',
                                    'Docking Station' => 'Docking Station',
                                    'USB Hub' => 'USB Hub',
                                    'UPS' => 'UPS',
                                    'Surge Protector' => 'Surge Protector',
                                    'Charger' => 'Charger',
                                    'Battery' => 'Battery',
                                    'Power Supply' => 'Power Supply',
                                    'Laptop Bag' => 'Laptop Bag',
                                ],
                                'Servers' => [
                                    'Rack Server' => 'Rack Server',
                                    'Blade Server' => 'Blade Server',
                                    'Tower Server' => 'Tower Server',
                                    'Micro Server' => 'Micro Server',
                                    'Mainframe' => 'Mainframe',
                                    'Supercomputer' => 'Supercomputer',
                                    'Physical Server' => 'Physical Server',
                                ],
                                'Wiring and Cabling' => [
                                    'Ethernet Cable' => 'Ethernet Cable',
                                    'Fiber Optic Cable' => 'Fiber Optic Cable',
                                    'Coaxial Cable' => 'Coaxial Cable',
                                    'Twisted Pair Cable' => 'Twisted Pair Cable',
                                    'Patch Cable' => 'Patch Cable',
                                    'Cable Tester' => 'Cable Tester',
                                    'Cable Crimper' => 'Cable Crimper',
                                    'Cable Stripper' => 'Cable Stripper',
                                    'Cable Ties' => 'Cable Ties',
                                    'Cable Labels' => 'Cable Labels',
                                    'Cable Management Tools' => 'Cable Management Tools',
                                ],
                                'Office Supplies & Equipment' => [
                                    'Desk' => 'Desk',
                                    'Chair' => 'Chair',
                                    'Filing Cabinet' => 'Filing Cabinet',
                                    'Shelves' => 'Shelves',
                                    'Whiteboard' => 'Whiteboard',
                                    'Projector Screen' => 'Projector Screen',
                                    'Stapler' => 'Stapler',
                                    'Hole Punch' => 'Hole Punch',
                                    'Scissors' => 'Scissors',
                                    'Notebooks' => 'Notebooks',
                                    'Laminator' => 'Laminator',
                                    'Shredder' => 'Shredder',
                                    'Calculator' => 'Calculator',
                                ],
                                'Consumables' => [
                                    'Ink Cartridges' => 'Ink Cartridges',
                                    'Toner Cartridges' => 'Toner Cartridges',
                                    'Printer Paper' => 'Printer Paper',
                                    'Batteries' => 'Batteries',
                                    'Tapes' => 'Tapes',
                                    'Labels' => 'Labels',
                                    'Stamps' => 'Stamps',
                                    'Envelopes' => 'Envelopes',
                                    'Pens' => 'Pens',
                                    'Pencils' => 'Pencils',
                                    'Highlighters' => 'Highlighters',
                                    'Markers' => 'Markers',
                                    'Rubber Bands' => 'Rubber Bands',
                                    'Paper Clips' => 'Paper Clips',
                                    'Binder Clips' => 'Binder Clips',
                                    'Staples' => 'Staples',
                                    'Rubber Stamps' => 'Rubber Stamps',
                                    'Sticky Notes' => 'Sticky Notes',
                                    'Tape' => 'Tape',
                                    'Glue' => 'Glue',
                                    'Scissors' => 'Scissors',
                                    'Erasers' => 'Erasers',
                                    'Sharpeners' => 'Sharpeners',
                                    'Staplers' => 'Staplers',
                                    'Hole Punches' => 'Hole Punches',
                                    'Laminating Pouches' => 'Laminating Pouches',
                                    'Binding Combs' => 'Binding Combs',
                                    'Shredder Bags' => 'Shredder Bags',
                                ],
                                'Other' => [
                                    'Other' => 'Other',
                                ],

                            ]),
                        Select::make('status')
                            ->label('Status')
                            ->relationship('AssetLifeCycle', 'status')
                            ->placeholder('Status')
                            ->columnStart(3),
                        TextArea::make('asset_note')
                            ->label('Notes')
                            ->reactive()
                            ->placeholder('Notes')
                            // ->autosize(true)
                            ->rows(3)
                            ->columnSpan('full')
                            // ->columns(1)
                            ->hint(function ($state) {
                                $TotalCharactersCount = 255;
                                $charactersCount = strlen($state);
                                $textcount = 0;
                                if ($charactersCount > 0) {
                                    $textcount = ceil(strlen($state) / $TotalCharactersCount);
                                }
                                $leftCharacters = $TotalCharactersCount - ($charactersCount % $TotalCharactersCount);

                                return $leftCharacters.' characters';
                            }),
                        FileUpload::make('asset_attachement')
                            ->label('Asset Image')
                            ->columnSpanFull()
                            ->hint('Max file size: 2MB'),
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
                Section::make('Asset Location')
                    ->schema([
                        Select::make('companies_id')
                            ->label('Company')
                            ->placeholder('Select a company')
                            ->columnStart(2)
                            ->relationship('company', 'company_name'),
                        Select::make('departments_id')
                            ->label('Department')
                            ->placeholder('Select a department')
                            ->relationship('department', 'department_name')
                        ,
                        Select::make('project_id')
                            ->label('Project')
                            ->columnStart(2)
                            ->placeholder('Select a project')
                            ->options([
                                'Project 1' => 'Project 1',
                                'Project 2' => 'Project 2',
                                'Project 3' => 'Project 3',
                            ]),
                        Select::make('locations_id')
                            ->label('Location')
                            ->placeholder('Location')
                            ->relationship('location', 'location_name'),
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
            ]);
        //])
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
