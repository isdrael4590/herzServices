@extends('layouts.app')

@section('title', 'informat Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('informats.index') }}">Insumos</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row mb-3">
           
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Nombre del insumo</th>
                                    <td>{{ $informat->insumo_name }}</td>
                                </tr>
                                <tr>
                                    <th>Código del insumo</th>
                                    <td>{{ $informat->insumo_code }}</td>
                                </tr>
                                <tr>
                                    <th>Tipo de Insumo</th>
                                    <td>{{ $informat->insumo_type }}</td>
                                </tr>
                                <tr>
                                    <th>Temperatura de uso</th>
                                    <td>{{ $informat->insumo_temp }}</td>
                                </tr>
                                <tr>
                                    <th>Lote del insumo</th>
                                    <td>{{ $informat->insumo_lot }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Expiración</th>
                                    <td>{{ $informat->insumo_exp }}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{ $informat->insumo_quantity . ' ' . $informat->informat_unit }}</td>
                                </tr>
                                <tr>
                                    <th>Estado del Insumo</th>
                                    <td>
                                    {{ $informat->insumo_status }}
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Note</th>
                                    <td>{{ $informat->insumo_note ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        
        </div>
    </div>
@endsection



