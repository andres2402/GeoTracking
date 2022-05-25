<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade, View, Auth;
use App\viewPermission;

class BladeServiceProvider extends ServiceProvider
{
   /**
   * Register services.
   *
   * @return void
   */
   public function register()
   {
      //
   }

   /**
   * Bootstrap services.
   *
   * @return void
   */
   public function boot()
   {
      View::composer(['layouts.sidebar','layouts.page_templates.auth'], function ($view) {
         $idRole = Auth::user()->role_id;
         $modules = viewPermission::where('role_id', $idRole)
         ->where('action_reference', 'index')
         ->groupBy('role_id', 'module_reference')
         ->get();
         $view->with(['modules' => $modules]);
      });

      Blade::if('isAdmin', function () {
         if (Auth::user()->role_id==1) {
            return true;
         }
      });

      Blade::if('checkAction', function ($reference, $route) {
         $idRole = Auth::user()->role_id;
         $dataView = viewPermission::where('role_id', $idRole)
         ->where('module_reference', $reference)
         ->where('action_route', $route)
         ->exists();
         return $dataView;
      });
   }
}
