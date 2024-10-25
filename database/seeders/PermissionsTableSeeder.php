<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Step 1: Create Permissions for each module

        // Campus Permissions
        Permission::create(['name' => 'view campus', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit campus', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete campus', 'guard_name' => 'web']);

        // Evaluation Permissions
        Permission::create(['name' => 'view evaluation', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit evaluation', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete evaluation', 'guard_name' => 'web']);

        // Report Permissions
        Permission::create(['name' => 'view report', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit report', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete report', 'guard_name' => 'web']);

        // Role Permissions
        Permission::create(['name' => 'manage roles', 'guard_name' => 'web']);

        // Permission Management
        Permission::create(['name' => 'manage permissions', 'guard_name' => 'web']);

        // Teacher Permissions
        Permission::create(['name' => 'view teachers', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit teachers', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete teachers', 'guard_name' => 'web']);

        // User Permissions
        Permission::create(['name' => 'view users', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit users', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete users', 'guard_name' => 'web']);

        // Senior Evaluation Permissions
        Permission::create(['name' => 'view senior evaluation', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit senior evaluation', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete senior evaluation', 'guard_name' => 'web']);

        // Step 2: Assign all permissions to the "Owner" role

        // Fetch all permissions
        $allPermissions = Permission::all();

        // Create the Owner role if it doesn't exist
        $ownerRole = Role::firstOrCreate(['name' => 'Owner', 'guard_name' => 'web']);

        // Sync all permissions to the Owner role
        $ownerRole->syncPermissions($allPermissions);

        // Step 3: Create other roles without assigning any permissions by default
        $roles = ['Regional Coordinator', 'Principal', 'Campus Coordinator'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // Now, only the Owner role has all the permissions assigned by default
    }
}
