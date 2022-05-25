@extends('layouts.app', [
'class' => '',
'elementActive' => 'suscripciones'
])

@section('content')
<div class="content" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="card-title titlefigurea4">Crear Plan</h5>
                    <div class="figuretitle8"></div>
                </div>
                <div class="card-body">
                    @include('layouts.alerts')
                    <form action="{{route('subscriptions.update', $subscription)}}" method="POST" enctype="multipart/form-data">
                        @csrf  
                        @method('PATCH')                      
                        @include('layouts.alerts')
                        <input type="hidden" name="id" value="{{$subscription->id}}">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Nombre *</label>
                                <input type="text" name="name" id="input-name" value="{{$subscription->name}}"
                                    class="form-control formclass" placeholder="ej: PROMO40" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Descripción *</label>
                                <input type="text" name="description" value="{{$subscription->description}}"
                                    class="form-control formclass" placeholder="Descripción" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Precio</label>
                                <input type="text" name="precio" value="{{floatval($subscription->price)}}" onkeyup="return formatNumber(this, 'hdnPrice')"
                                    class="form-control formclass" required>
                                <input type="hidden" id="hdnPrice" name="price" value="{{$subscription->price}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Precio por Día</label>
                                <input type="text" name="precio" value="{{floatval($subscription->price_by_day)}}" autocomplete="off" class="form-control formclass" onkeyup="return formatNumber(this, 'hdnPriceByDay')" required>
                                <input type="hidden" id="hdnPriceByDay" name="price_by_day" value="{{$subscription->price_by_day}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Descuento</label>
                                <input type="text" name="precio" value="{{floatval($subscription->discount_value)}}" autocomplete="off" class="form-control formclass" onkeyup="return formatNumber(this, 'hdnDiscount')" required>
                                <input type="hidden" id="hdnDiscount" name="discount_value" value="{{$subscription->discount_value}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-email">Imagen</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <img src="{{ $subscription->image_filename }}" height="128" width="128" alt="" />
                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                    <div>
                                        <span class="btn btnayud btn-raised btn-round btn-default btn-file">
                                            <span class="fileinput-new">Seleccionar imagen</span>
                                            <!-- <span class="fileinput-exists">Change</span> -->
                                            <input type="file" name="image_filename" />
                                        </span>
                                        <a href="javascript:;" class="btn btnred fileinput-exists"
                                            data-dismiss="fileinput">
                                            <i class="fa fa-times"></i> Quitar</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Activo</label>
                                <div class="form-group col-md-6 col-sm-12">
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="active" value="1" {{$subscription->active==1 ? 'checked':''}}>
                                            Sí
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="active" value="0" {{$subscription->active==1 ?'':'checked'}}>
                                            No
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                       <div class="d-flex">
                        <h4 class="titlefigurea5">Detalles del plan</h4>
                        <div class="figuretitle2"></div>
                       </div>
                        <hr />

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Portafolios</label>
                                <input type="number" min="1" step="1" name="limit_shared_images"
                                    value="{{$subscription->limit_shared_images}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Promociones</label>
                                <input type="number" min="0" step="1" name="limit_monthly_promos"
                                    value="{{$subscription->limit_monthly_promos}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Edición de
                                    Perfil</label>
                                <input type="number" min="0" step="1" name="limit_profile_updates"
                                    value="{{$subscription->limit_profile_updates}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Servicios
                                    Ofrecidos</label>
                                <input type="number" min="0" step="1" name="limit_offered_services"
                                    value="{{$subscription->limit_offered_services}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Servicios a
                                    Aceptar</label>
                                <input type="number" min="0" step="1" name="limit_accepted_services"
                                    value="{{$subscription->limit_accepted_services}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">¿Tiene Geolocalización?</label>
                                <div class="form-group col-md-3 col-sm-12">

                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="location"
                                                id="exampleRadios11" value="1" {{$subscription->location==1 ? "checked" : ""}}
                                                >
                                            Sí
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="location"
                                                id="exampleRadios12" value="0" {{$subscription->location==1 ? "" : "checked"}}
                                               >
                                            No
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <button type="submit" class="btn btnayud">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
   function formatNumber(element, outValueInput) {
        numeral.locale('es');
        var number = numeral(element.value);
        var string = number.format();
        $(element).val(string);

        // set unformatted price to price's hidden field.
        $("#"+outValueInput).val(number.value());
    }
</script>