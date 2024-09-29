<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view reports', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit reports', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete reports', 'guard_name' => 'web']);
    }
}
