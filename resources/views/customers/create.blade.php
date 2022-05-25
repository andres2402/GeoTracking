@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'customers'
])

@section('content')
    <div class="content" id="app">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Crear cliente</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('clientes.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-name">Nombre *</label>
                                    <input type="text" name="name" id="input-name" value="{{old('name')}}"
                                        class="form-control" placeholder="Nombre" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-last_name">Apellido *</label>
                                    <input type="text" name="last_name" id="input-last_name" value="{{old('last_name')}}"
                                        class="form-control" placeholder="Apellido" required>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-phone">Télefono *</label>
                                    <input type="text" name="phone" id="input-phone" value="{{old('phone')}}"
                                        class="form-control" placeholder="Telefono" required>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-email">Email *</label>
                                    <input type="email" name="email" id="input-email" value="{{old('email')}}"
                                        class="form-control" placeholder="Email" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
                                <button type="submit" class="btn btn-primary btn-round">Crear Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
