@extends('layouts.app')

@section('content')

<div class="content" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Editar Empresa</h5>
                </div>
                <div class="card-body">
                    @include('layouts.alerts')
                    <form action="{{ url('/empresa/'.$empresa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Nombre Empresa</label>
                                <input type="text" name="Em_nombre"
                                    class="form-control" placeholder="Nombre" value="{{$empresa->Em_nombre}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Nit</label>
                                <input type="text" name="Em_kit"
                                    class="form-control" placeholder="Kit" value="{{$empresa->Em_kit}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Direccion</label>
                                <input type="text" name="Em_direccion"
                                    class="form-control" placeholder="Calle 00 #00-00" value="{{$empresa->Em_direccion}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-email">Persona Contacto</label>
                                <input type="text" name="Em_per_cont"
                                    class="form-control" placeholder="Nombre" value="{{$empresa->Em_per_cont}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-email">Telefono de contacto</label>
                                <input type="number" name="Em_tel_Cont"
                                    class="form-control" placeholder="601 300 4000" value="{{$empresa->Em_tel_Cont}}">
                            </div>
                            <div class="form-group-file col-md-6 col-sm-12">
                                <label>Logo</label>
                                {{$empresa->Em_logo}}
                                <input type="file" name="Em_logo" value="{{ $empresa->Em_logo }}" class="form-control">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Correo electronico</label>
                                <input type="email" name="Em_correo"
                                    class="form-control" placeholder="Email" value="{{$empresa->Em_correo}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Contraseña</label>
                                <input type="password" name="Em_contrasena"
                                    class="form-control" placeholder="**" value="{{$empresa->Em_contrasena}}">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success" style="border-radius: 10px">Actualizar empresa</button>
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
                'La empresa se actualizo con éxito.',
                'success'
            )
        </script>
    @endif


@endsection