<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
   public function run()
   {
      DB::table('roles')->insert([
         'name' => 'Administrador',
         'unique' => 1,
         'state' => 1,
         'created_at' => now(),
         'updated_at' => now()
      ]);
      DB::table('roles')->insert([
        'name' => 'Cliente',
        'unique' => 1,
        'state' => 1,
        'created_at' => now(),
        'updated_at' => now()
      ]);
   }
}
