<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoriesResource\Pages;
use App\Filament\Resources\CategoriesResource\RelationManagers;
use Faker\Provider\ar_EG\Text;

class CategoriesResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])
                ->schema([
                    TextInput::make('name')
                        ->label('Category Name')
                        ->placeholder('Category Name')
                        ->required(),
                    TextInput::make('parent_category')
                        ->label('Parent Category')
                        ->placeholder('Parent Category')
                        ->required(),
                    Select::make('sub_category')
                        ->label('Sub Category')
                        ->placeholder('Sub-Category')
                        ->options([
                            'option1' => 'Option 1',
                            'option2' => 'Option 2',
                            'option3' => 'Option 3',]),
                    TextArea::make('category_description')
                        ->label('Description')
                        ->placeholder('Description')
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
                        }),

                ])
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategories::route('/create'),
            'view' => Pages\ViewCategories::route('/{record}'),
            'edit' => Pages\EditCategories::route('/{record}/edit'),
        ];
    }
}
