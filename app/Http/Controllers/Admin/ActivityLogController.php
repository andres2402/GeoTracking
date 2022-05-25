<?php

namespace App\Http\Controllers\Admin;

use App\ActivityLog;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RestActions;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    use RestActions;

    static  $MODEL = "App\ActivityLog";

    public function __construct()
    {
        $this->middleware('permits')->only([
            'index'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Activity $model)
    {

        $event = request()->event;
        $causerName = request()->causerName;
        $causerLastName = request()->causerLastName;
        $action = request()->action;
        $role = request()->role;
        $initDate = request()->initDate;
        $finDate = request()->finDate;

        $model = $model->orderByDesc('created_at');

        if (!is_null($event)) {
            $model->where('log_name', 'like', "%$event%");
        }
        if (!is_null($causerName)) {
            $model->whereHasMorph('causer', '*', function ($q) use ($causerName) {
                $q->where("name", 'like', $causerName);
            });
        }
        if (!is_null($causerLastName)) {
            $model->whereHasMorph('causer', '*', function ($q) use ($causerLastName) {
                $q->where("last_name", 'like', $causerLastName);
            });
        }
        if (!is_null($action)) $model->where('description', 'like', "%$action%");
        if (!is_null($role)) {
            $model->whereHasMorph('causer', '*', function ($q) use ($role) {
                $q->where('role_id', $role);
            });
        }
        if (!is_null($initDate) || !is_null($finDate)) {
            if (!is_null($initDate)) {
                $model->whereDate('created_at', '>=', $initDate);
            }
            if (!is_null($finDate)) {
                $model->whereDate('created_at', '<=', $finDate);
            }
        }

        $roles = Role::where('state', 1)->get();

        return view('activityLog.index', ['users' => $model->paginate(15), 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
