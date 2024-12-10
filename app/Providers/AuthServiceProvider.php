<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use App\Models\Asset;
use App\Models\Company;
use App\Models\Project;
use App\Models\Licenses;
use App\Models\Location;
use App\Models\Supplier;
use App\Models\AssetModel;
use App\Models\Department;
use App\Models\Permission;
use Termwind\Components\Li;
use App\Models\Manufacturer;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use PharIo\Manifest\License;
use App\Policies\AssetPolicy;
use App\Models\AssetLifeCycle;
use App\Policies\CompanyPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\ActivityPolicy;
use App\Policies\LicensesPolicy;
use App\Policies\LocationPolicy;
use App\Policies\SupplierPolicy;
use App\Policies\AssetModelPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\ManufacturerPolicy;
use App\Policies\AssetLifeCyclePolicy;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        AssetLifeCycle::class => AssetLifeCyclePolicy::class,
        AssetModel::class => AssetModelPolicy::class,
        Asset::class => AssetPolicy::class,
        Company::class => CompanyPolicy::class,
        Department::class => DepartmentPolicy::class,
        Licenses::class => LicensesPolicy::class,
        Location::class => LocationPolicy::class,
        Manufacturer::class => ManufacturerPolicy::class,
        Project::class => ProjectPolicy::class,
        Supplier::class => SupplierPolicy::class,
        Activity::class => ActivityPolicy::class,

    ];
    public function boot(): void
    {

    }
}
