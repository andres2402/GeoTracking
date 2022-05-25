@extends('layouts.app', [
'class' => '',
'elementActive' => 'sliders'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-9 d-flex">
                            <h5 class="card-title titlefigurea4">Sliders</h5>
                            <div class="figuretitle3"></div>
                        </div>
                        <div class="col-md-3 text-right">
                            @checkAction('sliders', 'sliders.create')
                            <a href="{{route('sliders.create')}}" class="btn btnayud">Crear Slider</a>
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
                            <form action="{{route('sliders.index')}}" method="get">
                                <div class="row">
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" class="form-control formclass"
                                            aria-describedby="helpId"
                                            value="{{request()->name}}">
                                        <small id="helpId" class="text-muted">Nombre Slider</small>
                                    </div>                                   
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="state">Estado</label>
                                        <select name="active" class="form-control formclass" id="state">
                                            <option {{empty(request()->active)?'selected':''}} disabled>Selecione estado
                                            </option>
                                            <option {{request()->active==1?'selected':''}} value="1">Activo</option>
                                            <option {{request()->active==0?'selected':''}} value="false">Inactivo</option>
                                        </select>
                                        <small id="helpId" class="text-muted">Estado</small>
                                    </div>                              
                                    <div class="col-12 d-flex flex-row justify-content-center">
                                    <div class="col-6 col-md-3">
                                    <a href="{{route('sliders.index')}}" class="btn btnred  btn-block">Limpiar</a>
                                    </div>
                                    <div class="col-6 col-md-3">
                                    <button type="submit" class="btn btnayud  btn-block">filtrar</button>
                                    </div>
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
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Activo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $item)
                                <tr>
                                    <td></td>
                                    <td>{{$item->name}}</td>                                  
                                    <td>{{ $pv::GetValue($item->fk_slider_type_id)}}</td>                                  
                                    <td>{{$item->active == 1 ? "Sí": "No"}}</td>
                                    <td>
                                        <a class="btn btnayud" href="{{route('sliders.show',$item->id)}}"><i
                                                class="fa fa-search-plus"></i>
                                        </a>
                                        @checkAction('sliders','sliders.edit')
                                        <a class="btn btngreen" href="{{route('sliders.edit',$item)}}"><i
                                                class="fa fa-edit"></i>
                                        </a>
                                        @endcheckAction
                                        
                                        @checkAction('sliders','sliders.destroy')
                                        <button onclick="deleteResource('/sliders',{{$item->id}})" class="btn btnred">
                                            <i class="fa fa-times"></i>
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