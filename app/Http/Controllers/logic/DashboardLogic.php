<?php
namespace App\Http\Controllers\logic;
use App\Customer;
use App\Http\Controllers\RestActions;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 *
 */
trait DashboardLogic
{
    protected $statusCodes = [
		'done' => 200,
		'created' => 201,
		'removed' => 204,
		'not_valid' => 400,
		'not_found' => 404,
		'conflict' => 409,
		'permissions' => 401,
		'server error' => 500
	];
    public function custombersByYear()
    {
        $months=DB::table('customers')->select(DB::raw(
            "COUNT(*) as contador, MONTH(`created_at`) as mes"
        ))->whereRaw("YEAR(`created_at`)= YEAR(CURRENT_DATE)")
        ->groupByRaw("mes")
        ->get();
        return $this->myResponse('done',$months,null);
    }

    public function statisticsCustomer($request){
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $actives = Customer::whereBetween('created_at', [$request->start_date, $request->end_date])->where('state',1)->count();
            $inactives = Customer::whereBetween('created_at', [$request->start_date, $request->end_date])->where('state',0)->count();
        }else{
            $actives=Customer::where('state',1)->count();
            $inactives=Customer::where('state',0)->count();
        }
        $total=$actives+$inactives;
        return $this->myResponse('done',compact('actives','inactives','total'),null);
    }
    public function statisticsUsers($request){
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $actives = User::whereBetween('created_at', [$request->start_date, $request->end_date])->where('state',1)->count();
            $inactives = User::whereBetween('created_at', [$request->start_date, $request->end_date])->where('state',0)->count();
        }else{
            $actives=User::where('state',1)->count();
            $inactives=User::where('state',0)->count();
        }
        $total=$actives+$inactives;
        return $this->myResponse('done',compact('actives','inactives','total'),null);
    }
    private function myResponse($status, $data = [], $error = null)
	{
		return ['data' => $data, 'status' => $this->statusCodes[$status],'message'=>$status, 'error' => $error];
	}


}
