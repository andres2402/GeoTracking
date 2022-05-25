@extends('layouts.app', [
'class' => '',
'elementActive' => 'subscriptions'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex">
                            <h5 class="card-title titlefigurea5">Planes de Suscripción</h5>
                            <div class="figuretitle6"></div>
                        </div>
                        <div class="col-md-4 text-right">
                            @checkAction('subscriptions', 'subscriptions.create')
                            <a href="{{route('subscriptions.create')}}" class="btn btnayud">Crear Plan de
                                Suscripción</a>
                            @endcheckAction
                            <button class="btn btn-secondary btn-filter"><i class="fa fa-filter"
                                    aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div class="card  form-filter" style="display: none">
                        <div class="card-header bg-warning text-white">
                            <h5>Filtros</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('subscriptions.index')}}" method="get">
                                <div class="row">
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" class="form-control formclass"
                                            placeholder="GOLD100" value="{{request()->name}}">
                                        <small id="helpId" class="text-muted">Nombre plan</small>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="state">Estado</label>
                                        <select name="active" class="form-control formclass" id="state">
                                            <option {{empty(request()->active)?'selected':''}} disabled>Selecione estado
                                            </option>
                                            <option {{request()->active==1?'selected':''}} value="true">Activo</option>
                                            <option {{request()->active==0?'selected':''}} value="false">Inactivo</option>
                                        </select>
                                        <small id="helpId" class="text-muted">Estado</small>
                                    </div>
                                    <div class="col-12 d-flex flex-row justify-content-center">
                                    <div class="col-6 col-md-3">
                                    <a href="{{route('subscriptions.index')}}"
                                        class="btn btnred  btn-block">Limpiar</a>
                                    </div>
                                    <div class="col-6 col-md-3">
                                    <button type="submit" class="btn btnayud  btn-block">filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @include('layouts.alerts')
                        <table class="table align-items-center text-center table-flush">
                            <thead class="thead-dark">
                                <tr>
                                    <th></th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    {{-- <th scope="col">Detalle</th> --}}
                                    <th scope="col">Precio</th>
                                    <th scope="col">Activo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $item)
                                <tr>
                                    <td></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
                                    {{-- <td>
                                        Cant. Servicios ofrecidos: {{$item->limit_offered_services }} <br />
                                        Cant. Servicios a aceptar: {{$item->limit_accepted_services }} <br />
                                        Cant. Promociones Mensuales: {{$item->limit_monthly_promos }} <br />
                                        Cant. Imágenes Compartidas: {{$item->limit_shared_images }} <br />
                                        Cant. Ediciones de Perfil: {{$item->limit_profile_updates }} <br />
                                        ¿Tiene Geolocalización?: {{$item->location == 1 ? "Sí" : "No" }} <br />
                                    </td> --}}
                                    <td>{{ '$'.number_format($item->price, 0, ",", ".")}}</td>
                                    <td>{{$item->active == 1 ? "Sí": "No"}}</td>
                                    <td>                                       
                                        @checkAction('subscriptions','subscriptions.edit')
                                        <a class="btn btngreen" href="{{route('subscriptions.edit',$item)}}"><i
                                            class="nc-icon nc-ruler-pencil"></i>
                                        </a>
                                        @endcheckAction                                        
                                        &nbsp;
                                        @checkAction('subscriptions','subscriptions.edit')
                                        <button type="button" onclick="confirmDelete(this.dataset)" data-id="{{$item->id}}" data-resource="/subscriptions"
                                            class="btn btnred" title="Eliminar"><i
                                            class="fa fa-times"></i>
                                        </button>                                     
                                        @endcheckAction                                        
                                        
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
<script>
    function confirmDelete(data) {
        deleteResource(data.resource, parseInt(data.id));
    }    
</script>
