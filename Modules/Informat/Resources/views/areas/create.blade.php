@php
    $Area_max_id = \Modules\Informat\Entities\Area::max('id') + 1;
    $area_code = "Area_" . str_pad($Area_max_id, 2, '0', STR_PAD_LEFT)
@endphp
@extends('layouts.app')

@section('title', 'Crear Area')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('area.index') }}">Información</a></li>
        <li class="breadcrumb-item active">Información de Areas</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('area.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Crear áreas <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="area_code">Area Código <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="area_code" required value="{{ $area_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="area_name">Nombre del Área <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="area_name" required >
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="area_responsable">Jefe de Area <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="area_responsable" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="area_piso">Piso del área<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="area_piso" required >
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection





