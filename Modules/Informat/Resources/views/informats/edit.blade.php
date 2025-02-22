@extends('layouts.app')

@section('title', 'Edit informat')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('informats.index') }}">Insumos</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form id="informat-form" action="{{ route('informats.update', $informat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Actualizar insumo <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insumo_name">Nombre del Insumo<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="insumo_name" required
                                            value="{{ $informat->insumo_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insumo_code">Código del insumo<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="insumo_code" required
                                            value="{{ $informat->insumo_code }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="insumo_type">Tipo de Insumo<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="insumo_type" id="insumo_type" required>
                                            <option value=""  disabled>Selección de Tipo de Insumo</option>
                                            <option {{ $informat->insumo_type == 'INDICADORES QUIMICOS' ? 'selected' : '' }} value="INDICADORES QUIMICOS">INDICADORES QUÍMICOS</option>
                                            <option {{ $informat->insumo_type == 'INDICADORES BIOLOGICOS' ? 'selected' : '' }} value="INDICADORES BIOLOGICOS">INDICADORES BIOLÓGICOS</option>
                                            <option {{ $informat->insumo_type == 'ROLLOS TYVEK' ? 'selected' : '' }} value="ROLLOS TYVEK">ROLLOS TYVEK</option>
                                            <option {{ $informat->insumo_type == 'ROLLOS MIXTOS' ? 'selected' : '' }} value="ROLLOS MIXTOS">ROLLOS MIXTOS</option>
                                            <option {{ $informat->insumo_type == 'AGENTE ESTERILIZANTE' ? 'selected' : '' }} value="AGENTE ESTERILIZANTE">AGENTE ESTERILIZANTE</option> 
                                            <option {{ $informat->insumo_type == 'TEST BOWIE & DICK' ? 'selected' : '' }} value="TEST BOWIE & DICK">TEST BOWIE & DICK</option>
                                        </select>
                                     
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="insumo_temp">Temperatura de uso<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="insumo_temp" id="insumo_temp" required>
                                            <option value=""  disabled>Selección la temperatura de uso
                                            </option>
                                            <option {{ $informat->insumo_type == 'ALTA TEMPERATURA' ? 'selected' : '' }} value="ALTA TEMPERATURA">ALTA TEMPERATURA</option>
                                            <option {{ $informat->insumo_type == 'BAJA TEMPERATURA' ? 'selected' : '' }} value="BAJA TEMPERATURA">BAJA TEMPERATURA</option>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insumo_lot">Lote del insumo<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="insumo_lot" required
                                            value="{{ $informat->insumo_lot }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insumo_exp">Fecha de Expiración<span
                                                class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="insumo_exp" required value="{{ $informat->getAttributes()['insumo_exp'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="insumo_quantity">Cantidad<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="insumo_quantity" required
                                            value="{{ $informat->insumo_quantity }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="insumo_unit">Presentación<i
                                                class="bi bi-question-circle-fill text-info" data-toggle="tooltip"
                                                data-placement="top" title="This short text will be placed after."></i>
                                            <span class="text-danger">*</span></label>
                                        <select class="form-control" name="insumo_unit" id="insumo_unit" required>
                                            <option value="" selected>Selección Presentación</option>
                                            @foreach (\Modules\Informat\Entities\Unit::all() as $unit)
                                                <option {{ $informat->insumo_unit == $unit->short_name ? 'selected' : '' }}value="{{ $unit->name }}" >
                                                    {{ $unit->name . ' | ' . $unit->short_name }}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="insumo_status">Estado del Insumo<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="insumo_status" id="insumo_status" required>
                                            <option value="" selected disabled>Selección Estado del Insumo
                                            </option>
                                            <option {{ $informat->insumo_status == 'Activo' ? 'selected' : '' }} value="Activo">Activo</option>
                                            <option {{ $informat->insumo_status == 'Desactivado' ? 'selected' : '' }} value="Desactivado">Desactivado</option>
                                        </select>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="insumo_note">Nota / Observaciones</label>
                                <textarea name="insumo_note" id="insumo_note" rows="4 " class="form-control"  value="{{ $informat->insumo_note }}"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')


    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>

@endpush

