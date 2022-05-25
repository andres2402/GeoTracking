@extends('layouts.app', [
'class' => '',
'elementActive' => 'users'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <h5 class="card-title">Usuarios</h5>
                        </div>
                        <div class="col-md-3 text-right">
                            @checkAction('users', 'users.create')
                            <a href="{{route('users.create')}}" class="btn btn-primary">Crear Usuario</a>
                            @endcheckAction
                            <button class="btn btn-primary btn-filter"><i class="fa fa-filter"
                                    aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div class="card  form-filter" style="display: none">
                        <div class="card-header bg-primary text-white">
                            <h5>Filtros</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('users.index')}}" method="get">
                                <div class="row">
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Escriba nombre" aria-describedby="helpId"
                                            value="{{request()->name}}">
                                        <small id="helpId" class="text-muted">Nombre filtro</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Telefono</label>
                                        <input type="tel" name="phone" id="name" class="form-control"
                                            placeholder="Escriba Telefono" aria-describedby="helpId"
                                            value="{{request()->phone}}">
                                        <small id="helpId" class="text-muted">Telefono filtro</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Email</label>
                                        <input type="email" name="email" id="name" class="form-control"
                                            placeholder="Escriba email" aria-describedby="helpId"
                                            value="{{request()->email}}">
                                        <small id="helpId" class="text-muted">filtro email</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Role</label>
                                        <select name="role" class="form-control" id="">
                                            <option value="" disabled>Selecione role</option>
                                            @foreach ($roles as $item)
                                            <option {{request()->role==$item->id?'selected':''}} value="{{$item->id}}">
                                                {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <small id="helpId" class="text-muted">filtro role</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">estado</label>
                                        <select name="state" class="form-control" id="">
                                            <option {{empty(request()->state)?'selected':''}} disabled>Selecione estado
                                            </option>
                                            <option {{request()->state==1?'selected':''}} value="1">Activo</option>
                                            <option {{request()->state==0?'selected':''}} value="0">Inactivo</option>
                                        </select>
                                        <small id="helpId" class="text-muted">filtro estado</small>
                                    </div>
                                    <a href="{{route('users.index')}}" class="btn btn-primary  btn-block">Limpiar</a>
                                    <button type="submit" class="btn btn-primary  btn-block">filtrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @include('layouts.alerts')
                        <table class="table align-items-center text-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th scope="col">Nombre completo</th>
                                    <th scope="col">Correo electrónico</th>
                                    <th scope="col">role</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->role}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->state}}</td>
                                    <td>
                                        @checkAction('users','users.edit')
                                        <a class="btn btn-info" href="{{route('users.edit',$item)}}"><i
                                                class="nc-icon nc-ruler-pencil"></i>
                                        </a>
                                        @endcheckAction
                                        @if ($item->role_id>1)
                                        @checkAction('users','users.destroy')
                                       
                                        @endcheckAction
                                        @endif
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
@endsection