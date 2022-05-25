<?php
namespace App\Http\Controllers\logic;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\RestActions;

use Auth;
use App\AccountStatement, App\LogOfRecharges;

trait AccountLogic
{
   use RestActions;

   public function accountList($paginate=0)
   {
      try {
         if ($paginate!=0) {
            $paginate = is_numeric($paginate) ? $paginate : 10;
            $accounts = AccountStatement::orderByDesc('id')->paginate($paginate);
         }else{
            $accounts = AccountStatement::orderByDesc('id')->get();
         }
         return $this->respond('done', $accounts);
      } catch (\Exception $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

   public function accountInfoPayu($request)
   {
      try {
         $responseUrl = url()->route('accounts.index');
         $confirmationUrl = env('PAYU_CONFIRMATION_URL');

         $id = Auth::user()->id;
         $email = Auth::user()->email;

         $amount = $request->amount;

         $apiKey = env('PAYU_API_KEY');
         $merchantId = env('PAYU_MERCHANT_ID');
         $accountId = env('PAYU_ACCOUNT_ID');
         $reference = time();
         $currency = env('PAYU_CURRENCY');
         $test = env('PAYU_TEST');
         $signature = md5($apiKey.'~'.$merchantId.'~'.$reference.'~'.$amount.'~'.$currency);

         $data = array(
            'account_id' => $accountId,
            'merchant_id' => $merchantId,
            'description' => 'Recarga',
            'reference' => $reference,
            'tax' => 0,
            'tax_return_base' => 0,
            'amount' => $amount,
            'currency' => $currency,
            'signature' => $signature,
            'test' => $test,
            'buyer_email' => $email,
            'response_url' => $responseUrl,
            'confirmation_url' => $confirmationUrl,
            'extra_one' => $id
         );

         return $this->respond('done', $data);
      } catch (\Exception $e) {
         return $this->respond('server error', [], $e->getMessage());
      }
   }

   public function accountPostPayu($request)
   {
      try {
         $data = json_encode($request->all());
         $apiKey = env('PAYU_API_KEY');
         $merchantId = $request->merchant_id;
         $reference = $request->reference_sale;
         $value = $request->value;
         $currency = $request->currency;
         $statePol = $request->state_pol;
         $extra = $request->extra1;

         $value = number_format($value, 1, '.', '');

         $sign = $request->sign;
         $firm = md5($apiKey.'~'.$merchantId.'~'.$reference.'~'.$value.'~'.$currency.'~'.$statePol);
         //dd($reference);
         if ($sign==$firm) {
            if ($statePol==4) {
               $account = AccountStatement::where('user_id', $extra)->orderByDesc('id')->first();
               if (!empty($account)) {
                  $totalData = Crypt::decryptString($account->total);
                  $previousValue = $account->total;
                  $valueData = Crypt::encryptString($value);

                  $total = $totalData + $value;
                  $total = Crypt::encryptString($total);
               }else{
                  $previousValue = Crypt::encryptString(0);
                  $valueData = Crypt::encryptString($value);
                  $total = Crypt::encryptString($value);
               }

               AccountStatement::create([
                  'user_id' => $extra,
                  'name' => 'Recarga',
                  'previous_value' => $previousValue,
                  'value' => $valueData,
                  'total' => $total,
                  'type' => 1,
                  'state' => 1,
               ]);
            }

            LogOfRecharges::create([
               'user_id' => $extra,
               'reference' => $reference,
               'state' => $statePol,
               'data' => $data,
            ]);
         }else{
            LogOfRecharges::create([
               'user_id' => 1,
               'reference' => $reference,
               'state' => $statePol,
               'data' => $data,
            ]);
         }

         return $this->respond('done', []);
      } catch (\Exception $e) {
         dd($e);
         return $this->respond('server error', [], $e->getMessage());
      }

   }

}
