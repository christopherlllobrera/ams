<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Company;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\CompanyResource\Pages;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    // protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Deployment Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Company Name')
                            ->placeholder('Company Name')
                            ->required()
                            ->columnStart(1),
                        FileUpload::make('company_image')
                            ->label('Company Image')
                            ->required()
                            ->columnSpanFull()
                            ->minFiles(1)
                            ->maxFiles(1)
                            ->preserveFilenames()
                            ->previewable()
                            ->disk('public')
                            ->directory('company_images')
                            ->visibility('public')
                            ->deletable()
                            //->downloadable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('company_image')
                    ->label('Company Image')
                    ->width(60)
                    ->height(30),
                TextColumn::make('company_name')
                    ->label('Company Name')
                    ->searchable()
                    ->sortable(),

            ])
            ->recordUrl(
                fn(Model $record): string => CompanyResource::getUrl('edit', ['record' => $record->id]),
            )
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
