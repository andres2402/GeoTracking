@extends('layouts.app', [
'class' => '',
'elementActive' => 'dashboard'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-circle-10 text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Usuarios</p>
                                <p class="card-title">{{$users['total']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <div class="row">
                            <span class="text-success col">Actives:{{$users['actives']}}</span>
                            <span class="text-danger col">Inactives:{{$users['inactives']}}</span>
                        </div>
                        @if(request()->start_date)
                        <span> desde:{{request()->start_date}}</span>
                        
                        @endif
                        @if(request()->end_date)
                        <span> hasta:{{request()->end_date}}</span>
                        
                        @endif
                        <i class="fa fa-refresh"></i> {{(empty(request()->start_date) && empty(request()->end_date))?now()->format('h:i:A'):''}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-badge text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Clientes</p>
                                <p class="card-title">{{$customers['total']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <div class="row">
                            <span class="text-success col">Actives:{{$customers['actives']}}</span>
                            <span class="text-danger col">Inactives:{{$customers['inactives']}}</span>
                        </div>
                        @if(request()->start_date)
                        <span> desde:{{request()->start_date}}</span>
                        
                        @endif
                        @if(request()->end_date)
                        <span> hasta:{{request()->end_date}}</span>
                        
                        @endif

                        <i class="fa fa-calendar-o"></i> {{(empty(request()->start_date) && empty(request()->end_date))?now()->format('h:i:A'):''}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Filtros por fecha </h5>
                    <p class="card-category"></p>
                </div>
                <form action="{{route('dashboard.index')}}" method="get">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col">
                                <label for="">De:</label>
                                <input type="date" name="start_date" value="{{request()->start_date}}" class="form-control"
                                    aria-describedby="helpId">
                                @if ($errors->has('start_date'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col">
                                <label for="">hasta:</label>
                                <input type="date" name="end_date" value="{{request()->end_date}}" class="form-control"
                                    aria-describedby="helpId">
                                @if ($errors->has('end_date'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats text-center">
                            <button type="submit" name="" id="" class="btn btn-primary ">Filtrar</button>
                            <a href="{{route('dashboard.index')}}" class="btn btn-danger "><i class="nc-icon nc-simple-remove"
                                    aria-hidden="true"></i>Limpiar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Registro de clientes por mes</h5>
                    <p class="card-category">Clientes activos registrados</p>
                </div>
                <div class="card-body ">
                    <canvas id=chartHours width="400" height="100"></canvas>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats d-flex">
                        <i class="fa fa-history"></i> {{now()->format('h:i:A')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Emails y SMS </h5>
                    <p class="card-category">Relacion Emails y SMS</p>
                </div>
                <div class="card-body ">
                    <canvas id="chartEmail"></canvas>
                </div>
                <div class="card-footer ">
                    <div class="legend">
                        <i class="fa fa-circle text-primary"></i>SMS 
                        <i class="fa fa-circle text-warning"></i>Emails
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-calendar"></i> {{now()->format('h:i:A')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-email-85 text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Emails enviados</p>
                                <p class="card-title">{{$totalEmails}}
                                    <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-clock-o"></i> {{now()->format('h:i:A')}}
                    </div>
                </div>
            </div>
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-chat-33 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Sms enviados</p>
                                <p class="card-title">{{$totalSms}}
                                    <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-refresh"></i> Actualizado ahora {{now()->format('h:i:A')}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

