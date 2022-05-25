<?php

namespace App\Http\Controllers\logic;

use App\User as AppUser;
use App\Customer as AppCustomer;
use App\Http\Controllers\RestActions;
use App\Mail\RecoverPassword;
use App\Notifications\PasswordNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
/**
 *
 */
trait UserLogic
{
    use RestActions;


    public function save($request)
    {
        try {
            $request->merge(['role_id'=>$request->role]);
            $inputs=$request->input();
            $inputs['password'] = bcrypt($request->password);
            $user = AppUser::create($inputs);
            if($request->role == 2){
                AppCustomer::create(['user_id' => $user->id]);
            }

            send_sms($user->phone,'querido usuario su contraseña es: '.$request->password);
            $user->notify(new PasswordNotification($request->password));
            return $this->respond('created', $user);
        } catch (\Throwable $e) {
            return $this->respond('server error', [], $e->getMessage());
        }
    }
    public function UserUpdate($request, $model)
    {
        try {
            $changedPassword=false;
            $request->merge(['role_id'=>$request->role]);
            if (is_null($model)) {
                return $this->respond('not_found');
            }
            $inputs=$request->all();
            if(!empty($request->password)){
                $inputs['password'] = bcrypt($request->password);
                $changedPassword=true;
            }else{
                $inputs=$request->except(['password']);
            }

            $model->update($inputs);
            if ($changedPassword) {
                send_sms($model->phone,'querido usuario su contraseña es: '.$request->password);
                $model->notify(new PasswordNotification($request->password));
            }
            return $this->respond('done', $model);
        } catch (\Throwable $e) {
            return $this->respond('server error', [], $e->getMessage());
        }
    }

    public function sendRecoveryMail($model)
    {
        try {
            $model->recover_token = Str::random(10);
            $model->update();
            Mail::to($model->email)
                ->queue(new RecoverPassword($model->recover_token));
            return $this->respond('done', $model);
        } catch (\Throwable $e) {
            return $this->respond('server error', [], $e->getMessage());
        }
    }
}
