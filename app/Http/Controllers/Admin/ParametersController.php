<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RestActions;
use App\Http\Requests\ParametersRequest;
use App\parameter;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Rule\Parameters;

class ParametersController extends Controller
{
    use RestActions;
    CONST  MODEL="App\parameter";
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
    public function index()
    {
        $response=$this->all();
        return view('parameters.tables',$response);
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
    public function store(ParametersRequest $request)
    {
        $response=$this->add($request);

        if ($response['status']==201) {
            session()->flash('success','exito al crear');

        }else{
            session()->flash('danger',$response['error']);
        }
        return redirect()->route('valores-parametros.index');
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
    public function update(ParametersRequest $request, $id)
    {
        $model=parameter::find($id);
        $response=$this->put($request,$model);

        if ($response['status']==200) {
            session()->flash('success','exito al actualizar');

        }else{
            session()->flash('danger',$response['error']);
        }
        return redirect()->route('valores-parametros.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $param=parameter::find($id);
        $response=$this->remove($param);
        return response()->json(['data'=>null],$response['status']);

    }
}
