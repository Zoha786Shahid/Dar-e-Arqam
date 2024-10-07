<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'view campus',
            'edit campus',
            'delete campus',
        ];

        // Ensure all permissions are created in the database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Fetch all permission models (this will automatically assign all available permissions)
        $allPermissions = Permission::all();

        // Create roles
        $ownerRole = Role::firstOrCreate(['name' => 'Owner']);
        $regionalCoordinatorRole = Role::firstOrCreate(['name' => 'Regional Coordinator']);
        $principalRole = Role::firstOrCreate(['name' => 'Principal']);

        // Assign all permissions to Owner role
        $ownerRole->syncPermissions($allPermissions); // This assigns *all* permissions to the Owner

        // Assign specific permissions to Regional Coordinator
        $regionalCoordinatorRole->syncPermissions([
            'view campus',
            'delete campus'
        ]);

        // Principal has no permissions initially
        $principalRole->syncPermissions([]);
    }


}
