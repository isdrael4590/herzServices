@extends('layouts.app')

@section('title', 'Edit informat Category')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('informats.index') }}">Información</a></li>
        <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Equipos </a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('brand.update', $brands->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label class="font-weight-bold" for="brand_code">Código Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="brand_code" required readonly
                                    value="{{ $brands->brand_code }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="brand_name">Nombre del Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="brand_name" required
                                    value="{{ $brands->brand_name }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="brand_model">Modelo Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="brand_model" required
                                    value="{{ $brands->brand_model }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="brand_type">Tipo de Equipo
                                        <select class="form-control" name="brand_type" id="brand_type" required>
                                            <option {{ $brands->brand_type == 'Autoclave' ? 'selected' : '' }}
                                                value="Autoclave">Autoclave</option>
                                            <option {{ $brands->brand_type == 'Peroxido' ? 'selected' : '' }}
                                                value="Peroxido">Esterilizador de Peroxido</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="brand_serial">Serie del Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="brand_serial" required
                                    value="{{ $brands->brand_serial }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="brand_factory">Marca del esterilizador <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="brand_factory" required
                                    value="{{ $brands->brand_factory }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="brand_country">País de fabricación <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="brand_country" required
                                    value="{{ $brands->brand_country }}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Actualizar <i
                                        class="bi bi-check"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
