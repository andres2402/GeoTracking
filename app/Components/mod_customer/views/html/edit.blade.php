@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'customers'
])

@section('content')
    <div class="content" id="app">
        <div class="row">
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
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Editar cliente</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('clientes.update',$customer->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-name">Nombre *</label>
                                    <input type="text" name="name" id="input-name" value="{{$customer->user->name}}"
                                        class="form-control" placeholder="Nombre" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-last_name">Apellido *</label>
                                    <input type="text" name="last_name" id="input-last_name" value="{{$customer->user->last_name}}"
                                        class="form-control" placeholder="Apellido" required>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-phone">Télefono *</label>
                                    <input type="text" name="phone" id="input-phone" value="{{$customer->user->phone}}"
                                        class="form-control" placeholder="Telefono" required>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-email">Email *</label>
                                    <input type="email" name="email" id="input-email" value="{{$customer->user->email}}"
                                        class="form-control" placeholder="Email" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-state">Estado *</label>
                                    <select class="form-control" name="state" id="input-state">
                                        <option {{$customer->state == 1?'selected':''}} value="1">Activo</option>
                                        <option {{$customer->state == 0?'selected':''}} value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary btn-round">Actualizar Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Cambiar Contraseña</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('clientes.password', $customer->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-password">Contraseña *</label>
                                    <input type="password" name="password" v-model="password"
                                        id="input-password"  class="form-control"
                                        placeholder="Contraseña" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-password">Repetir Contraseña *</label>
                                    <input type="password" name="password_confirmation" v-model="password"
                                        id="input-password"  class="form-control"
                                        placeholder="Contraseña" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary btn-round">Actualizar Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
