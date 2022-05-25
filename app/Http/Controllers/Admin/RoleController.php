<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\logic\RoleLogic;
use Session, Validator;

use App\Role;

class RoleController extends Controller
{
   use RoleLogic;

   public function __construct()
   {
      $this->middleware('permits')->only([
         'index', 'store', 'update', 'destroy'
      ]);
   }

   public function index()
   {
      $roles = $this->rolList();
      $modules = $this->rolModulesByAction();

      return view('pages.permits.index')->with('roles', $roles['data'])->with('modules', $modules['data']);
   }

   public function create()
   {
      //
   }

   public function store(Request $request)
   {
      $validation = Validator::make($request->all(), [
         'name' => 'required|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)'
      ], [
         'name.required' => 'Debe enviar el nombre',
         'name.regex' => 'El nombre debe ser texto'
      ]);

      if ($validation->fails()) {
         Session::flash('warning', $validation->errors()->first());
         return back()->withInput();
      }

      $roles = $this->rolAdd($request);
      if ($roles['status']==200) {
         Session::flash('success', 'EL rol ha sido guardado correctamente');
         return back();
      }else{
         if ($roles['status']!=0) {$message = $roles['message'];
         }else{$message = "Estamos presentando inconvenientes en este momento";}

         Session::flash('warning', $message);
         return back()->withInput();
      }
   }

   public function show(Role $role)
   {
      return response()->json([
         'code' => 200,
         'data' => $role,
         'message' => 'Detalle del rol'
      ], 200);
   }

   public function edit($id)
   {
      //
   }

   public function update(Request $request, $id)
   {
      $validation = Validator::make($request->all(), [
         'name' => 'required|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)'
      ], [
         'name.required' => 'Debe enviar el nombre',
         'name.regex' => 'El nombre debe ser texto'
      ]);

      if ($validation->fails()) {
         Session::flash('warning', $validation->errors()->first());
         return back()->withInput();
      }

      $roles = $this->rolUpdate($request, $id);
      if ($roles['status']==200) {
         Session::flash('success', 'EL rol ha sido actualizado correctamente');
         return back();
      }else{
         if ($roles['status']!=0) {$message = $roles['message'];
         }else{$message = "Estamos presentando inconvenientes en este momento";}

         Session::flash('warning', $message);
         return back()->withInput();
      }
   }

   public function destroy($id)
   {
      $role = $this->rolDelete($id);
   }
}
