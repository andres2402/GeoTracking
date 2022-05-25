@extends('layouts.app', [
'class' => '',
'elementActive' => ''
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <h5 class="card-title">Registro de acciones de los usuarios</h5>
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn btn-primary btn-filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div class="card form-filter" style="display: none">
                        <div class="card-header bg-primary text-white">
                            <h5>Filtros</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('log.index')}}" method="get">
                                <div class="row">
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Evento</label>
                                        <input type="text" name="event" id="event" class="form-control" placeholder="Escriba el evento" aria-describedby="helpId" value="{{request()->event}}">
                                        <small id="helpId" class="text-muted">Nombre del evento</small>
                                    </div>
                                    <div class="col-12 col-md-3 form-group">
                                        <label for="name">Causante</label>
                                        <input type="text" name="causerName" id="causerName" class="form-control" placeholder="Escriba el nombre" aria-describedby="helpId" value="{{request()->causerName}}">
                                        <small id="helpId" class="text-muted">Nombre del causante</small>
                                    </div>
                                    <div class="col-12 col-md-3 form-group">
                                        <label for="name"></label>
                                        <input type="text" name="causerLastName" id="causerLastName" class="form-control" placeholder="Escriba el apellido" aria-describedby="helpId" value="{{request()->causerLastName}}">
                                        <small id="helpId" class="text-muted">Apellido del causante</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Acción</label>
                                        <input type="text" name="action" id="action" class="form-control" placeholder="Escriba la acción" aria-describedby="helpId" value="{{request()->action}}">
                                        <small id="helpId" class="text-muted">filtro acción</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Role</label>
                                        <select name="role" class="form-control" id="">
                                            <option value="">Todos</option>
                                            @foreach ($roles as $item)
                                            <option {{request()->role==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <small id="helpId" class="text-muted">filtro role</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Fecha inicial</label>
                                        <input type="date" name="initDate" class="form-control" value="{{request()->initDate}}">
                                        <small id="helpId" class="text-muted">filtro fecha inicial</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Fecha final</label>
                                        <input type="date" name="finDate" class="form-control" value="{{request()->finDate}}">
                                        <small id="helpId" class="text-muted">filtro fecha final</small>
                                    </div>
                                    <a href="{{route('log.index')}}" class="btn btn-primary  btn-block">Limpiar</a>
                                    <button type="submit" class="btn btn-primary  btn-block">filtrar</button>
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
                                    <th></th>
                                    <th scope="col">Evento</th>
                                    <th scope="col">Causante</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Acción</th>
                                    <th scope="col">Fecha</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ucfirst($item->log_name)}}</td>
                                    <td>{{$item->causer ? $item->causer->fullName : 'Sistema'}}</td>
                                    <td>{{$item->causer ? $item->causer->role : 'Indefinido'}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->created_at->format('d/m/Y h:i A')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection