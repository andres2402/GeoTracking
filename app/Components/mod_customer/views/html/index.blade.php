@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'customers'
])

@section('content')
    <div class="content">
        <div class="row">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="card-title">Clientes</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                @checkAction('customers', 'clientes.create')
                                <a href="{{route('clientes.create')}}" class="btn btn-primary">Crear cliente</a>
                                @endcheckAction
                                <a style="text-decoration: none; color: white" href="{{route('clientes.exportar', request()->all())}}" class="btn btn-success">Exportar</a>
                                <button class="btn btn-primary btn-filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="card  form-filter" style="display: none">
                            <div class="card-header bg-primary text-white">
                                <h5>Filtros</h5>
                            </div>
                            <div class="card-body">
                                <form  action="{{route('clientes.index')}}"  method="get">
                                    <div class="row">
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Escriba nombre" aria-describedby="helpId" value="{{request()->name}}">
                                            <small id="helpId" class="text-muted">Nombre filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control"
                                                placeholder="Escriba Apellido" aria-describedby="helpId" value="{{request()->last_name}}">
                                            <small id="helpId" class="text-muted">Apellido filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Télefono</label>
                                            <input type="tel" name="phone" id="name" class="form-control"
                                                placeholder="Escriba Telefono" aria-describedby="helpId" value="{{request()->phone}}">
                                            <small id="helpId" class="text-muted">Telefono filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Email</label>
                                            <input type="email" name="email" id="name" class="form-control"
                                                placeholder="Escriba email" aria-describedby="helpId" value="{{request()->email}}">
                                            <small id="helpId" class="text-muted">Email filtro</small>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label for="name">Estado</label>
                                            <select name="state" class="form-control" id="">
                                                <option value="" selected disabled >Selecione estado</option>
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                            <small id="helpId" class="text-muted">Estado filtro</small>
                                        </div>
                                        <a href="{{route('clientes.index')}}" class="btn btn-primary  btn-block">Borrar</a>
                                        <button type="submit"  class="btn btn-primary  btn-block">filtrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center text-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Correo electrónico</th>
                                        <th scope="col">Télefono</th>
                                        <th scope="col">Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr id="{{$customer->id}}">
                                            <td>{{$customer->user->name}}</td>
                                            <td>{{$customer->user->last_name}}</td>
                                            <td>{{$customer->user->email}}</td>
                                            <td>{{$customer->user->phone}}</td>
                                            @if ($customer->state==1)
                                                <td><span class="badge badge-pill badge-success">Activo</span></td>
                                            @else
                                                <td><span class="badge badge-pill badge-danger">Inactivo</span></td>
                                            @endif
                                            <td>
                                                <a class="btn btn-info btn-sm" title="Detalles"
                                                    href="{{route('clientes.show', $customer->id)}}"><i class="nc-icon nc-badge"></i>
                                                </a>
                                                @checkAction('customers', 'clientes.edit')
                                                <a class="btn btn-warning btn-sm" title="Editar"
                                                    href="{{route('clientes.edit', $customer->id)}}"><i class="nc-icon nc-ruler-pencil"></i>
                                                </a>
                                                @endcheckAction
                                                @checkAction('customers', 'clientes.destroy')
                                                <button onClick="deleteResource('/clientes', {{$customer->id}})" type="button"
                                                    class="btn btn-danger btn-sm" title="Eliminar"><i class="nc-icon nc-box"></i>
                                                </button>
                                                @endcheckAction
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-end mt-3">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
