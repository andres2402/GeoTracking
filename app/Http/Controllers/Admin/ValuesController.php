<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\logic\ValuesParametersLogic;
use App\Http\Controllers\RestActions;
use App\Http\Requests\ValuesParametersRequest;
use App\ParameterValue;
use Illuminate\Http\Request;

class ValuesController extends Controller
{
    use ValuesParametersLogic;
    CONST  MODEL="App\parameterValue";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(ValuesParametersRequest $request)
    {
        $response=$this->addValues($request);
        return response()->json($response,$response['status']);
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
    public function update(ValuesParametersRequest $request, $id)
    {
        $response=$this->put($request,ParameterValue::find($id));
        return response()->json($response,$response['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $param=ParameterValue::find($id);
        $response=$this->remove($param);
        return response()->json(['data'=>null],$response['status']);
    }
}
