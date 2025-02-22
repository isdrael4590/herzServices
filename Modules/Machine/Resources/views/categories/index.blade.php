@extends('layouts.app')

@section('title', 'machine Categories')

@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('machines.index') }}">Equipos</a></li>
        <li class="breadcrumb-item active">Categoria/Especialidad</li>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryCreateModal">
                            Añadir Especialidad <i class="bi bi-plus"></i>
                        </button>
                 
                        <a href="{{ route('import-categories.create') }}" class="btn btn-warning">
                           Importar Especialidad<i class="bi bi-save"></i>
                        </a>
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
    @include('machine::includes.category-modal')
@endsection

@push('page_scripts')
    {!! $dataTable->scripts() !!}
@endpush
