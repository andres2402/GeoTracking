<?php
namespace App\Http\Controllers\logic;

use App\Http\Controllers\RestActions;
use App\Mail\EmailNotification;
use App\Statistic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

trait AlertingLogic
{
   use RestActions;

    public function sendSms($request){
        $array_phones = array_map(function($item){
            return $item['user']['phone'];
        },$request->customers);
        $id = Auth::user()->id;
        $phones = implode(',',$array_phones);
        $total = count($array_phones);
        $value = $total*env('SMS_COST');
        $req = checkAccountStatus($value,$id,'SMS');
        $check = $req->original;

        if($check['code'] != 200){
            return $this->respond('not_valid',[],$check['message']);
        }

        $response = send_sms($phones, $request->message);
        if($response['status'] == '1x000'){
            $statistic = Statistic::where('user_id',$id)->first();
            if(!empty($statistic)){
                $statistic->total_sms += $total;
                $statistic->update();
            }else{
                $statistic = new Statistic();
                $statistic->user_id = $id;
                $statistic->total_sms = $total;
                $statistic->total_email = 0;
                $statistic->save();
            }
            return $this->respond('done',[]);
        }else{
            return $this->respond('server_error',[]);
        }
    }

    public function sendEmail($request){
        $message = $request->message;
        $id = Auth::user()->id;
        $total = 0;
        foreach($request->customers as $customer){
            Mail::to($customer['user']['email'])
                ->queue(new EmailNotification($message));
                $total++;
        }
        $statistic = Statistic::where('user_id',$id)->first();
            if(!empty($statistic)){
                $statistic->total_email += $total;
                $statistic->update();
            }else{
                $statistic = new Statistic();
                $statistic->user_id = $id;
                $statistic->total_email = $total;
                $statistic->save();
            }
        return $this->respond('done',[]);
    }

    public function getTotalSms(){
        $id = Auth::user()->id;
        $value = Statistic::find($id);
        $total =$value? $value->total_sms:0;
        return $this->respond('done',$total);
    }

    public function getTotalEmail(){
        $id = Auth::user()->id;
        $value = Statistic::find($id);
        $total =$value? $value->total_email:0;
        return $this->respond('done',$total);
    }
}
