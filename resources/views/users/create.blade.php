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
                    <h5 class="card-title">Crear Usuario</h5>
                </div>
                <div class="card-body">
                    @include('layouts.alerts')
                    <form action="{{route('users.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Nombre *</label>
                                <input type="text" name="name" id="input-name" value="{{old('name')}}"
                                    class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Apellido *</label>
                                <input type="text" name="last_name" id="input-name" value="{{old('last_name')}}"
                                    class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Télefono *</label>
                                <input type="text" name="phone" id="input-phone" value="{{old('phone')}}"
                                    class="form-control" placeholder="Telefono" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-email">Email *</label>
                                <input type="email" name="email" id="input-email" value="{{old('email')}}"
                                    class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-password">Role *</label>
                                <select name="role" id="" class="form-control">
                                    <option value="" selected disabled> Seleccione un Role</option>
                                    @foreach ($roles as $item)
                                    <option {{old('role')==$item->id?'selected ':''}} value="{{$item->id}}">
                                        {{$item->name}}</option>
                                    @endforeach
                                </select>
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
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection