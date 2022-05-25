<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@paper.com',
            'phone' => '1234567890',
            'code' => '',
            'code_confirmed' => '1',
            'password' => Hash::make('secret'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
