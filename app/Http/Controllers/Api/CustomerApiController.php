<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\logic\CustomerLogic;
use App\Http\Controllers\RestActions;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    use CustomerLogic;
    const MODEL = "App\Customer";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response=$this->all();
        $response['data']->load('user');
        return response()->json($response,$response['status']);
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

    //Registro
    public function signUp(CustomerRequest $request)
    {
        $response=$this->register($request);
        return response()->json($response,$response['status']);
    }

    //Login
    public function signIn(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10',
            'password' => 'required'
        ]);
        $response=$this->login($request);
        return response()->json($response,$response['status']);
    }

    //Logout
    public function signOut(Request $request)
    {
        $response=$this->logout($request);
        return response()->json($response,$response['status']);
    }

    //Forgot password
    public function recovery(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone'
        ]);
        $response=$this->forgotPassword($request);
        return response()->json($response,$response['status']);
    }

    //confirm verification code
    public function verifyCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
            'code' => 'required|exists:users,code'
        ]);
        $response=$this->confirmCode($request);
        return response()->json($response,$response['status']);
    }

    //restore password (new Password)
    public function restore(Request $request)
    {
        $response=$this->restorePassword($request);
        return response()->json($response,$response['status']);
    }
}
