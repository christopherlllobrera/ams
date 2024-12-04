<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\AssetUser;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AssetUserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssetUserResource\RelationManagers;
use Faker\Provider\ar_EG\Text;

class AssetUserResource extends Resource
{
    protected static ?string $model = AssetUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Select::make('personnel_no')->label('Personnel No.')
                    ->options(User::query()->pluck('personnel_no', 'id'))
                    ->searchable()->preload()->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $user = $get('personnel_no');
                        if ($user) {
                            $user = User::find($user);
                            $set('email', $user->email);
                            $set('name', $user->name);
                            $set('first_name', $user->first_name);
                            $set('middle_name', $user->middle_name);
                            $set('last_name', $user->last_name);
                        } else {
                            $set('email', null);
                            $set('name', null);
                            $set('first_name', null);
                            $set('middle_name', null);
                            $set('last_name', null);
                        }
                    }),
                TextInput::make('email')->label('Email')->email()->reactive()->dehydrated(),
                TextInput::make('name')->label('Full Name')
                    ->reactive()->disabled()->dehydrated(),
                Hidden::make('first_name')->label('First Name')
                    ->reactive()->disabled()->dehydrated(),
                Hidden::make('middle_name')->label('Middle Name')
                    ->reactive()->disabled()->dehydrated(),
                Hidden::make('last_name')->label('Last Name')
                    ->reactive()->disabled()->dehydrated(),
                Select::make('department_id')->label('Department')
                    ->options(Department::all()->pluck('department_name', 'id'))
                    ->searchable()->preload(),
                Select::make('cost_center_id')->label('Cost Center Name')->hint('WBS')
                    ->options(Project::query()->pluck('cost_center_name', 'id'))
                    ->searchable()->preload()->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $project = $get('cost_center_id');
                        if ($project) {
                            $project = Project::find($project);
                            $set('cost_center', $project->cost_center);

                        } else {
                            $set('cost_center_id', null);
                            $set('cost_center', null);
                        }
                    }),
                TextInput::make('cost_center')->label('Cost Center')->hint('WBS')
                    ->reactive()->disabled()->dehydrated(),
                DatePicker::make('deployment_date'),
                DatePicker::make('return_date')->visibleOn('edit'),
            ])
            ->columns([
                'default' => 2,
                'sm' => 2,
                'md' => 2,
                'lg' => 2,
                'xl' => 2,
                '2xl' => 2,
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        
            ->columns([
                TextColumn::make('asset.company_number')->label('ID')->searchable()->sortable(),
                TextColumn::make('user.personnel_no')->label('Personnel No.'),
                TextColumn::make('email')->label('Email')->searchable()->sortable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable(),
                TextColumn::make('first_name')->label('First Name')->searchable()->sortable(),
                TextColumn::make('last_name')->label('Last Name')->searchable()->sortable(),
                TextColumn::make('department.department_name')->label('Department')->searchable()->sortable(),
                TextColumn::make('cost_center')->label('Cost Center')->searchable()->sortable(),
                TextColumn::make('deployment_date')->label('Deployment Date')->searchable()->sortable()->date(),
                TextColumn::make('return_date')->label('Return Date')->searchable()->sortable()->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListAssetUsers::route('/'),
            'create' => Pages\CreateAssetUser::route('/create'),
            'edit' => Pages\EditAssetUser::route('/{record}/edit'),
        ];
    }
}
