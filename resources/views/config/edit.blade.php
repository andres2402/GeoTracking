@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content" id="app">
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
        <div class="row">
            <div class="col-md-12 text-center">
                <form class="col-md-12" action="{{ route('config.update',0) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('layouts.alerts')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('CMS Redes Sociales') }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($redes as $item)
                            <div class="row">
                                <input type="hidden" name="ids[]" value="{{$item->id}}">
                                <label class="col-md-3 col-form-label">{{$item->name}}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="url" name="descriptions[]" class="form-control" placeholder="www.redsocial.com/miperfil" value="{{ $item->description }}">
                                        @if ($errors->has('descriptions.'.$loop->index))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong class="text-left">{{ $errors->first('descriptions.'.$loop->index) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>                               
                            @endforeach
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Actualizar redes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('config.update',0) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('CMS Informacion Corporativa') }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($infoCorp as $item)
                            <div class="row">
                                <input type="hidden" name="ids[]" value="{{$item->id}}">
                                <label class="col-md-3 col-form-label">{{$item->name}}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="descriptions[]" class="form-control" placeholder="www.redsocial.com/miperfil" value="{{ $item->description }}">
                                        @if ($errors->has('descriptions.'.$loop->index))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong class="text-left">{{ $errors->first('descriptions.'.$loop->index) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>                               
                            @endforeach
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Actualizar') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection