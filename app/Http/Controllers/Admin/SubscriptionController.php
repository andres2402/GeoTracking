<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscription, App\Customer;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index(Request $request)
   {
      $name = $request->get('name');
      $active = $request->get('active');

      $subscriptions = Subscription::orderBy('id', 'DESC')
      ->name($name)
      ->active($active)
      ->paginate(5);

      foreach ($subscriptions as $subscription) {
         $subscription->image_filename = URL::to('/').$subscription->image_filename;
      }

      //
      return view('subscriptions.index')->with('subscriptions', $subscriptions);
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      //
      return view('subscriptions.create');
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(SubscriptionRequest $request)
   {
      try {

         //
         $inputs = $request->input();
         //  dd($inputs);

         if ($request->hasfile('image_filename')){
            $image = $request->file('image_filename');
            $filename  = 'img_' . uniqid() . '.' .  $image->getClientOriginalExtension();
            Storage::putFileAs('uploads/gallery/ads', $image, $filename);
            $inputs["image_filename"] = '/storage/uploads/gallery/ads/'.$filename;
         }


         $response = Subscription::create($inputs);
         session()->flash('success', 'Exito al guardar');
         return redirect()->route('subscriptions.index');


      } catch (\Throwable $th) {
         // session()->flash('danger', $response['error']);
         // return redirect()->back()->withInput();
         throw $th;
      }
   }

   /**
   * Display the specified resource.
   *
   * @param  \App\Subscription  $subscription
   * @return \Illuminate\Http\Response
   */
   public function show(Subscription $subscription)
   {
      //

   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Subscription  $subscription
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $subscription = Subscription::find($id);
      if (!empty($subscription->image_filename)){
         $subscription->image_filename = URL::to('/').$subscription->image_filename;
      }

      return view('subscriptions.edit', compact('subscription'));
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Subscription  $subscription
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, Subscription $subscription)
   {
      try {
         $inputs = $request->all();

         if ($request->hasfile('image_filename')){
            $image = $request->file('image_filename');
            $filename  = 'img_' . uniqid() . '.' .  $image->getClientOriginalExtension();
            Storage::putFileAs('uploads/gallery/ads', $image, $filename);
            $inputs["image_filename"] = '/storage/uploads/gallery/ads/'.$filename;
         }

         $subscription = Subscription::find($request->id);
         $subscription->fill($inputs)->save();

         session()->flash('success', 'Exito al guardar');
         return redirect()->route('subscriptions.index');
      } catch (\Throwable $th) {
         throw $th;
      }

   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Subscription  $subscription
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      // dd($subscription);
      $param = Subscription::find($id)->delete();
      // $response = $this->remove($param);
      return response()->json(['data' => null], 200);
   }

   public function webViewPayu(Request $request)
   {
      try {
         $startDate = date('Y-m-d');
         $endDate = strtotime('+'.$request->quantity.' month', strtotime($startDate));

         $infoRequest = array(
            'quantity' => $request->quantity,
            'startDate' => $startDate,
            'endDate' => $endDate,
         );

         $subscription = Subscription::where('id', $request->planId)->where('active', 1)->first();
         if (!empty($subscription)) {
            $customer = Customer::where('id', $request->customerId)->with('user')->first();
            if (!empty($customer)) {

               $rand = Str::random(20);
               $apiKey = env('PAYU_API_KEY');
               $merchanId = env('PAYU_MERCHANT_ID');
               $account = env('PAYU_ACCOUNT_ID');
               $amount = number_format($subscription->price, 0, ',', '');
               $reference = $subscription->name .' - '. $rand;
               $signature = "$apiKey~$merchanId~$reference~$amount~COP";
               $signature = md5($signature);
               $confirmation = env('URL_CURRENT') . 'api/subscriptions/payu';

               $data = array(
                  'planId' => $request->planId,
                  'customerId' => $request->customerId,
                  'quantity' => $request->quantity
               );
               $data = json_encode($data);

               $response = array(
                  'merchantId' => $merchanId,
                  'accountId' => $account,
                  'description' => $subscription->description,
                  'referenceCode' => $reference,
                  'amount' => $amount,
                  'signature' => $signature,
                  'extra1' => $data,
                  'buyerEmail' => $customer->user->email,
                  'responseUrl' => env('URL_CURRENT') . 'api/subscriptions/response',
                  'confirmationUrl' => $confirmation,
               );

               return view('subscriptions.payments.payu', compact('subscription', 'customer', 'infoRequest', 'response'));
            }else{
               dd("Cliente no disponible");
            }
         }else{
            dd("Plan no disponible");
         }
      } catch (\Exception $e) {
         dd($e);
      }
   }

   public function responsePayu(Request $request)
   {
      if ($request->transactionState==4) {
         //APPROVED
         $data = array(
            'title' => 'Transacción aprobada',
            'message' => '',
            'type' => 'success',
            'icon' => 'fa fa-check-circle',
         );
      }elseif ($request->transactionState==6) {
         //DECLINED
         $data = array(
            'title' => 'Transacción rechazada',
            'message' => '',
            'type' => 'danger',
            'icon' => 'fa fa-minus-circle',
         );
      }elseif ($request->transactionState==7) {
         //PENDING
         $data = array(
            'title' => 'Transacción pendiente',
            'message' => '',
            'type' => 'warning',
            'icon' => 'fa fa-refresh',
         );
      }elseif ($request->transactionState==5) {
         //EXPIRED
         $data = array(
            'title' => 'Transacción expirada',
            'message' => '',
            'type' => 'warning',
            'icon' => 'fa fa-ban',
         );
      }else{
         $data = array(
            'title' => 'Error',
            'message' => '',
            'type' => 'danger',
            'icon' => 'fa fa-times',
         );
      }

      return view('subscriptions.payments.response', compact('data'));
   }

}
