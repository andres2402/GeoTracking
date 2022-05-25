@extends('layouts.app', [
'class' => '',
'elementActive' => 'cupones'
])

@section('content')

<div class="content" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="card-title titlefigurea2">Crear Slider</h5>
                    <div class="figuretitle3"></div>
                </div>
                <div class="card-body">
                    @include('layouts.alerts')
                    <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-control-label" for="input-name">Nombre *</label>
                                <input type="text" name="name" id="input-name" class="form-control formclass"
                                    placeholder="ej: PROMO40" required>
                            </div>

                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-phone">Activo</label>
                                <div class="form-group col-md-6 col-sm-12">
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="active" value="1"
                                                checked="">
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
                            <div class="form-group col-md-3 col-sm-12">
                                <label class="form-control-label" for="input-email">Tipo Slider</label>
                                <div class="form-group col-md-6 col-sm-12">
                                    @foreach($slider_types as $sliderType)
                                    <div class="form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="fk_slider_type_id" value="{{$sliderType->id}}" checked>
                                            {{$sliderType->name}}
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <div class="alert alert-warning text-dark" role="alert">
                                    Las dimensiones de las imágenes slider deben ser no menores a <strong>1440px x
                                        900px </strong>(para web) y <strong>900px x 1140px </strong>(para móvil)
                                </div>
                            </div>
                        </div>



                        <div class="d-flex">
                        <h4 class="titlefigurea4">Contenido</h4>
                        <div class="figuretitle5"></div>
                        </div>
                        <hr>

                        <div class="form-group col-md-12 col-sm-12">

                            <div class="needsclick dropzone formclass" id="document-dropzone">

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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
<script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>

<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: "{{ route('sliders.storeMedia') }}",
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        autoQueue: false,
        dictFileTooBig: 'El tamaño del archivo no debe ser mayor a 2MB',
        dictInvalidFileType: 'Formato de archivo no válido',
        dictRemoveFile: 'Quitar archivo',
        dictDefaultMessage: 'Arrasta archivos aquí para subir',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },

        success: function (file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
            console.info($('input[name="document[]"]').length);
            uploadedDocumentMap[file.name] = response.name;
        },
        removedfile: function (file) {
            file.previewElement.remove();
            var name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name;
            } else {
                name = uploadedDocumentMap[file.name];
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove();
            console.log($('input[name="document[]"]').length);
        },
        thumbnail: function (file) {
            if (file.width < 500 & file.height > 100) {
                this.options.removedfile.call(this, file)
                alert("Dimensiones de imágen no válidas");
            }
            else {
                // this.createThumbnailFromUrl(file, '/your-image.jpg');
                // $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                this.enqueueFile(file);
                this.processQueue();
            }
        }
    };

</script>
<script>
    $(document).ready(function () {

        $("form").submit(function (evt) {
            var filesCount = $('input[name="document[]"]').length;
            if (filesCount > 0) {
                return;
            }

            alert('Debe cargar mínimo una imágen.');
            evt.preventDefault();
        });
    });
</script>
@endsection