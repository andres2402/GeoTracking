<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RestActions;
use App\Http\Requests\ParametersRequest;
use App\parameter;

class ParametersApiController extends Controller
{
    use  RestActions;
    const MODEL = "App\parameter";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response=$this->all();
        $response['data']->load('parametersValues');
        return response()->json($response,$response['status']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParametersRequest $request)
    {
        $response=$this->add($request);
        return response()->json($response,$response['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function show(parameter $parameter)
    {

        return response()->json(['data'=>$parameter,'code'=>200,'message'=>'success'],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function update(ParametersRequest $request, parameter $parameter)
    {
        $response=$this->put($request,$parameter);
        return response()->json($response,$response['status']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function destroy(parameter $parameter)
    {
        $response=$this->remove($parameter);
        return response()->json($response,$response['status']);
    }
}
