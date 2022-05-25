<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\logic\AlertingLogic;
use App\Http\Controllers\logic\DashboardLogic;
use App\Http\Requests\DashBoardRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use DashboardLogic, AlertingLogic;
    public function __construct()
    {
        $this->middleware('permits')->only([
            'index'
        ]);
    }
    public function index(DashBoardRequest $request){

        $response=[];
        //fillArray chart
        $months=collect([0,0,0,0,0,0,0,0,0,0,0,0]);
        $this->custombersByYear()['data']->map(function($item,$index) use($months){
            $months[$item->mes-1]=$item->contador;
        });


        $response['totalSms']=$this->getTotalSms()['data'];
        $response['totalEmails']=$this->getTotalEmail()['data'];
        $response['customersChart']=$months;
        $response['customers']=$this->statisticsCustomer(request())['data'];
        $response['users']=$this->statisticsUsers(request())['data'];

        return view('pages.dashboard',$response);
    }
}
