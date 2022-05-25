<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\logic\UserLogic;
use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use UserLogic;

    static  $MODEL = "App\User";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permits')->only([
            'index', 'store', 'update', 'destroy'
        ]);
    }
    public function index(User $model)
    {
        $model = $model::where('role_id', '<>', 2);
        //filters
        $model->name(request()->fullname);
        $model->state(request()->state);
        $model->phone(request()->phone);
        $model->email(request()->email);
        $model->role(request()->role);
        //end Fileters
        return view('users.index', ['users' => $model->paginate(15), 'roles' => Role::where('state', 1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('state', 1)->get();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $response = $this->save($request);
        if ($response['status'] == 201) {
            session()->flash('success', 'Exito al guardar');
            return redirect()->route('users.index');
        } else {
            session()->flash('danger', $response['error']);
            return redirect()->back()->withInput();
        }
    }

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
    public function edit(User $user)
    {
        $roles = Role::where('state', 1)->get();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $response = $this->UserUpdate($request, $user);

        if ($response['status'] == 200) {
            session()->flash('success', 'exito al actualizar');
        } else {
            session()->flash('danger', $response['error']);
        }
        return redirect()->route('users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $param = User::find($id);
        $response = $this->remove($param);
        return response()->json(['data' => null], $response['status']);
    }

    public function recoverPassword(Request $request)
    {
        //Validate email
        //Validate email exists
        $user = User::where('email', $request->email)->first();
        $response = $this->sendRecoveryMail($user);
        return view('auth.verify');
    }

    public function resetPassword(Request $request)
    {
        //validate token exists
        //validate password 
        //validate password same
        $user = User::where('recover_token', $request->token)->first();
        $response = $this->UserUpdate($request, $user);
        return redirect('login');
    }
}
