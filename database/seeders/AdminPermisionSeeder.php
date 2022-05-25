<?php

use App\Action;
use App\Module;
use App\Permission;
use Illuminate\Database\Seeder;

class AdminPermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Permission::count() < 1) {

            Action::all()->each(function ($action){
                Permission::create(['role_id' => 1, 'action_id' => $action->id]);
            });
        }
    }
}
