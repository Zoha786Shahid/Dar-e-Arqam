<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles with guard_name
        $principalRole = Role::create(['name' => 'Principal', 'guard_name' => 'web']);
        $principalRole->permissions()->attach([1, 2]); // assuming 1 = view campus, 2 = view teacher

        $regionalCoordinatorRole = Role::create(['name' => 'Regional Coordinator', 'guard_name' => 'web']);
        $regionalCoordinatorRole->permissions()->attach([1, 2, 3]); // 3 = view users

        $ownerRole = Role::create(['name' => 'Owner', 'guard_name' => 'web']);
        $ownerRole->permissions()->attach([1, 2, 3, 4]); // 4 = all permissions
    }
}
