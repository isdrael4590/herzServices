@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Home</li>
    </ol>
@endsection

@section('content')


    <?php
    $hour = date('G');
    $minute = date('i');
    $second = date('s');
    $msg = ' Today is ' . date('l, M. d, Y.');
    
    if ($hour == 00 && $hour <= 9 && $minute <= 59 && $second <= 59) {
        $greet = 'Buenos dias,';
    } elseif ($hour >= 10 && $hour <= 11 && $minute <= 59 && $second <= 59) {
        $greet = 'Buen dia,';
    } elseif ($hour >= 12 && $hour <= 15 && $minute <= 59 && $second <= 59) {
        $greet = 'Buenas Tardes,';
    } elseif ($hour >= 16 && $hour <= 23 && $minute <= 59 && $second <= 59) {
        $greet = 'Buenas noches,';
    } else {
        $greet = 'Bienvenido,';
    }
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">{{ $greet }} <strong>{{ Auth::user()->name }}!</strong></h4>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Panel Principal</li>
                </ul>
            </div>
        </div>


        @can('show_total_stats')
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @can('access_dirty_area')
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <i class="bi bi-caret-down-square font-4xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small">Módulo Recepción</div>
                                            @can('access_receptions')
                                                <div class="text-value text-primary"><a href="">Todos
                                                        los ingresos</a>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('access_zne_area')
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <h1>PRE</h1>
                                        </div>
                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small"> MÓDULO PREPARACIÓN</div>
                                            @can('access_preparations')
                                                <div class="text-value text-primary"><a
                                                        href="">Stock
                                                    </a>
                                                </div>
                                            @endcan
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <h1>PRO</h1>
                                        </div>

                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small"> MÓDULO CARGA
                                            </div>
                                            @can('access_labelqrs')
                                                <div class="text-value text-primary"><a href="">Generar
                                                        Ciclo</a>
                                                </div>
                                            @endcan

                                            @can('create_discharges')
                                                <div class="text-muted text-uppercase font-weight-bold small">MÓDULO DE DESCARGA
                                                </div>
                                                <div class="text-value text-primary"><a href="">Liberar
                                                        Ciclo</a>
                                                </div>
                                            @endcan

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('access_esteril_area')
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <h1>DES</h1>
                                        </div>

                                        <div>

                                            @can('access_almacen_area')
                                                <div>
                                                    <div class="text-muted text-uppercase font-weight-bold small">MÓDULO
                                                        ALMACÉN.
                                                    </div>
                                                    @can('access_stocks')
                                                        <div class="text-value text-primary"><a
                                                                href="">Stock
                                                                Esteril</a>
                                                        </div>
                                                    @endcan
                                                    @can('access_expedition')
                                                        <div class="text-muted text-uppercase font-weight-bold small">
                                                            DESPACHO.
                                                        </div>
                                                        <div class="text-value text-primary"><a href="">Ver
                                                                Despachos</a>
                                                        </div>
                                                    @endcan

                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
        @endcan
        



        <div class="row mb-4">
            @can('show_result_biologic')
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header">
                            Resultado de liberación del Biologicos.
                        </div>
                        <div class="card-body">
                            <canvas id="BiologicChart"></canvas>
                        </div>
                    </div>
                </div>
            @endcan
            @can('show_production_areas')
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header">
                            Rendimiento Areas Central.
                        </div>
                        <div class="card-body">
                            <canvas id="CentralChart"></canvas>
                        </div>
                    </div>
                </div>
            @endcan

        </div>


    </div>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
        integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
    @vite('resources/js/chart-config.js')
@endpush
