<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\logic\AccountLogic;

use App\LogOfRecharges;

class PayuApiController extends Controller
{
   use AccountLogic;

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
      $payu = $this->accountPostPayu($request);
      if ($payu['status']==200) {
         return response()->json([
            'status' => 200,
            'data' => $payu['data'],
            'message' => 'Exito'
         ], 200);
      }else{
         if ($payu['status']!=0) {$status = $payu['status']; $message = $payu['message'];
         }else{$status = 500; $message = "Estamos presentando inconvenientes en este momento";}

         return response()->json([
            'status' => $status,
            'data' => $payu['data'],
            'message' => 'Info Payu',
         ], $status);
      }
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


}
