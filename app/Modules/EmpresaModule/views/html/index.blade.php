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
                                            Crear nueva Empresa
                                        </strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <br>
                                    <form action="{{ url('empresa') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-12" >
                                                <label class="form-control-label">Nombre
                                                    Empresa*</label>
                                                <input type="text" name="Em_nombre" class="form-control"
                                                    placeholder="Nombre" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Nit *</label>
                                                <input type="text" name="Em_kit" class="form-control" placeholder="Nit"
                                                    required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Direccion *</label>
                                                <input type="text" name="Em_direccion" class="form-control"
                                                    placeholder="Calle 00 #00-00" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Persona Contacto
                                                    *</label>
                                                <input type="text" name="Em_per_cont" class="form-control"
                                                    placeholder="Nombre" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Telefono de contacto
                                                    *</label>
                                                <input type="number" name="Em_tel_Cont" class="form-control"
                                                    placeholder="601 300 4000" required>
                                            </div>
                                            <!-- <div class="form-group col-md-6 col-sm-12">
                                                                <label class="form-control-label" for="input-name">Estado *</label>
                                                                <select class="form-control" name="cestado" placeholder="0000000000" required>
                                                                    <option value="Activo">Activo</option>
                                                                    <option value="Inactivo">Inactivo</option>
                                                                </select>
                                                            </div> -->
                                            <div class="form-group-file col-md-6 col-sm-12">
                                                <label>Logo*</label>
                                                <input type="file" name="Em_logo" class="form-control"
                                                    placeholder="Subir Logo" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Correo electronico
                                                    *</label>
                                                <input type="email" name="Em_correo" class="form-control"
                                                    placeholder="Email" required>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-control-label">Contraseña *</label>
                                                <input type="password" name="Em_contrasena" class="form-control"
                                                    placeholder="****" required>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <button type="submit" style="border-radius: 10px;  width: 200px;" class="btn btn-success">Crear</button>
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
                                    <input type="search" class="form-control" style="border-radius: 10px; width: 980px; height: 45px; background: #EAEAEA" placeholder="Buscar...">
                                </div>
                                <div>
                                    <button class="btn btn-success btn-filter" style="border-radius: 10px; width: 135px; height: 45px; margin-left: 27px;">Filtrar</button>
                                    <button type="button" class="btn btn-success" style="border-radius: 10px; width: 135px; height: 45px; margin-left: 10px;" data-toggle="modal"
                                        data-target="#user-id-2">Crear +</button>
                                </div>
                            </div>

                            <div class="card  form-filter" style="display: none">
                                <div class="card-header bg-success text-white" style="border-radius: 10px;">
                                    <h5 >Filtros Empresa</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('empresa.index') }}" method="get">
                                        <div class="row">
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Nombre</label>
                                                <input type="text" style="border-radius: 10px;" name="Em_nombre" id="Em_nombre" class="form-control"
                                                    placeholder="Escriba nombre" aria-describedby="helpId"
                                                    value="{{ request()->Em_nombre }}">
                                                <small id="helpId" class="text-muted">Nombre filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Nit</label>
                                                <input type="number" style="border-radius: 10px;" name="Em_kit" id="Em_kit" class="form-control"
                                                    placeholder="Escriba nit" aria-describedby="helpId"
                                                    value="{{ request()->Em_kit }}">
                                                <small id="helpId" class="text-muted">Nit filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Dirección</label>
                                                <input type="text" style="border-radius: 10px;" name="Em_direccion" id="Em_direccion"
                                                    class="form-control" placeholder="Escriba dirección"
                                                    aria-describedby="helpId" value="{{ request()->Em_direccion }}">
                                                <small id="helpId" class="text-muted">Dirección filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Persona Contacto</label>
                                                <input type="text" style="border-radius: 10px;" name="Em_per_cont" id="Em_per_cont" class="form-control"
                                                    placeholder="Escriba contacto" aria-describedby="helpId"
                                                    value="{{ request()->Em_per_cont }}">
                                                <small id="helpId" class="text-muted">Contacto filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Télefono</label>
                                                <input type="number" style="border-radius: 10px;" name="Em_tel_Cont" id="Em_tel_Cont"
                                                    class="form-control" placeholder="Escriba telefono"
                                                    aria-describedby="helpId" value="{{ request()->Em_tel_Cont }}">
                                                <small id="helpId" class="text-muted">Télefono filtro</small>
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label>Email</label>
                                                <input type="email" style="border-radius: 10px;" name="Em_correo" id="Em_correo" class="form-control"
                                                    placeholder="Escriba email" aria-describedby="helpId"
                                                    value="{{ request()->Em_correo }}">
                                                <small id="helpId" class="text-muted">Email filtro</small>
                                            </div>
                                            <a href="{{ route('empresa.index') }}"
                                            class="btn btn-success btn-block" style="border-radius: 10px;">Limpiar</a>
                                            <button type="submit" style="border-radius: 10px;" class="btn btn-success btn-block">Filtrar</button>
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
                                            <th scope="col">Nit</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Persona Contacto</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Email</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($empresas as $empresa)
                                            <tr>
                                                <td>{{ $empresa->Em_nombre }}</td>
                                                <td>{{ $empresa->Em_kit }}</td>
                                                <td>{{ $empresa->Em_direccion }}</td>
                                                <td>{{ $empresa->Em_per_cont }}</td>
                                                <td>{{ $empresa->Em_tel_Cont }}</td>
                                                <td>{{ $empresa->Em_correo }}</td>
                                                <td>
                                                    <a href="{{ url('/empresa/' . $empresa->id . '/edit') }}"
                                                        class="btn btn-light" style="border-radius: 10px" data-toggle="tooltip"
                                                        data-placement="bottom" title="Editar empresa">
                                                        <i class="nc-icon nc-ruler-pencil"></i></a>
                                                    <form action="{{ route('empresa.destroy', $empresa->id) }}"
                                                        class="d-inline formulario-eliminar">
                                                        <button type="submit" class="btn btn-danger" style="border-radius: 10px" data-toggle="tooltip"
                                                            data-placement="bottom" title="Eliminar empresa"><i
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
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('guardar') == 'ok')
        <script>
            Swal.fire(
                'Creada!',
                'La empresa se creo con éxito.',
                'success'
            )
        </script>
    @endif

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminada!',
                'La empresa se elimino con éxito.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta empresa se eliminara definitivamente!",
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

