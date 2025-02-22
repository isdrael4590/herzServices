@extends('layouts.app')

@section('title', 'Editar Area')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('area.index') }}">Área</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('area.update', $area->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('utils.alerts')
                                    <div class="form-group">
                                        <button class="btn btn-primary">Actualizar Área <i class="bi bi-check"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="area_code">Área
                                                            Código <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="area_code" required
                                                            value="{{ $area->area_code }}
                                                    ">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="area_name">Nombre del área.
                                                            <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="area_name" required
                                                            value="{{ $area->area_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="area_responsable">Jefe de Area
                                                            <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="area_responsable"
                                                            value="{{ $area->area_responsable }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold" for="area_piso">Piso del área<span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="area_piso"
                                                            value="{{ $area->area_piso }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                      

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@push('page_scripts')
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        const fileElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(fileElement, {
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        });
        FilePond.setOptions({
            server: {
                url: "{{ route('filepond.upload') }}",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }
        });
    </script>
@endpush
