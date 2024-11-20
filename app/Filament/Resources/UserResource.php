<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Spatie\Permission\Models\Permission;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('User Information')
                        ->schema([

                            TextInput::make('first_name')->label('First Name'),
                            TextInput::make('middle_name')->label('Second Name'),
                            TextInput::make('last_name')->label('Last name'),
                            TextInput::make('name')->label('Full Name')->required()->columnstart(1),
                            TextInput::make('email')->email(),
                            TextInput::make('personnel_no')->label('Personnel No.'),
                        ])->columns(3),
                    Wizard\Step::make('Employee Information')
                        ->schema([
                            TextInput::make('sub_area'),
                            TextInput::make('organizational_unit'),
                            TextInput::make('employee_group'),
                            TextInput::make('position_name'),
                            TextInput::make('cost_center'),
                            TextInput::make('cost_center_name'),
                            DatePicker::make('start_of_tenure')->date()->columnStart(2),
                        ]),
                    Wizard\Step::make('Admin Control')
                        ->schema([
                            TextInput::make('password')
                                ->password()->required()
                                ->dehydrated(fn($state)=> Hash::make($state))
                                ->minLength(8)
                                ->revealable()
                                ->maxLength(255),
                           Select::make('Roles')
                                ->multiple()
                                ->relationship('roles', 'name')
                                ->searchable()
                                ->preload(),
                            ]),
                ])->columnspan([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ])->columns([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 2,
                    'lg' => 2,
                    'xl' => 2,
                    '2xl' => 2,
                ]),
                // Section::make([
                //     TextInput::make('name')
                //         ->required()
                //         ->columnSpanFull(),
                //     TextInput::make('email')
                //         ->email()
                //         ->required()
                //         ->unique(ignoreRecord: true),
                //     TextInput::make('password')
                //         ->password()->required()
                //         ->dehydrated(fn($state)=> Hash::make($state))
                //         // ->required()
                //         ->minLength(8)
                //         ->revealable()
                //         ->maxLength(255),
                // ])->columns(2),
                // Section::make([
                //     Select::make('Roles')
                //         ->multiple()
                //         ->relationship('roles', 'name')
                //         ->searchable()
                //         ->preload(),
                // ]) ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->icon('heroicon-m-user')
                    ->searchable(),
                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->label('Email')
                    ->sortable()
                    ->copyable()
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->icon('heroicon-m-shield-check')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
            ->defaultPaginationPageOption(25)
            ->deferLoading();
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}/view'),
        ];
    }
}
