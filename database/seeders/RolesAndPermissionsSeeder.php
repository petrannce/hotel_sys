<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage clients',
            'manage bookings',
            'manage employees',
            'manage users',
            'request service',
            'client dashboard',
            'employee dashboard',
            'service assignment',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign created permissions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(['manage clients', 'manage bookings', 'manage employees', 'manage users']);

        $client = Role::firstOrCreate(['name' => 'client']);
        $client->syncPermissions(['request service', 'client dashboard']);

        $employee = Role::firstOrCreate(['name' => 'employee']);
        $employee->syncPermissions(['employee dashboard', 'service assignment']);

        // Create demo admin user if it does not exist
        $adminUser = User::firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'fname' => 'Dennis',
            'lname' => 'Paul',
            'username' => 'Depaul',
            'phone' => '0712660170',
            'password' => bcrypt('123456789'), // Use a secure password
            'role' => 'admin', // Only if this field is necessary
        ]);

        // Assign the admin role to this user
        $adminUser->assignRole($admin);

        // Assign roles to existing users based on their current role in the database
        $users = User::all();
        foreach ($users as $user) {
            // Assuming you have a `role` column in your users table
            if ($user->role === 'admin') {
                $user->syncRoles([$admin]);
            } elseif ($user->role === 'employee') {
                $user->syncRoles([$employee]);
            } else {
                $user->syncRoles([$client]);
            }
        }
    }
}
