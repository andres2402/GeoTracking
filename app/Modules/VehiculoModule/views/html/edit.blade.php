@extends('layouts.app')

@section('content')

<div class="content" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Editar Vehiculo</h5>
                </div>
                <div class="card-body">
                    @include('layouts.alerts')
                    <form action="{{ url('/vehiculo/'.$vehiculo->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">Nombre Conductor</label>
                                <select class="form-control" name="Veh_Con_id" required>
                                    @foreach ($conductores as $conductor)
                                    <option value="{{ $conductor->id }}">{{ $conductor->Con_nombre }} {{ $conductor->Con_apellido }} </option>;
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">Numero Documento</label>
                                <select class="form-control" name="Veh_documento">
                                    @foreach ($conductores as $conductor)
                                    <option value=" {{ $conductor->Con_n_documento }} "> {{ $conductor->Con_n_documento }} </option>;
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">Modelo</label>
                                <input type="text" name="Veh_modelo" class="form-control" placeholder="//// ///" value="{{ $vehiculo->Veh_modelo }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">Año</label>
                                <input type="number" name="Veh_año" class="form-control" placeholder="2020" value="{{ $vehiculo->Veh_año }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">Estado</label>
                                <select class="form-control" name="Veh_estado" placeholder="0000000000">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">No. Matricula</label>
                                <input type="number" name="Veh_matricula" class="form-control" placeholder="Matricula" value="{{ $vehiculo->Veh_matricula }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">No. Placa</label>
                                <input type="text" name="Veh_placa" class="form-control" placeholder="Placa" value="{{ $vehiculo->Veh_placa }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">No. Soat</label>
                                <input type="number" name="Veh_soat" class="form-control" placeholder="Soat" value="{{ $vehiculo->Veh_soat }}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label">No. Tecnomecanica</label>
                                <input type="number" name="Veh_tecnomecanica" class="form-control" placeholder="Tecnomecanica" value="{{ $vehiculo->Veh_tecnomecanica }}">
                            </div>
                            <div class="form-group-file col-md-6 col-sm-12">
                                <label>Cargar Soat</label>
                                {{ $vehiculo->Veh_c_soat }}
                                <input type="file" name="Veh_c_soat" value="{{ $vehiculo->Veh_c_soat }}" class="form-control">
                            </div>
                            <div class="form-group-file col-md-6 col-sm-12">
                                <label>Cargar Tecnomecanica</label>
                                {{ $vehiculo->Veh_c_t_mecanica }}
                                <input type="file" name="Veh_c_t_mecanica" value="{{ $vehiculo->Veh_c_t_mecanica }}" class="form-control">
                            </div>
                            <div class="form-group-file col-md-6 col-sm-12">
                                <label>Cargar Tarjeta de Propiedad</label>
                                {{ $vehiculo->Veh_c_t_propiedad }}
                                <input type="file" name="Veh_c_t_propiedad" value="{{ $vehiculo->Veh_c_t_propiedad }}" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success" style="border-radius: 10px">Actualizar Vehiculo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('editado') == 'ok')
        <script>
            Swal.fire(
                'Actualizado!',
                'El vehiculo se actualizo con éxito.',
                'success'
            )
        </script>
    @endif


@endsection