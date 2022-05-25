@extends('layouts.app', [
'class' => '',
'elementActive' => 'users'
])

@section('content')
    <div class="content" id="app">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar conductor</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/conductor/'.$conductor->id) }}" method="POST">
                            @csrf
                            {{ method_field('PATCH') }}
                            @include('layouts.alerts')
                            <input type="hidden" name="id" value="{{ $conductor->id }}">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">Nombres</label>
                                    <input type="text" name="Con_nombre" value="{{ $conductor->Con_nombre }}" class="form-control"
                                        placeholder="Nombres">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">Apellidos</label>
                                    <input type="text" name="Con_apellido" value="{{ $conductor->Con_apellido }}"
                                        class="form-control" placeholder="Apellidos">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">Télefono</label>
                                    <input type="number" name="Con_telefono" value="{{ $conductor->Con_telefono }}"
                                        class="form-control" placeholder="601 300 4000">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">Direccion</label>
                                    <input type="text" name="Con_direccion" value="{{ $conductor->Con_direccion }}"
                                        class="form-control" placeholder="Calle 00 # 00">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">Estado</label>
                                    <select name="Con_estado" value="{{ $conductor->Con_estado }}" id="" class="form-control">
                                        <option value="Activo" > Activo</option>
                                        <option value="Inactivo" > Inactivo
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label">Pase</label>
                                    <input type="number" name="Con_n_pase" value="{{ $conductor->Con_n_pase }}" class="form-control"
                                        placeholder="Pase">
                                </div>
                                <div class="form-group-file col-md-6 col-sm-12">
                                    <label>Cargar pase</label>
                                    {{ $conductor->Con_c_pase }}
                                    <input type="file" name="Con_c_pase" value="{{ $conductor->Con_c_pase }}" class="form-control">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-email">Cedula</label>
                                    <input type="number" name="Con_n_documento" value="{{ $conductor->Con_n_documento }}" class="form-control"
                                        placeholder="Cedula">
                                </div>
                                <div class="form-group-file col-md-6 col-sm-12">
                                    <label>Cargar Documento Id</label>
                                    {{ $conductor->Con_c_documento }}
                                    <input type="file" name="Con_c_documento" value="{{ $conductor->Con_c_documento }}" class="form-control">
                                </div>
                                <div class="form-group-file col-md-6 col-sm-12">
                                    <label>Cargar Hoja de Vida</label>
                                    {{ $conductor->Con_c_hoja_vida }}
                                    <input type="file" name="Con_c_hoja_vida" value="{{ $conductor->Con_c_hoja_vida }}" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success" style="border-radius: 10px">Actualizar conductor</button>
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
                'El conductor se actualizo con éxito.',
                'success'
            )
        </script>
    @endif


@endsection