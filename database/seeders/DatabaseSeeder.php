<?php

namespace Database\Seeders;

use AdminPermisionSeeder;
use Illuminate\Database\Seeder;
use ModulesSeeder;
use ParameterValueSeeder;
use RoleSeeder;
use UsersTableSeeder;

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
            UsersTableSeeder::class,
            RoleSeeder::class,
            ParameterValueSeeder::class,
            ModulesSeeder::class,
            AdminPermisionSeeder::class,
        ]);
    }
}
