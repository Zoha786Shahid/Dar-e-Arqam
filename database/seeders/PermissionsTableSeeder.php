<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert permissions into the database
        Permission::create(['name' => 'view campus', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit campus', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete campus', 'guard_name' => 'web']);

        // Assign permissions to roles
        DB::table('permission_role')->insert([
            ['role_id' => 1, 'permission_id' => 1], // Assign 'view campus' permission to role ID 1
            ['role_id' => 1, 'permission_id' => 2], // Assign 'edit campus' permission to role ID 1
            ['role_id' => 1, 'permission_id' => 3], // Assign 'delete campus' permission to role ID 1
            // Add other role-permission assignments as needed
        ]);
    }
}
