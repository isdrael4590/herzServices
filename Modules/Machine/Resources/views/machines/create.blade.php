@extends('layouts.app')

@section('title', 'Create machine')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('machines.index') }}">Base Datos Equipos</a></li>
    <li class="breadcrumb-item active">Añadir</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <form id="machine-form" action="{{ route('machines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                @include('utils.alerts')
                <div class="form-group">
                    <button class="btn btn-primary">Crear Equipo <i class="bi bi-check"></i></button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DescActivo">Nombre del Equipo <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="DescActivo" required
                                        value="{{ old('DescActivo') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDActivo">Código/Serie <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="IDActivo" required
                                        value="{{ old('IDActivo') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="category_id">Categoría / Especialidad <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-control" name="category_id" id="category_id" required>
                                        <option value="" selected disabled>Select Categoria</option>
                                        @foreach (\Modules\Machine\Entities\Category::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append d-flex">
                                        <button data-toggle="modal" data-target="#categoryCreateModal"
                                            class="btn btn-outline-primary" type="button">
                                            Añadir
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="machine_barcode_symbology">Simbología BARCODE <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="machine_barcode_symbology" id="barcode_symbology"
                                        required>
                                        <option value="" disabled>Selección Simbología</option>
                                        <option selected value="C128">Code 128</option>
                                        <option value="C39">Code 39</option>
                                        <option value="UPCA">UPC-A</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DescMarca">Marca <span class="text-danger">*</span></label>
                                    <select class="form-control" id="DescMarca" name="DescMarca" required>
                                        @foreach (\Modules\Informat\Entities\Area::all() as $marca)
                                        <option value="{{ $marca->DescMarca }}">
                                            {{ $marca->DescMarca }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DescModelo"> Modelo:<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="DescModelo" id="DescModelo"
                                        required>
                                        <option value="" disabled>Seleccion de Temp. Trabajo</option>
                                        <option selected value="Alta Temperatura">Alta Temperatura</option>
                                        <option value="Baja Temperatura">Baja Temperatura</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DescCliente">Hospital:<span
                                            class="text-danger">*</span></label>
                                            <select class="form-control" id="DescCliente" name="DescCliente" required>
                                        @foreach (\Modules\Informat\Entities\Institute::all() as $institue)
                                        <option value="{{ $institue->DescCliente }}">
                                            {{ $institue->DescCliente }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="machine_note">Nota / Observaciones</label>
                            <textarea name="machine_note" id="machine_note" rows="4 " class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            @can('add_image')
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image">Imagen del Paquete <i class="bi bi-question-circle-fill text-info"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i></label>
                            <div class="dropzone d-flex flex-wrap align-items-center justify-content-center"
                                id="document-dropzone">
                                <div class="dz-message" data-dz-message>
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </form>
</div>

<!-- Create Category Modal -->
@include('machine::includes.category-modal')
@endsection

@section('third_party_scripts')
<script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
            url: "{{ route('dropzone.upload') }}",
            maxFilesize: 1,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFiles: 3,
            addRemoveLinks: true,
            dictRemoveFile: "<i class='bi bi-x-circle text-danger'></i> remove",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function(file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('dropzone.delete') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'file_name': `${name}`
                    },
                });
                $('form').find('input[name="document[]"][value="' + name + '"]').remove();
            },
            init: function() {
                @if(isset($machine) && $machine->getMedia('images'))
                    var files = {!!json_encode($machine->getMedia('images')) !!};
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        this.options.thumbnail.call(this, file, file.original_url);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">');
                    }
                @endif
            };



            $(document).on('click', '.remove-table-row', function() {
                $(this).parents('tr').remove()
            });
        }
</script>
<script src="{{ asset('js/jquery-mask-money.js') }}"></script>
@endpush