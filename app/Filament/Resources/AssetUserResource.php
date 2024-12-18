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
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

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
                    Select::make('name')->label('Full Name')
                    ->options(User::query()->pluck('name', 'id'))
                    ->searchable()->preload()->disabledOn('edit')->dehydrated()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $user = $get('name');
                        if ($user) {
                            $user = User::find($user);
                            $set('personnel_no', $user->personnel_no);
                            $set('email', $user->email);
                            $set('first_name', $user->first_name);
                            $set('middle_name', $user->middle_name);
                            $set('last_name', $user->last_name);
                        } else {
                            $set('personnel_no', null);
                            $set('email', null);
                            $set('first_name', null);
                            $set('middle_name', null);
                            $set('last_name', null);
                        }
                    })->live()->columnSpanFull()->reactive(),
                TextInput::make('personnel_no')->label('Personnel No.')
                    ->reactive()->disabled()->dehydrated(),
                TextInput::make('email')->label('Email')->email()
                    ->reactive()->disabled()->dehydrated(),
                Hidden::make('first_name')->label('First Name')
                    ->reactive()->disabled()->dehydrated(),
                Hidden::make('middle_name')->label('Middle Name')
                    ->reactive()->disabled()->dehydrated(),
                Hidden::make('last_name')->label('Last Name')
                    ->reactive()->disabled()->dehydrated(),
                Select::make('department_id')->label('Department')
                    ->options(Department::all()->pluck('department_name', 'id'))
                    ->searchable()->preload()->disabledOn('edit')->columnStart(1)
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $department = $get('department_id');
                        if ($department){
                            $department = Department::find($department);
                            $set('cost_center', $department->cost_center);
                        } else{
                            $set('cost_center', null);
                        }
                    })->live()->disabled(fn (Get $get): bool => !empty($get('project_id'))),
                TextInput::make('cost_center')->label('Cost Center')
                    ->reactive()->disabled()->dehydrated(),
                Select::make('project_id')->label('Project')
                    ->options(Project::query()->pluck('project_name', 'id'))
                    ->searchable()->preload()->reactive()
                    ->disabled(fn (Get $get): bool => !empty($get('department_id')))
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $project = $get('project_id');
                        if ($project){
                            $project = Project::find($project);
                            $set('wbs', $project->wbs);
                        } else{
                            $set('wbs', null);
                        }
                    }),
                TextInput::make('wbs')->label('WBS')->hint('Work Breakdown Structure')
                    ->placeholder('WBS')->reactive()->disabled()->dehydrated(),
                DatePicker::make('deployment_date')->disabledOn('edit'),
                DatePicker::make('return_date')->disabledOn('create'),
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
                TextColumn::make('asset.company_number')->label('Company No.')->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('personnel_no')->label('Personnel No.')->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('email')->label('Email')->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('user.name')->label('Name')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('first_name')->label('First Name')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('last_name')->label('Last Name')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('department.department_name')->label('Department')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('project.project_name')->label('Project')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deployment_date')->label('Deployment Date')->sortable()->date()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('return_date')->label('Return Date')->sortable()->date()->toggleable(isToggledHiddenByDefault: false),
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
                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()->withFilename(date('Y-m-d') . ' - Asset User')])
                        ->label('Export Excel')
                        ->color('success')
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
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where(Auth::user()->hasRole('AMS-admin') ? [] : ['email' => Auth::user()->email]);
    }
}
