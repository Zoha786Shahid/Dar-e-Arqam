<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Regional Coordinator',
            'Principal',
            'Campus Coordinator',
        ];

        // Create roles if they don't exist
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // Attach permissions to roles
        $viewPermission = Permission::where('name', 'view reports')->first();
        $editPermission = Permission::where('name', 'edit reports')->first();

        // Assuming roles were just created, you can attach permissions now
        $role1 = Role::where('name', 'Regional Coordinator')->first();
        $role2 = Role::where('name', 'Principal')->first();
        $role3 = Role::where('name', 'Campus Coordinator')->first();

        $role1->permissions()->attach([$viewPermission->id, $editPermission->id]);
        $role2->permissions()->attach([$viewPermission->id]);
        $role3->permissions()->attach([$editPermission->id]);
    }

}
