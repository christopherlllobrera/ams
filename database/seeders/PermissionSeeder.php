<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create user
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);

        //
        Permission::create(['name' => 'create-asset']);
        Permission::create(['name' => 'view-asset']);
        Permission::create(['name' => 'update-asset']);
        Permission::create(['name' => 'delete-asset']);

        //
        Permission::create(['name' => 'create-license']);
        Permission::create(['name' => 'view-license']);
        Permission::create(['name' => 'update-license']);
        Permission::create(['name' => 'delete-license']);

        //
        Permission::create(['name' => 'create-deployed']);
        Permission::create(['name' => 'view-deployed']);
        Permission::create(['name' => 'update-deployed']);
        Permission::create(['name' => 'delete-deployed']);

        Permission::create(['name' => 'view-logs']);

        $this->command->info('Permissions created successfully!');

        Role::create(['name' => 'superadmin'])
            ->givePermissionTo([
                'create-asset','view-asset','update-asset','delete-asset',
                'create-license','view-license','update-license','delete-license',
                'create-deployed','view-deployed','update-deployed','delete-deployed',

                'create-user','update-user','view-user','delete-user',
                'view-logs',
            ]);

        Role::create(['name' => 'AMS-admin'])
            ->givePermissionTo([
                'create-asset','view-asset','update-asset','delete-asset',
                'create-license','view-license','update-license','delete-license',
                'create-deployed','view-deployed','update-deployed','delete-deployed',
            ]);

        Role::create(['name' => 'Service-Desk'])
            ->givePermissionTo([
                'create-asset','view-asset','update-asset',
                'create-license','view-license','update-license',
                'create-deployed','view-deployed','update-deployed',
            ]);

        Role::create(['name' => 'Remote-IT'])
            ->givePermissionTo([
                'create-asset','view-asset',
                'create-license','view-license',
                'create-deployed','view-deployed',
            ]);
        Role::create(['name' => 'user'])
            ->givePermissionTo([
                'view-asset',
                'view-license',
                'view-deployed',
            ]);

        $this->command->info('Roles created successfully!');

        // Start transaction for better performance
        DB::beginTransaction();

        try {
            // Create and assign superadmin
            $admin = User::factory()->create([
                'name' => 'admin',
                'email' => 'iamboss@miescor.ph',
                'password' => Hash::make('4Dmi@50.MIESCoR'),
                'personnel_no' => 10000000,
                'email_verified_at' => now(),
            ]);
            $admin->assignRole('superadmin');
            $this->command->info('Admin user created and assigned superadmin role successfully');

            // Get total users to process
            $totalUsers = User::where('email', '!=', 'iamboss@miescor.ph')->count();
            $processedUsers = 0;

            // Process users in chunks of 1000 for memory efficiency
            User::where('email', '!=', 'iamboss@miescor.ph')
                ->chunk(1000, function ($users) use (&$processedUsers, $totalUsers) {
                    foreach ($users as $user) {
                        $user->assignRole('user');
                        $processedUsers++;
                    }

                    // Show progress
                    $percentage = round(($processedUsers / $totalUsers) * 100, 2);
                    $this->command->info("Processed {$processedUsers} of {$totalUsers} users ({$percentage}%)");
                });

            DB::commit();

            // Final statistics
            $this->command->info('Permission seeding completed successfully!');
            $this->command->table(
                ['Metric', 'Count'],
                [
                    ['Total Users', $totalUsers + 1],
                    ['Admin Users', 1],
                    ['Regular Users', $totalUsers],
                    ['Processed Successfully', $processedUsers]
                ]
            );

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('An error occurred: ' . $e->getMessage());
            throw $e;
        }
    }
}
