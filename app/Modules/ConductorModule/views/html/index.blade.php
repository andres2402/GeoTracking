@extends('layouts.app', [
'class' => '',
'elementActive' => 'index',
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <div id="user-id-2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title" id="exampleModalLabel" style="margin-left: 2%">
                                    <strong>
                                        Crear nuevo conductor
                                    </strong>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <br>
                                <form action="{{ url('conductor') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="form-control-label">Nombres *</label>
                                            <input type="text" name="Con_nombre" class="form-control" placeholder="Nombres" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="form-control-label">Apellidos *</label>
                                            <input type="text" name="Con_apellido" class="form-control" placeholder="Apellidos" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="form-control-label">Télefono *</label>
                                            <input type="number" name="Con_telefono" class="form-control" placeholder="601 300 4000" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="form-control-label">Dirección *</label>
                                            <input type="text" name="Con_direccion" class="form-control" placeholder="Calle 00 # 00" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="form-control-label">Estado *</label>
                                            <select class="form-control" name="Con_estado" required>
                                                <option value="Activo">Activo</option>
                                                <option value="Inactivo">Inactivo</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="form-control-label">Pase *</label>
                                            <input type="number" name="Con_n_pase" class="form-control" placeholder="Pase" required>
                                        </div>
                                        <div class="form-group-file col-md-6 col-sm-12">
                                            <label>Cargar Pase *</label>
                                            <input type="file" name="Con_c_pase" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="form-control-label">Cedula *</label>
                                            <input type="number" name="Con_n_documento" class="form-control" placeholder="Cedula" required>
                                        </div>
                                        <div class="form-group-file col-md-6 col-sm-12">
                                            <label>Cargar Cedula *</label>
                                            <input type="file" name="Con_c_documento" class="form-control" required>
                                        </div>
                                        <div class="form-group-file col-md-6 col-sm-12">
                                            <label>Cargar Hoja de Vida *</label>
                                            <input type="file" name="Con_c_hoja_vida" class="form-control" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row justify-content-center">
                                        <button type="submit" style="border-radius: 10px; width: 200px;" class="btn btn-success" onclick="registrar()">Crear</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-frame" style="margin-top: 1%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;;">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <input type="search" class="form-control" style="border-radius: 10px; width: 985px; height: 45px; background: #EAEAEA" placeholder="Buscar...">
                            </div>
                            <div>
                                <button class="btn btn-success btn-filter" style="border-radius: 10px; width: 135px; height: 45px; margin-left: 30px;">Filtrar</button>
                                <button type="button" class="btn btn-success" style="border-radius: 10px; width: 135px; height: 45px; margin-left: 10px;" data-toggle="modal" data-target="#user-id-2">Crear +</button>
                            </div>
                        </div>

                        <div class="card  form-filter" style="display: none">
                            <div class="card-header bg-success text-white" style="border-radius: 10px;">
                                <h5>Filtros Conductor</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route('conductor.index')}}" method="get">
                                    <div class="row">
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Nombre</label>
                                            <input type="text" style="border-radius: 10px;" name="Con_nombre" id="Con_nombre" class="form-control" placeholder="Escriba nombre" 
                                            aria-describedby="helpId" value="{{request()->Con_nombre}}">
                                            <small id="helpId" class="text-muted">Nombre filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Apellido</label>
                                            <input type="text" style="border-radius: 10px;" name="Con_apellido" id="Con_apellido" class="form-control" placeholder="Escriba Apellido" 
                                            aria-describedby="helpId" value="{{request()->Con_apellido}}">
                                            <small id="helpId" class="text-muted">Apellido filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Telefono</label>
                                            <input type="number" style="border-radius: 10px;" name="Con_telefono" id="Con_telefono" class="form-control" placeholder="Escriba Telefono" 
                                            aria-describedby="helpId" value="{{request()->Con_telefono}}">
                                            <small id="helpId" class="text-muted">Télefono filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Direccion</label>
                                            <input type="text" style="border-radius: 10px;" name="Con_direccion" id="Con_direccion" class="form-control" placeholder="Escriba Direccion" 
                                            aria-describedby="helpId" value="{{request()->Con_direccion}}">
                                            <small id="helpId" class="text-muted">Dirección filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>No. Pase</label>
                                            <input type="number" style="border-radius: 10px;" name="Con_n_pase" id="Con_n_pase" class="form-control" placeholder="Escriba No. Pase" 
                                            aria-describedby="helpId" value="{{request()->Con_n_pase}}">
                                            <small id="helpId" class="text-muted">No. Pase filtro</small>
                                        </div>

                                        <a href="{{ route('conductor.index') }}"
                                            class="btn btn-success btn-block" style="border-radius: 10px;">Limpiar</a>
                                        <button type="submit" class="btn btn-success  btn-block" style="border-radius: 10px">Filtrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div>
                            @include('layouts.alerts')
                            <table class="table align-items-center text-center table-flush">
                                <thead class="">
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Télefono</th>
                                        <th scope="col">Dirección</th>
                                        <th scope="col">No. Pase</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($conductores as $conductor)
                                    <tr>
                                        <td>{{ $conductor->Con_nombre }}</td>
                                        <td>{{ $conductor->Con_apellido }}</td>
                                        <td>{{ $conductor->Con_telefono }}</td>
                                        <td>{{ $conductor->Con_direccion }}</td>
                                        <td>{{ $conductor->Con_n_pase }}</td>
                                        <td><a href="{{ url('/conductor/' . $conductor->id . '/edit') }}" class="btn btn-light" style="border-radius: 10px" data-toggle="tooltip" data-placement="bottom" title="Editar conductor">
                                                <i class="nc-icon nc-ruler-pencil"></i></a>
                                            <form action="{{ route('conductor.destroy', $conductor->id) }}" class="d-inline formulario-eliminar">
                                                <button type="submit" class="btn btn-danger" style="border-radius: 10px" data-toggle="tooltip" data-placement="bottom" title="Eliminar conductor"><i class="nc-icon nc-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if (session('guardar') == 'ok')
<script>
    Swal.fire(
        'Creado!',
        'El conductor se creo con éxito.',
        'success'
    )
</script>
@endif

@if (session('eliminar') == 'ok')
<script>
    Swal.fire(
        'Eliminado!',
        'El conductor se elimino con éxito.',
        'success'
    )
</script>
@endif

<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Este conductor se eliminara definitivamente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1ED542',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                this.submit();
            }
        })
    });
</script>
@endsection