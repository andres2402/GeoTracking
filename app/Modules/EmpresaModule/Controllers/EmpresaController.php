<?php

namespace App\Modules\EmpresaModule\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EmpresaModule\Empresa;
use Illuminate\Http\Request;

 

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $path = 'EmpresaModule.views.html.';

    public function index(Request $request)
    {

        $nombre = $request->get('Em_nombre');
        $nit = $request->get('Em_kit');
        $direccion = $request->get('Em_direccion');
        $per_cont = $request->get('Em_per_cont');
        $telefono = $request->get('Em_tel_Cont');
        $correo = $request->get('Em_correo');

        $empresas = empresa::Em_nombre($nombre)
        ->Em_kit($nit)
        ->Em_direccion($direccion)
        ->Em_per_cont($per_cont)
        ->Em_tel_Cont($telefono)
        ->Em_correo($correo)
        ->paginate(5);

        return view($this->path .'index')->with('empresas',$empresas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path .'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r = new Empresa();
        $r -> saveEmpresa($request);

        if($request->hasFile("Em_logo")){

              $conductores['Em_logo'] = $request->file('Em_logo')->store('archivosempresa', 'public');
        }else{
            return back();
        }

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
        $empresa=Empresa::findOrFail($id);
        return view($this->path .'edit', compact('empresa'));
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
        $r = new Empresa();
        $r -> updateEmpresa($request, $id);
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
        $empresa = new Empresa();
        $empresa->deleteEmpresa($id);
        return back()->with('eliminar', 'ok');
    }
}
