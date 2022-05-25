<?php

namespace App\Modules\ConductorModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ConductorModule\Conductor;
use Illuminate\Http\Request;

//se crea una clase ConductorController la cual hereda todas las funcionalidades de la clase Controller.
class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //en esta variable se guarda parte de la ruta la cual se utilizara para indicar las direcciones.
    protected $path = 'ConductorModule.views.html.';


    //en la función index se llaman los datos del modelo Conductor y se muestran en la vista.
    public function index(Request $request)
    {
        $nombre = $request->get('Con_nombre');
        $apellido = $request->get('Con_apellido');
        $telefono = $request->get('Con_telefono');
        $direccion = $request->get('Con_direccion');
        $n_pase = $request->get('Con_n_pase');

        $conductores = conductor::Con_nombre($nombre)
        ->Con_apellido($apellido)
        ->Con_telefono($telefono)
        ->Con_direccion($direccion)
        ->Con_n_pase($n_pase)
        ->paginate(5);

        return view($this->path .'index')->with('conductores',$conductores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //en la función por medio del método create se retorna la vista del create.
    public function create()
    {
        return view($this->path . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //en el método store por medio de la variable r se asigna un nuevo conductor,
     // y por medio de la misma se guarda con los parametros recibimos en el request.
    public function store(Request $request)
    {
        $r = new Conductor();
        $r->saveConductor($request);

        // if ($r['status'] = 200) {
        //     dd($r);
        // }

        // if ($request->hasFile("Con_c_pase", "ccedula", "chojav")) {

        //     $conductores['Con_c_pase'] = $request->file('Con_c_pase')->store('archivosconductor', 'public');
        //     $conductores['Con_c_documento'] = $request->file('Con_c_documento')->store('archivosconductor', 'public');
        //     $conductores['Con_c_hoja_vida'] = $request->file('Con_c_hoja_vida')->store('archivosconductor', 'public');
        // } else {

        //return back();
        // }

        //retornamos un mensaje de alerta por medio de sweet alert.
        return back()->with('guardar', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *
     *
     */

    public function util($id)
    {

        // $inactivo = "Inactivo";
        //M_conductore::where('Con_id', '=', $id)->update('Con_estado', '=', $inactivo);

        // return print('Actualizado');

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

     // se crea una funcion con el método edit que por medio de la variable conductor se esta recuperando un registro,
     // y dicha información será retornada en la vista de edit.
    public function edit($id)
    {
        $conductor = Conductor::findOrFail($id);
        return view($this->path . 'edit', compact('conductor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // se crea una funcion con el método update que por medio de la variable r se asigna un nuevo conductor, 
    // y por la misma se actualiza, se pasan los parametros por medio del request y se busca el conductor a actualizar por su id.
    public function update(Request $request, $id)
    {

        $r = new Conductor();
        $r->updateConductor($request, $id);
        return back()->with('editado', 'ok'); //retornamos un mensaje de alerta por medio de sweet alert.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // se crea una función con el método destroy que es la encargada de eliminar los registros en la base de datos.
     // por medio del find encuentra su id, y por el delete es borrado.
    public function destroy($id)
    {
        // $conductor = new Conductor();
        // $conductor->deleteConductor($id);

        $elim = Conductor::find($id);
        $elim->delete();
        return back()->with('eliminar', 'ok'); //retornamos un mensaje de alerta por medio de sweet alert.
    }
}
