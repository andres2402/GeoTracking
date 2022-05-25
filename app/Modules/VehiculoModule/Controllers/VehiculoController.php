<?php

namespace App\Modules\VehiculoModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ConductorModule\Conductor;
use App\Modules\VehiculoModule\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected $path = 'VehiculoModule.views.html.';

    public function index(Request $request)
    {   
        $nombrecon = $request->get('Veh_Con_id');
        $modelo = $request->get('Veh_modelo');
        $año = $request->get('Veh_año');
        $matricula = $request->get('Veh_matricula');
        $placa = $request->get('Veh_placa');
        $tecnomecanica = $request->get('Veh_tecnomecanica');
        $soat = $request->get('Veh_soat');

        $vehiculos = vehiculo::Veh_Con_id($nombrecon)
        ->Veh_modelo($modelo)
        ->Veh_año($año)
        ->Veh_matricula($matricula)
        ->Veh_placa($placa)
        ->Veh_tecnomecanica($tecnomecanica)
        ->Veh_soat($soat)
        ->paginate(7);

        $dato['conductores']=Conductor::all();
        $datos['vehiculos']=Vehiculo::all();

        return view($this->path .'index',$datos, $dato)->with('vehiculos',$vehiculos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */


    public function store(Request $request)
    {
        $r = new Vehiculo();
        $r -> saveVehiculo($request);
      
        if($request->hasFile("Veh_c_soat", "Veh_c_t_mecanica", "Veh_c_t_propiedad")){
  
            $vehiculos['Veh_c_soat'] = $request->file('Veh_c_soat')->store('archivosvehiculo', 'public');
            $vehiculos['Veh_c_t_mecanica'] = $request->file('Veh_c_t_mecanica')->store('archivosvehiculo', 'public');
            $vehiculos['Veh_c_t_propiedad'] = $request->file('Veh_c_t_propiedad')->store('archivosvehiculo', 'public');
        } else {

            return back();
        }
        
        return back()->with('guardar', 'ok');
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
        $vehiculo=Vehiculo::findOrFail($id);
        $datos['conductores']=Conductor::all();
        return view($this->path .'edit', compact('vehiculo'), $datos);
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
        $r = new Vehiculo();
        $r -> updateVehiculo($request, $id);
        return back()->with('editado', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $vehiculo = new Vehiculo();
        // $vehiculo->deleteVehiculo($id);

        $elim = Vehiculo::find($id);
        $elim->delete();
        return back()->with('eliminar', 'ok');
    }
}