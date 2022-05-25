@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'index',
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div id="user-id-2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5 class="modal-title" id="exampleModalLabel" style="margin-left: 2%">
                                        <strong>
                                            Crear nuevo Vehiculo
                                        </strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <br>
                                    <form action="{{ url('vehiculo') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Nombre Conductor
                                                    *</label>
                                                <select class="form-control" name="Veh_Con_id" required>
                                                    @foreach ($conductores as $conductor)
                                                        <option value="{{ $conductor->id }}">
                                                            {{ $conductor->Con_nombre }}
                                                            {{ $conductor->Con_apellido }} </option>;
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Numero Documento
                                                    *</label>
                                                <select class="form-control" name="Veh_documento" required>
                                                    @foreach ($conductores as $conductor)
                                                        <option value=" {{ $conductor->Con_n_documento }} ">
                                                            {{ $conductor->Con_n_documento }} </option>;
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Modelo *</label>
                                                <input type="text" name="Veh_modelo" class="form-control"
                                                    placeholder="Modelo" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Año *</label>
                                                <input type="number" name="Veh_año" class="form-control"
                                                    placeholder="2020" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Estado *</label>
                                                <select class="form-control" name="Veh_estado" placeholder="0000000000"
                                                    required>
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">No. Matricula *</label>
                                                <input type="number" name="Veh_matricula" class="form-control"
                                                    placeholder="Matricula" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">No. Placa *</label>
                                                <input type="text" name="Veh_placa" class="form-control"
                                                    placeholder="Placa" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">No. Soat *</label>
                                                <input type="number" name="Veh_soat" class="form-control"
                                                    placeholder="Soat" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">No. Tecnomecanica *</label>
                                                <input type="number" name="Veh_tecnomecanica" class="form-control"
                                                    placeholder="Tecnomecanica" required>
                                            </div>
                                            <div class="form-group-file col-md-6 col-sm-12">
                                                <label>Cargar Soat *</label>
                                                <input type="file" name="Veh_c_soat" class="form-control" required>
                                            </div>
                                            <div class="form-group-file col-md-6 col-sm-12">
                                                <label>Cargar Tecnomecanica *</label>
                                                <input type="file" name="Veh_c_t_mecanica" class="form-control" required>
                                            </div>
                                            <div class="form-group-file col-md-6 col-sm-12">
                                                <label>Cargar Tarjeta de Propiedad *</label>
                                                <input type="file" name="Veh_c_t_propiedad" class="form-control" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row justify-content-center">
                                            <button type="submit" class="btn btn-success"
                                                style="border-radius: 10px;  width: 200px;">Crear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-frame" style="margin-top: 1%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <input type="search" class="form-control"
                                        style="border-radius: 10px; width: 985px; height: 45px; background: #EAEAEA"
                                        placeholder="Buscar...">
                                </div>
                                <div>
                                    <button class="btn btn-success btn-filter"
                                        style="border-radius: 10px; width: 135px; height: 45px; margin-left: 27px;">Filtrar</button>
                                    <button type="button" class="btn btn-success"
                                        style="border-radius: 10px; width: 135px; height: 45px; margin-left: 10px;"
                                        data-toggle="modal" data-target="#user-id-2">Crear +</button>
                                </div>
                            </div>

                            <div class="card  form-filter" style="display: none">
                                <div class="card-header bg-success text-white" style="border-radius: 10px;">
                                    <h5>Filtros Vehiculo</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('vehiculo.index') }}" method="get">
                                        <div class="row">
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Conductor</label>
                                                <input type="text" style="border-radius: 10px;" name="Veh_Con_id"
                                                    id="Veh_Con_id" class="form-control" placeholder="Escriba nombre"
                                                    aria-describedby="helpId" value="{{ request()->Veh_Con_id }}">
                                                <small id="helpId" class="text-muted">Conductor filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Modelo</label>
                                                <input type="text" style="border-radius: 10px;" name="Veh_modelo"
                                                    id="Veh_modelo" class="form-control" placeholder="Escriba modelo"
                                                    aria-describedby="helpId" value="{{ request()->Veh_modelo }}">
                                                <small id="helpId" class="text-muted">Modelo filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Año</label>
                                                <input type="number" style="border-radius: 10px;" name="Veh_año"
                                                    id="Veh_año" class="form-control" placeholder="Escriba año"
                                                    aria-describedby="helpId" value="{{ request()->Veh_año }}">
                                                <small id="helpId" class="text-muted">Télefono filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Matricula</label>
                                                <input type="number" style="border-radius: 10px;" name="Veh_matricula"
                                                    id="Veh_matricula" class="form-control"
                                                    placeholder="Escriba matricula" aria-describedby="helpId"
                                                    value="{{ request()->Veh_matricula }}">
                                                <small id="helpId" class="text-muted">Matricula filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Placa</label>
                                                <input type="text" style="border-radius: 10px;" name="Veh_placa"
                                                    id="Veh_placa" class="form-control" placeholder="Escriba placa"
                                                    aria-describedby="helpId" value="{{ request()->Veh_placa }}">
                                                <small id="helpId" class="text-muted">Placa filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Tecnomecanica</label>
                                                <input type="number" style="border-radius: 10px;" name="Veh_tecnomecanica"
                                                    id="Veh_tecnomecanica" class="form-control"
                                                    placeholder="Escriba tecnomecanica" aria-describedby="helpId"
                                                    value="{{ request()->Veh_tecnomecanica }}">
                                                <small id="helpId" class="text-muted">Placa filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Soat</label>
                                                <input type="number" style="border-radius: 10px;" name="Veh_soat"
                                                    id="Veh_soat" class="form-control" placeholder="Escriba soat"
                                                    aria-describedby="helpId" value="{{ request()->Veh_soat }}">
                                                <small id="helpId" class="text-muted">Placa filtro</small>
                                            </div>

                                            <a href="{{ route('vehiculo.index') }}" class="btn btn-success btn-block"
                                                style="border-radius: 10px;">Limpiar</a>
                                            <button type="submit" class="btn btn-success  btn-block"
                                                style="border-radius: 10px;">Filtrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div>
                                @include('layouts.alerts')
                                <table class="table align-items-center text-center table-flush">
                                    <thead class="">
                                        <tr>
                                            <th scope="col">Conductor</th>
                                            <th scope="col">Modelo</th>
                                            <th scope="col">Año</th>
                                            <th scope="col">Matricula</th>
                                            <th scope="col">Placa</th>
                                            <th scope="col">Tecnomecanica</th>
                                            <th scope="col">Soat</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehiculos as $vehiculo)
                                            <tr>
                                                <td>{{ $vehiculo->conductor->Con_nombre }}</td>
                                                <td>{{ $vehiculo->Veh_modelo }}</td>
                                                <td>{{ $vehiculo->Veh_año }}</td>
                                                <td>{{ $vehiculo->Veh_matricula }}</td>
                                                <td>{{ $vehiculo->Veh_placa }}</td>
                                                <td>{{ $vehiculo->Veh_tecnomecanica }}</td>
                                                <td>{{ $vehiculo->Veh_soat }}</td>
                                                <td><a href="{{ url('/vehiculo/' . $vehiculo->id . '/edit') }}"
                                                        class="btn btn-light" style="border-radius: 10px;"
                                                        data-toggle="tooltip" data-placement="bottom"
                                                        title="Editar vehiculo">
                                                        <i class="nc-icon nc-ruler-pencil"></i></a>
                                                    <form action="{{ route('vehiculo.destroy', $vehiculo->id) }}"
                                                        class="d-inline formulario-eliminar">
                                                        <button type="submit" class="btn btn-danger"
                                                            style="border-radius: 10px" data-toggle="tooltip"
                                                            data-placement="bottom" title="Eliminar vehiculo"><i
                                                                class="nc-icon nc-simple-remove"></i>
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
                'El vehiculo se creo con éxito.',
                'success'
            )
        </script>
    @endif

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El vehiculo se elimino con éxito.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Este vehiculo se eliminara definitivamente!",
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
