<?php
namespace App\Http\Controllers\logic;
use App\Http\Controllers\RestActions;
use App\Role, App\Module, App\Permission;

trait RoleLogic
{
   use RestActions;

   public function rolList()
   {
      try {

         $user = Role::name(request()->name);
         $user->state(request()->state);
         return $this->respond('done', $user->get());
      } catch (\Throwable $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

   public function rolModulesByAction()
   {
      try {
         $modules = Module::with(['actions'=>function($query){$query->whereNull('parent');}])
         ->get();
         return $this->respond('done', $modules);
      } catch (\Throwable $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

   public function rolAdd($request)
   {
      try {
         Role::create(['name' => $request->name, 'unique' => 2]);
         return $this->respond('done', []);
      } catch (\Exception $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

   public function rolUpdate($request, $id)
   {
      try {
         Role::where('id', $id)
         ->update(['name' => $request->name, 'state' => $request->state]);
         return $this->respond('done', []);
      } catch (\Exception $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

   public function rolDelete($id)
   {
      try {
         Role::where('id', $id)->delete();
         return $this->respond('done', []);
      } catch (\Exception $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

   public function rolPermits($role, $id)
   {
      try {
         $permits = Permission::where('role_id', $id)->with('action')->get();
         $data = array('role' => $role, 'permits' => $permits);
         return $this->respond('done', $data);
      } catch (\Exception $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

}
