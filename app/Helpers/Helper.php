<?php

use App\AccountStatement;

if (!function_exists('send_sms')) {
    function send_sms($phone, $body, $fecha = '')
    {
        $ch=curl_init();

        $url = 'https://api101.hablame.co/api/sms/v2.1/send/';

        $data = array(
            'account' => '10014491',
            'apiKey' => 'alb31PO8iOcuH3N9VogINONY8I4Yai',
            'token' => '152d31601860bf4ddc7557728d70b7f5',
            'toNumber' => $phone,
            'sms' => $body,
            'sendDate' => $fecha,
            'isPriority' => 0,
        );

        curl_setopt ($ch,CURLOPT_URL,$url) ;
        curl_setopt ($ch,CURLOPT_POST,1);
        curl_setopt ($ch,CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt ($ch,CURLOPT_TIMEOUT, 20);
        $response= curl_exec($ch);
        curl_close($ch);
        $response= json_decode($response ,true) ;

        return $response;
    }
}

if (!function_exists('checkAccountStatus')) {
   function checkAccountStatus($valueData, $id, $message='Gasto')
   {
      $account = AccountStatement::where('user_id', $id)->orderByDesc('id')->first();
      if (!empty($account)) {
         $totalData = Crypt::decryptString($account->total);

         if ($valueData <= $totalData) {
            $previousValue = $account->total;
            $value = Crypt::encryptString($valueData);

            $total = $totalData - $valueData;
            $total = Crypt::encryptString($total);

            AccountStatement::create([
               'user_id' => $id,
               'name' => $message,
               'previous_value' => $previousValue,
               'value' => $value,
               'total' => $total,
               'type' => 2,
               'state' => 1,
            ]);

            return response()->json([
               'code' => 200,
               'data' => null,
               'message' => 'Estado de cuenta actualizado'
            ], 200);
         }else{
            return response()->json([
               'code' => 404,
               'data' => null,
               'message' => 'Saldo insuficiente'
            ], 404);
         }
      }else{
         return response()->json([
            'code' => 404,
            'data' => null,
            'message' => 'Saldo insuficiente'
         ], 404);
      }
   }
}
