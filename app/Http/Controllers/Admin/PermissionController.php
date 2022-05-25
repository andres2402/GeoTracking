<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\logic\PermissionLogic;
use Session, Validator;

use App\Role;

class PermissionController extends Controller
{
   use PermissionLogic;

   public function index()
   {
      //
   }

   public function create()
   {
      //
   }

   public function store(Request $request)
   {
      $validation = Validator::make($request->all(), [
         'role_id' => 'required',
         'permits' => 'array|nullable'
      ], [
         'role_id.required' => 'Formato incorrecto',
         'permits.array' => 'Formato incorrecto'
      ]);

      if ($validation->fails()) {
         Session::flash('warning', $validation->errors()->first());
         return back()->withInput();
      }

      $permission = $this->permissionStore($request);
      if ($permission['status']==200) {
         Session::flash('success', 'Permiso actualizado correctamente');
         return back();
      }else{
         if ($permission['status']!=0) {$message = $permission['message'];
         }else{$message = "Estamos presentando inconvenientes en este momento";}

         Session::flash('warning', $message);
         return back()->withInput();
      }
   }

   public function show(Role $permit)
   {
      $role = $permit;
      $permits = $this->permissionShow($role, $role->id);
      return($permits);
   }

   public function edit($id)
   {
      //
   }

   public function update(Request $request, $id)
   {
      //
   }

   public function destroy($id)
   {
      //
   }
}
