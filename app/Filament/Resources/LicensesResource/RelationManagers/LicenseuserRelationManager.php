<?php

namespace App\Filament\Resources\LicensesResource\RelationManagers;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Livewire\Component;

class LicenseuserRelationManager extends RelationManager
{
    protected static string $relationship = 'licenseusers';
    protected static ?string $title = 'Deployment';
    protected static ?string $heading = 'User License';
    protected static bool $isLazy = false;
    protected static ?string $label = 'License';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            //    TextInput::make('license_id')
            //         ->required()
            //         ->maxLength(255),
                Select::make('personnel_no')->label('Personnel No.')
                    ->options(User::query()->pluck('personnel_no', 'id'))
                    ->searchable()->preload()->live()->disabledOn('edit')
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
                TextInput::make('email')->label('Email')->email()->reactive()->dehydrated()->disabledOn('edit'),
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
                    ->searchable()->preload()->disabledOn('edit'),
                Select::make('cost_center_id')->label('Cost Center Name')->hint('WBS')
                    ->options(Project::query()->pluck('cost_center_name', 'id'))
                    ->searchable()->preload()->live()->disabledOn('edit')
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
                TextInput::make('seat_used')->default(1)->disabled()->dehydrated(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
           //->recordTitleAttribute('license_id')
           ->heading('User')
           ->emptyStateHeading('No user yet')
           ->columns([
               TextColumn::make('licenses.software_name')->label('Software Name')->sortable()->toggleable(isToggledHiddenByDefault: false),
               TextColumn::make('user.personnel_no')->label('Personnel No.')->sortable()->toggleable(isToggledHiddenByDefault: false),
               TextColumn::make('email')->label('Email')->sortable()->toggleable(isToggledHiddenByDefault: false),
               TextColumn::make('name')->label('Name')->sortable()->toggleable(isToggledHiddenByDefault: true),
               TextColumn::make('first_name')->label('First Name')->sortable()->toggleable(isToggledHiddenByDefault: true),
               TextColumn::make('last_name')->label('Last Name')->sortable()->toggleable(isToggledHiddenByDefault: true),
               TextColumn::make('department.department_name')->label('Department')->sortable()->toggleable(isToggledHiddenByDefault: false),
               TextColumn::make('cost_center')->label('Cost Center')->sortable()->toggleable(isToggledHiddenByDefault: false),
           ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add User')
                    ->disableCreateAnother()
                    ->after(function (Component $livewire) {
                        $livewire->dispatch('refreshSeat');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function (Component $livewire) {
                        $livewire->dispatch('refreshSeat');
                    }),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function (Component $livewire) {
                            $livewire->dispatch('refreshSeat');
                        }),
                ]),
            ]);
    }
}
