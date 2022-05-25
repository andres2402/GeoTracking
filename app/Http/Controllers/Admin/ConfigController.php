<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\logic\CMSInfoLogic;
use App\Http\Requests\CMSRequest;
use App\ParameterValue;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    use CMSInfoLogic;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permits')->only([
            'index',   'update' 
        ]);
    }
    public function index()
    {
        $response = $this->getCMS();
        return view('config.edit', $response['data']);
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
    public function update(CMSRequest $request, $id=null)
    {
        
        $ids=collect($request->ids);
        $descriptions=$request->descriptions;
        try {
            $ids->map(function($item,$index) use ($descriptions){
                ParameterValue::where('id',$item)->update(['description'=>trim($descriptions[$index])]);
            });
            session()->flash('success','Actualizacion exitosa');
        } catch (\Throwable $th) {
            session()->flash('danger',$th->getMessage());
        }
        
        return redirect()->route('config.index');
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
