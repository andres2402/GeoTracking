@extends('layouts.app', [
'class' => '',
'elementActive' => 'profile'
])

@section('content')
<div class="content" id="app">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    @if (session('password_status'))
    <div class="alert alert-success" role="alert">
        {{ session('password_status') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="{{ asset('paper/img/damir-bosnjak.jpg') }}" alt="...">
                </div>
                <div class="card-body" style="min-height: 0px;">
                    <div class="author">
                        @if((auth()->user()->photo) <> null)
                            <img class="avatar border-gray" src="{{ asset('storage/') }}/{{__(auth()->user()->photo)}}" alt="...">
                        @else
                            <img class="avatar border-gray" src="{{ asset('paper/img/mike.jpg') }}" alt="...">
                        @endif
                        <h5 class="title">{{ __(auth()->user()->name)}}</h5>
                        <p class="description mb-1">
                            @ {{ __(auth()->user()->name)}}
                        </p>
                    </div>
                    <p class="description text-center mb-1">
                        Datos del Administrador
                    </p>
                    <form class="col-md-12" action="{{ route('perfil.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="photo" class="form-control">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-info btn-round">{{ __('Actualizar Foto') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{--
            @if (Auth::user()->role_id==1)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Mienbros del equipo') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled team-members">
                            @foreach ($menbers as $item)
                            <li>
                                <div class="row">
                                    <div class="col-md-2 col-2">
                                        <div class="avatar">
                                            <img src="{{ asset('paper/img/faces/ayo-ogunseinde-2.jpg') }}"
                                                alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        {{$item->name}}
                                        <br />
                                        <span class="text-muted">
                                            <small>{{ __('Offline') }}</small>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-3 text-right">
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            --}}
        </div>
        <div class="col-md-8 text-center">
            <form class="col-md-12" action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Editar Perfil') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Nombre') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name"
                                        value="{{ auth()->user()->name }}" required>
                                </div>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Email') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        value="{{ auth()->user()->email }}" required>
                                </div>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-info btn-round">{{ __('Actualizar Cambios') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form class="col-md-12" action="{{ route('perfil.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Cambiar Contraseña') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Contraseña antigua') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="password" name="old_password" class="form-control"
                                        placeholder="Contraseña antigua" required>
                                </div>
                                @if ($errors->has('old_password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Nuevo contraseña') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña"
                                        required>
                                </div>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">{{ __('Confirmacion Contraseña') }}</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Confirmar contraseña" required>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-info btn-round">{{ __('Actualizar Cambios') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection