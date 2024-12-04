<?php

namespace Database\Seeders;

use App\Models\AssetCategories;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Region;
use App\Models\Company;
use App\Models\Country;
use App\Models\Location;
use App\Models\Province;
use App\Models\Supplier;
use App\Models\Department;
use Spatie\Permission\Models\Permission;
use App\Models\Manufacturer;
use App\Models\Municipality;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\Summarizers\Count;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AssetLifeCycleSeeder::class,
            CompanySeeder::class,
            DepartmentSeeder::class,
            LocationSeeder::class,
            SupplierSeeder::class,
            ManufacturerSeed::class,
            CountrySeeder::class,
            RegionSeeder::class,
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            BarangaySeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            AssetCategoriesSeeder::class,
            ProjectSeeder::class,
            ModelSeeder::class,
            AssetSeeder::class,
        ]);
    }
}
