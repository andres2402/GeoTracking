<?php

use App\Action;
use App\Module;
use App\Permission;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Module::count() < 1) {
            $modulos = Module::insert([
                ['name' => 'Dashboard', 'reference' => 'dashboard', 'parent' => null ,'icon'=> '<i class="nc-icon nc-chart-bar-32"></i>','created_at'=>now(),'updated_At'=>now() ,'visible'=>1],
                ['name' => 'Clientes', 'reference' => 'customers', 'parent' => null  ,'icon'=>'<i class="nc-icon nc-circle-10"></i>', 'created_at'=>now(),'updated_At'=>now() ,'visible'=>1],
                ['name' => 'Usuarios', 'reference' => 'users', 'parent' => null  ,'icon'=>'<i class="nc-icon nc-single-02"></i>', 'created_at'=>now(),'updated_At'=>now(),'visible'=>1],
                ['name' => 'Archivos', 'reference' => 'file manger', 'parent' => null  ,'icon'=>'<i class="nc-icon nc-single-copy-04"></i>', 'created_at'=>now(),'updated_At'=>now() ,'visible'=>1],
                ['name' => 'SMS & Emails', 'reference' => 'sms & emails', 'parent' => null  ,'icon'=>'<i class="nc-icon nc-chat-33"></i>', 'created_at'=>now(),'updated_At'=>now() ,'visible'=>1],
                ['name' => 'Parameters', 'reference' => 'parameters', 'parent' => null  ,'icon'=>'<i class="nc-icon nc-layout-11"></i>', 'created_at'=>now(),'updated_At'=>now() ,'visible'=>1],
                ['name' => 'Logs', 'reference' => 'logs', 'parent' => null  ,'icon'=>null, 'created_at'=>now(),'updated_At'=>now() ,'visible'=>0],
                ['name' => 'Roles', 'reference' => 'roles', 'parent' => null  ,'icon'=>null,  'created_at'=>now(),'updated_At'=>now() ,'visible'=>0],
                ['name' => 'Config', 'reference' => 'config', 'parent' => null  ,'icon'=>null,  'created_at'=>now(),'updated_At'=>now() ,'visible'=>0],
                ['name' => 'Estado de Cuenta', 'reference' => 'accounts', 'parent' => null  ,'icon'=>'<i class="nc-icon nc-bank"></i>',  'created_at'=>now(),'updated_At'=>now() ,'visible'=>1],
                ['name' => 'Sliders', 'reference' => 'sliders', 'parent' => null, 'icon' => '<i class="fa fa-clone"></i>',  'created_at' => now(), 'updated_At' => now(), 'visible' => 1],
                ['name' => 'Planes de Suscripción', 'reference' => 'subscriptions', 'parent' => null, 'icon' => '<i class="fa fa-plus"></i>',  'created_at' => now(), 'updated_At' => now(), 'visible' => 1],
            ]);
            // dashboard
            Action::create(['module_id' => 1, 'name' => 'ver', 'reference' => 'index', 'route' => 'dashboard.index']);

            //clientes
            Action::create(['module_id' => 2, 'name' => 'ver', 'reference' => 'index', 'route' => 'clientes.index']);
            $create=Action::create(['module_id' => 2, 'name' => 'crear', 'reference' => 'create', 'route' => 'clientes.create']);
            Action::create(['module_id' => 2, 'name' => 'guardar', 'reference' => 'store', 'route' => 'clientes.store','parent'=>$create->id]);
            $create=Action::create(['module_id' => 2, 'name' => 'editar', 'reference' => 'edit', 'route' => 'clientes.edit']);
            Action::create(['module_id' => 2, 'name' => 'eliminar', 'reference' => 'destroy', 'route' => 'clientes.destroy']);
            Action::create(['module_id' => 2, 'name' => 'actualizar', 'reference' => 'update', 'route' => 'clientes.update','parent'=>$create->id]);

            //usuarios
            Action::create(['module_id' => 3, 'name' => 'ver', 'reference' => 'index', 'route' => 'users.index']);
            $create=Action::create(['module_id' => 3, 'name' => 'crear', 'reference' => 'create', 'route' => 'users.create']);
            Action::create(['module_id' => 3, 'name' => 'guardar', 'reference' => 'store', 'route' => 'users.store','parent'=>$create->id]);
            $create=Action::create(['module_id' => 3, 'name' => 'editar', 'reference' => 'edit', 'route' => 'users.edit']);
            Action::create(['module_id' => 3, 'name' => 'eliminar', 'reference' => 'destroy', 'route' => 'users.destroy']);
            Action::create(['module_id' => 3, 'name' => 'actualizar', 'reference' => 'update', 'route' => 'users.update','parent'=>$create->id]);

            // file manger
            Action::create(['module_id' => 4, 'name' => 'ver', 'reference' => 'index', 'route' => 'files-admin.index']);

            // sms & emails 
            $create=Action::create(['module_id' => 5, 'name' => 'ver', 'reference' => 'index', 'route' => 'alerting.index']);
            Action::create(['module_id' => 5, 'name' => 'guardar SMS', 'reference' => 'store', 'route' => 'notificacion.sendSms','parent'=>$create->id]);
            Action::create(['module_id' => 5, 'name' => 'guardar Email', 'reference' => 'store', 'route' => 'notificacion.sendEmail','parent'=>$create->id]);

            //parameters
            Action::create(['module_id' => 6, 'name' => 'ver', 'reference' => 'index', 'route' => 'valores-parametros.index']);
            Action::create(['module_id' => 6, 'name' => 'guardar', 'reference' => 'store', 'route' => 'valores-parametros.store']);
            Action::create(['module_id' => 6, 'name' => 'actualizar', 'reference' => 'update', 'route' => 'valores-parametros.update']);
            Action::create(['module_id' => 6, 'name' => 'eliminar', 'reference' => 'destroy', 'route' => 'valores-parametros.destroy']);

            //logs
            Action::create(['module_id' => 7, 'name' => 'ver', 'reference' => 'index',   'route' => 'log.index']);

            //roles
            $create=Action::create(['module_id' => 8, 'name' => 'ver', 'reference' => 'index', 'route' => 'roles.index']);
            Action::create(['module_id' => 8, 'name' => 'guardar', 'reference' => 'store', 'route' => 'roles.store','parent'=>$create->id]);
            Action::create(['module_id' => 8, 'name' => 'actualizar', 'reference' => 'update', 'route' => 'roles.update','parent'=>$create->id]);
            Action::create(['module_id' => 8, 'name' => 'eliminar', 'reference' => 'destroy', 'route' => 'roles.destroy']);

            //config
            $create=Action::create(['module_id' => 9, 'name' => 'ver', 'reference' => 'index', 'route' => 'config.index']);
            Action::create(['module_id' => 9, 'name' => 'actualizar', 'reference' => 'update', 'route' => 'config.update','parent'=>$create->id]);

            //estado de cuenta
            Action::create(['module_id' => 10, 'name' => 'ver', 'reference' => 'index', 'route' => 'accounts.index']);

             // sliders
             Action::create(['module_id' => 11, 'name' => 'ver', 'reference' => 'index', 'route' => 'sliders.index']);
             $create=Action::create(['module_id' => 11, 'name' => 'crear', 'reference' => 'create', 'route' => 'sliders.create']);
             Action::create(['module_id' => 11, 'name' => 'guardar', 'reference' => 'store', 'route' => 'sliders.store','parent'=>$create->id]);
             $create=Action::create(['module_id' => 11, 'name' => 'editar', 'reference' => 'edit', 'route' => 'sliders.edit']);
             Action::create(['module_id' => 11, 'name' => 'eliminar', 'reference' => 'destroy', 'route' => 'sliders.destroy']);
             Action::create(['module_id' => 11, 'name' => 'actualizar', 'reference' => 'update', 'route' => 'sliders.update','parent'=>$create->id]);
            
            // Planes de suscripción
            Action::create(['module_id' => 12, 'name' => 'ver', 'reference' => 'index', 'route' => 'subscriptions.index']);
            $create = Action::create(['module_id' => 12, 'name' => 'crear', 'reference' => 'create', 'route' => 'subscriptions.create']);
            Action::create(['module_id' => 12, 'name' => 'guardar', 'reference' => 'store', 'route' => 'subscriptions.store', 'parent' => $create->id]);
            $create = Action::create(['module_id' => 12, 'name' => 'editar', 'reference' => 'edit', 'route' => 'subscriptions.edit']);
            Action::create(['module_id' => 12, 'name' => 'eliminar', 'reference' => 'destroy', 'route' => 'subscriptions.destroy']);
            Action::create(['module_id' => 12, 'name' => 'actualizar', 'reference' => 'update', 'route' => 'subscriptions.update', 'parent' => $create->id]);

        }
    }
}
