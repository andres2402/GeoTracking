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
                        <h5 class="card-title">Información del cliente</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Nombre *</label>
                                <input disabled type="text" name="name" id="input-name" value="{{$customer->user->name}}"
                                    class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-last_name">Apellido *</label>
                                <input disabled type="text" name="last_name" id="input-last_name" value="{{$customer->user->last_name}}"
                                    class="form-control" placeholder="Apellido" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Télefono *</label>
                                <input disabled type="text" name="phone" id="input-phone" value="{{$customer->user->phone}}"
                                    class="form-control" placeholder="Telefono" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-email">Email *</label>
                                <input disabled type="email" name="email" id="input-email" value="{{$customer->user->email}}"
                                    class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-state">Estado *</label>
                                <select disabled class="form-control" name="state" id="input-state">
                                    <option {{$customer->state == 1?'selected':''}} value="1">Activo</option>
                                    <option {{$customer->state == 2?'selected':''}} value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
