<?php

namespace App\Filament\Resources;

use DateTime;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Licenses;
use App\Models\Supplier;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\LicenseUser;
use Filament\Support\RawJs;
use App\Models\Manufacturer;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Notifications\Notification;
use App\Filament\Resources\LicensesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LicensesResource\RelationManagers;
use App\Filament\Resources\LicensesResource\RelationManagers\LicenseuserRelationManager;

class LicensesResource extends Resource
{
    protected static ?string $model = Licenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-window';
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
                            ->required()
                            ->disabledOn('edit'),
                        TextInput::make('product_key')
                            ->label('Product Key')->placeholder('Product Key')
                            ->required()->disabledOn('edit'),

                        TextInput::make('seat')
                            ->label('Seat')->placeholder('Seat')->numeric()
                            ->required()->disabledOn('edit'),
                        Placeholder::make('seat_used')
                            ->label('Seat Used')
                            ->content( fn (Licenses $record)=> $record->totalSeat())->hiddenOn('create'),
                        Select::make('categories_id')
                            ->label('Category')->placeholder('Category')
                            ->options([
                                'Productivity Software' => 'Productivity Software',
                                'Security Software' => 'Security Software',
                                'Engineering Software' => 'Engineering Software',
                                'Operating Software' => 'Operating Software',
                                'Multimedia Software' => 'Multimedia Software',
                                'Business Software' => 'Business Software',
                            ])
                            ->disabledOn('edit'),
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
                            ->required()->disabledOn('edit'),
                        TextInput::make('registered_email')
                            ->label('Registered Email')->placeholder('Registered Email')
                            ->required()->email()->disabledOn('edit'),

                        TextArea::make('license_notes')
                            ->label('License Notes')->placeholder('License Notes')
                            ->columnSpanFull()->autosize(true)->rows(5)
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
                            // ->required()
                        ,
                        TextInput::make('license_purchase_cost')
                            ->label('Purchase Cost')
                            ->placeholder('Purchase Cost')
                            // ->required()
                            ->mask(RawJs::make('$money($input)'))
                            ->inputMode('decimal')->prefix('₱'),
                        TextInput::make('serial_key')
                            ->label('Serial Key')->placeholder('Serial Key')
                            ->required()->disabledOn('edit'),
                        DatePicker::make('license_purchase_date')
                            ->label('Purchase Date')
                            // ->required()
                            ,
                        DatePicker::make('license_expiration_date')
                            ->label('Expiration Date'),
                            //->required()
                        FileUpload::make('license_attachment')->label('Attachment')
                            ->multiple()->columnSpanFull()
                            ->acceptedFileTypes(['image/*', 'application/vnd.ms-excel', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->uploadingMessage('Uploading License Attachment...')
                            //Storage Setting
                            ->preserveFilenames()->maxSize(50000) //50MB
                            ->disk('public')->directory('License Attachment')
                            ->visibility('public')->deletable(false)
                            ->previewable()->downloadable()->openable()->reorderable()
                            ,
                    ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('software_name')->label('Software')
                    ->weight(FontWeight::Bold)
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('categories_id')->label('Category')
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('seat')->label('Seat') ->badge()->color('success')
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('seat_used')->label('Seat Used') ->badge()->color('danger')
                    ->getStateUsing(fn (Licenses $record) => $record->totalSeat())
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('supplier.supplier_name')->label('Supplier')
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('manufacturer.manufacturer_name')->label('Manufacturer')
                    ->searchable()->sortable(),
                TextColumn::make('registered_name')->label('Registered Name')
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('registered_email')->label('Registered Email')
                    ->icon('heroicon-m-envelope')->copyable()->iconColor('primary')
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('license_order_number')->label(' License Order No.')
                    ->fontFamily(FontFamily::Mono)
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('license_purchase_cost')->label('Purchase Cost')
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('license_purchase_date')->label('Purchase Date')->date()
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('license_expiration_date')->label('Expiration Date')->date()
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('license_notes')->label('Notes')
                    ->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),

            ])
            ->recordUrl(
                fn (Model $record): string => LicensesResource::getUrl('edit', ['record' => $record->id]),
            )
            ->filters([
                SelectFilter::make('categories_id')
                    ->label('Category')
                    ->placeholder('Category')
                    ->options([
                        'Productivity Software' => 'Productivity Software',
                        'Security Software' => 'Security Software',
                        'Engineering Software' => 'Engineering Software',
                        'Operating Software' => 'Operating Software',
                        'Multimedia Software' => 'Multimedia Software',
                        'Business Software' => 'Business Software',
                    ]),
                SelectFilter::make('supplier_id')
                    ->options(Supplier::query()->pluck('supplier_name', 'id')->toArray())
                    ->label('Supplier Name'),
                SelectFilter::make('manufacturer_id')
                    ->options(Manufacturer::query()->pluck('manufacturer_name', 'id')->toArray())
                    ->label('Manufacturer Name'),
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
                            $indicators['created_from'] = 'License from '.Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'License until '.Carbon::parse($data['created_until'])->toFormattedDateString();
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
                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()->withFilename(date('Y-m-d') . ' - license')])
                        ->label('Export Excel')
                        ->color('success')
                        // ->successNotification(
                        //     Notification::make()
                        //     ->title('License Export')
                        //     ->body('The export is ready. Check in your download folder.')
                        //     ->success()
                        //     ->send()
                        //     // ->sendToDatabase()
                        // )
                        ,
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LicenseuserRelationManager::class,
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
