<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Supplier;
use App\Models\User;
use Filament\Tables\Columns\Summarizers\Count;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('secretpassword'),
            'email_verified_at' => now(),
        ]);

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@miescor.ph',
            'password' => Hash::make('4Dmi@50.MIESCoR'),
            'email_verified_at' => now(),
        ]);

        $this->call([
            //UserSeeder::class,
            CountrySeeder::class,
            RegionSeeder::class,
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            DepartmentSeeder::class,
            BarangaySeeder::class,
            SupplierSeeder::class,

        ]);
    }
}
