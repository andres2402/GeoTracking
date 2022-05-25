@extends('layouts.app', [
'class' => '',
'elementActive' => 'cupones'
])
@section('content')
<style>
    .slider-image {
        width: 20%;
        height: 10%;
        max-width: 425px;
        margin-left: auto;
        margin-right: auto;
        display: block;        
    }
</style>
<div class="content" id="app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ver Slider: {{$data['slider']->name}} </h5>
                </div>
                <div class="card-body">
                    @include('layouts.alerts')

                    @csrf
                    <input type="hidden" name="id" value="{{$data['slider']->id}}">
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label class="form-control-label" for="input-name">Nombre</label>
                            <input disabled type="text" name="name" id="input-name" value="{{$data['slider']->name}}" class="form-control formclass" placeholder="ej: PROMO40" required>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="form-control-label" for="input-name">Tipo Slider</label>
                            <input disabled type="text" name="name" id="input-name" value="{{$data['slider']->slider_type}}" class="form-control formclass" placeholder="ej: PROMO40" required>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="form-control-label" for="input-phone">Activo</label>
                            <div class="form-group col-md-6 col-sm-12">
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                        <input disabled class="form-check-input" type="radio" name="active" value="1" {{ $data['slider']->active==
                                        1 ?
                                        'checked': '' }}>
                                        Sí
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                        <input disabled class="form-check-input" type="radio" name="active" value="0" {{ $data['slider']->active==
                                        1 ? '':
                                        'checked' }}>
                                        No
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4>Contenido</h4>
                    <hr>
                    <div class="row">
                        @foreach($data['media'] as $item)
                        <img class="slider-image" src="{{$item->path}}" />
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>


<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: "{{ route('sliders.storeMedia') }}",
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        clickable: false,
        dictFileTooBig: 'El tamaño del archivo no debe ser mayor a 2MB',
        dictInvalidFileType: 'Formato de archivo no válido',
        dictRemoveFile: 'Quitar archivo',
        dictDefaultMessage: 'Arrasta archivos aquí para subir',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        thumbnail: function (file, done) {
            if (file.width < 500 & file.height > 100) {
                this.options.removedfile.call(this, file)
                alert("Dimensiones de imágen no válidas");
            }
            else {
                this.enqueueFile(file);
                this.processQueue();
                done();
            }
        },
        init: function () {
            this.disable();

            @if (isset($data['media']))
                var files = @json($data['media']);
            for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }



</script>





@endsection