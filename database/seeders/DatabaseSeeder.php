<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class, // Add this line
            RolePermissionsSeeder::class,   // Add this line
            // Any other seeders you have
            RolesAndPermissionsSeeder::class,
            RolePermissionsSeeder::class,
        ]);

    }
}
