<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of roles
        $roles = [
            'Regional Coordinator',
            'Principal',
            'Campus Coordinator',
        ];

        // Create roles if they don't exist
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // Find the permissions
        $viewPermission = Permission::where('name', 'view reports')->first();
        $editPermission = Permission::where('name', 'edit reports')->first();

        // Attach permissions to roles
        $role1 = Role::where('name', 'Regional Coordinator')->first();
        $role2 = Role::where('name', 'Principal')->first();
        $role3 = Role::where('name', 'Campus Coordinator')->first();

        if ($role1 && $viewPermission && $editPermission) {
            $role1->permissions()->sync([$viewPermission->id, $editPermission->id]);
        }

        if ($role2 && $viewPermission) {
            $role2->permissions()->sync([$viewPermission->id]);
        }

        if ($role3 && $editPermission) {
            $role3->permissions()->sync([$editPermission->id]);
        }

        // Assign roles to users
        $user1 = User::find(1); // Assuming user with ID 1
        $user2 = User::find(2); // Assuming user with ID 2
        $user3 = User::find(3); // Assuming user with ID 3

        if ($user1) {
            $user1->assignRole('Regional Coordinator');
        }

        if ($user2) {
            $user2->assignRole('Principal');
        }

        if ($user3) {
            $user3->assignRole('Campus Coordinator');
        }

        \Log::info('Roles and permissions have been assigned.');
    }

}
