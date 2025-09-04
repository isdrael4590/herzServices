@extends('layouts.app')

@section('title', 'Users')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Ubicaciones</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-1">
                            <i class="bi bi-geo-alt-fill text-primary"></i> Gestión de Ubicaciones
                        </h1>
                        <p class="text-muted mb-0">Administra las ubicaciones y su estructura jerárquica</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" onclick="location.reload()">
                            <i class="bi bi-arrow-repeat"></i> Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-left-primary h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Ubicaciones
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \Modules\ConfigurateBase\Entities\CompanySites::count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-geo-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-left-success h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Ubicaciones Activas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \Modules\ConfigurateBase\Entities\CompanySites::active()->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-left-info h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Ubicaciones Padre
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \Modules\ConfigurateBase\Entities\CompanySites::whereNull('parent_company_sites_id')->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-diagram-2 fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-left-warning h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Países Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \Modules\ConfigurateBase\Entities\CompanySites::distinct('country')->whereNotNull('country')->count('country') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-globe fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                            <!-- Button trigger modal -->
                            @can('create_company_sites')
                                <a href="{{ route('company_sites.create') }}" class="btn btn-primary mb-3">
                                    Añadir Ubicación <i class="bi bi-plus"></i>
                                </a>
                            @endcan

                        </div>
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        

                        
                        <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table table-striped table-hover', 'width' => '100%']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection


    @push('scripts')
        <!-- DataTables JS -->


        {!! $dataTable->scripts() !!}

        <script>
            // Personalizar mensajes de confirmación
            $(document).on('submit', 'form[onsubmit*="confirm"]', function(e) {
                if (!confirm('¿Está seguro de realizar esta acción?')) {
                    e.preventDefault();
                    return false;
                }
            });

            // Mostrar tooltips
            $(function() {
                $('[title]').tooltip();
            });

            // Actualizar tabla automáticamente cada 30 segundos (opcional)
            setInterval(function() {
                $('#company_sites-table').DataTable().ajax.reload(null, false);
            }, 30000);
        </script>
