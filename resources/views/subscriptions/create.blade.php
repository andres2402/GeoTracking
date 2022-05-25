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
                    <form action="{{route('subscriptions.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Nombre *</label>
                                <input type="text" name="name" id="input-name" value="{{old('name')}}" class="form-control formclass" placeholder="ej: PROMO40" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Descripción *</label>
                                <input type="text" name="description" value="{{old('description')}}" class="form-control formclass" placeholder="Descripción" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Precio</label>
                                <input type="text" min="50" step="1" name="precio" autocomplete="off" class="form-control formclass" onkeyup="return formatNumber(this, 'hdnPrice')" required>
                                <input type="hidden" id="hdnPrice" name="price" value="{{old('price')}}"> 
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Precio por Día</label>
                                <input type="text" min="50" step="1" name="precio" autocomplete="off" class="form-control formclass" onkeyup="return formatNumber(this, 'hdnPriceByDay')" required>
                                <input type="hidden" id="hdnPriceByDay" name="price_by_day" value="{{old('price_by_day')}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Descuento</label>
                                <input type="text" min="50" step="1" name="precio" autocomplete="off" class="form-control formclass" onkeyup="return formatNumber(this, 'hdnDiscount')" required>
                                <input type="hidden" id="hdnDiscount" name="discount_value" value="{{old('discount_value')}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-email">Imagen</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                    <div>
                                        <span class="btn btn-raised btn-round btnayud btn-file">
                                            <span class="fileinput-new">Seleccionar imagen</span>
                                            <input type="file" name="image_filename" />
                                        </span>
                                        <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                                            <i class="fa fa-times"></i> Quitar</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Activo</label>
                                <div class="form-group col-md-6 col-sm-12">
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="active" value="1" checked="">
                                            Sí
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="active" value="0">
                                            No
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4>Detalles del plan</h4>
                        <hr />

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Portafolios</label>
                                <input type="number" min="1" step="1" name="limit_shared_images" value="{{old('limit_shared_images')}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Promociones</label>
                                <input type="number" min="0" step="1" name="limit_monthly_promos" value="{{old('limit_monthly_promos')}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Edición de
                                    Perfil</label>
                                <input type="number" min="0" step="1" name="limit_profile_updates" value="{{old('limit_profile_updates')}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Servicios
                                    Ofrecidos</label>
                                <input type="number" min="0" step="1" name="limit_offered_services" value="{{old('limit_offered_services')}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">Cantidad de Servicios a
                                    Aceptar</label>
                                <input type="number" min="0" step="1" name="limit_accepted_services" value="{{old('limit_accepted_services')}}" class="form-control formclass" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-phone">¿Tiene Geolocalización?</label>
                                <div class="form-group col-md-3 col-sm-12">

                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="location" id="exampleRadios11" value="1" checked="">
                                            Sí
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="location" id="exampleRadios12" value="0">
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