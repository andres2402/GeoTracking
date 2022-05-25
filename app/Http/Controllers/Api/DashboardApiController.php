<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\logic\DashboardLogic as Dashboard;
use App\Http\Requests\DashBoardRequest;

class DashboardApiController extends Controller
{
    use Dashboard;
    public function Customer(DashBoardRequest $request){
        $response=$this->statisticsCustomer($request);
        return response()->json($response,$response['status']);
    }
}
