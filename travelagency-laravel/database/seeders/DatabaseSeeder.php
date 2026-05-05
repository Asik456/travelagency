<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;



class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $guard = 'web';

        // ROLES
        $admin = Role::create(['name' => 'admin', 'guard_name' => $guard]);
        $manager = Role::create(['name' => 'manager', 'guard_name' => $guard]);
        $customer = Role::create(['name' => 'customer', 'guard_name' => $guard]);
        $moderator = Role::create(['name' => 'moderator', 'guard_name' => $guard]);

        // PERMISSIONS
        Permission::create(['name' => 'create resources', 'guard_name' => $guard]);
        Permission::create(['name' => 'edit resources', 'guard_name' => $guard]);
        Permission::create(['name' => 'delete resources', 'guard_name' => $guard]);

        Permission::create(['name' => 'create reservations', 'guard_name' => $guard]);
        Permission::create(['name' => 'edit reservations', 'guard_name' => $guard]);

        Permission::create(['name' => 'create reviews', 'guard_name' => $guard]);
        Permission::create(['name' => 'delete reviews', 'guard_name' => $guard]);

        Permission::create(['name' => 'manage users', 'guard_name' => $guard]);

        // ROLE PERMISSIONS
        $admin->givePermissionTo(Permission::all());

        $manager->givePermissionTo([
            'create resources',
            'edit resources',
            'delete resources',
            'edit reservations',
        ]);

        $customer->givePermissionTo([
            'create reservations',
            'create reviews',
        ]);

        $moderator->givePermissionTo([
            'delete reviews',
        ]);

        // TEST USERS
        $adminUser = User::factory()->create([
            'email' => 'admin@test.com',
        ]);
        $adminUser->assignRole('admin');

        $managerUser = User::factory()->create([
            'email' => 'manager@test.com',
        ]);
        $managerUser->assignRole('manager');

        $customerUser = User::factory()->create([
            'email' => 'customer@test.com',
        ]);
        $customerUser->assignRole('customer');

        $moderatorUser = User::factory()->create([
            'email' => 'moderator@test.com',
        ]);
        $moderatorUser->assignRole('moderator');


    }
}
