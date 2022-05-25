<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\logic\AccountLogic;

use Session, Validator;

class AccountController extends Controller
{
   use AccountLogic;

   public function index(Request $request)
   {
      $accounts = $this->accountList();
      return view('accounts.index')->with('accounts', $accounts['data']);
   }

   public function create()
   {
      //
   }

   public function store(Request $request)
   {
      //
   }

   public function show($id)
   {
      //
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

   public function infoPayu(Request $request)
   {
      $validation = Validator::make($request->all(), [
         'amount' => 'required|numeric'
      ], [
         'amount.required' => 'Debe enviar el valor a recargar',
         'amount.numeric' => 'El valor debe ser numerico'
      ]);

      if ($validation->fails()) {
         return response()->json([
            'status' => 404,
            'data' => null,
            'message' => $validation->errors()->first(),
         ], 404);
      }

      $roles = $this->accountInfoPayu($request);
      if ($roles['status']==200) {
         return response()->json([
            'status' => 200,
            'data' => $roles['data'],
            'message' => 'Info Payu'
         ], 200);
      }else{
         if ($roles['status']!=0) {$status = $roles['status']; $message = $roles['message'];
         }else{$status = 500; $message = "Estamos presentando inconvenientes en este momento";}

         return response()->json([
            'status' => $status,
            'data' => $roles['data'],
            'message' => 'Info Payu',
         ], $status);
      }
   }

}
