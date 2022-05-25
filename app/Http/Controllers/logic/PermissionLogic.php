<?php
namespace App\Http\Controllers\logic;
use App\Http\Controllers\RestActions;
use App\Permission;

trait PermissionLogic
{
   use RestActions;

   public function permissionShow($role, $id)
   {
      try {
         $permits = Permission::where('role_id', $id)->with('action')->get();
         $data = array('role' => $role, 'permits' => $permits);
         return $this->respond('done', $data);
      } catch (\Exception $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

   public function permissionStore($request)
   {
      try {
         $roleId = $request->role_id;
         Permission::where('role_id', $roleId)->delete();
         foreach ($request->permits as $key => $permission) {
            foreach ($permission as $key => $action) {
               Permission::create(['role_id' => $roleId, 'action_id' => $action]);
            }
         }
         return $this->respond('done', []);
      } catch (\Exception $e) {
         return $this->respond('server error', [], $e->getMessage());
      }

   }
}
