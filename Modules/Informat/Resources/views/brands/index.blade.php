@extends('layouts.app')

@section('title', 'informat Categories')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('informats.index') }}">Información</a></li>
        <li class="breadcrumb-item active">Equipos de la Institución</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        @can('create')
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#BrandCreateModal">
                                Añadir Equipo <i class="bi bi-plus"></i>
                            </button>
                        @endcan
                        <hr>

                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    @include('informat::includes.brand-modal')
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
