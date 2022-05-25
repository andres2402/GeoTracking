<?php

namespace App\Http\Controllers\logic;

use App\Http\Controllers\RestActions;
use App\ParameterValue;
use Illuminate\Http\Request;


trait CMSInfoLogic
{
    use RestActions;
    public function getCMS()
    {
        $redes=ParameterValue::whereHas('parameter',function($parameter){
            $parameter->where('extra','3,141592')->where('state',1);
        })
        ->where('state',1)
        ->get();

        $infoCorp=ParameterValue::whereHas('parameter',function($parameter){
            $parameter->where('extra','2,71828')->where('state',1);
        })
        ->where('state',1)
        ->get();
        return $this->respond('done',compact('redes','infoCorp'));
    }

}
