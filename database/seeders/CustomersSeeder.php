<?php

use App\Customer;
use App\User;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,1)->create()->each(function ($user) {
            $user->customer()->saveMany(factory(Customer::class,1)->make());
        });
    }
}
