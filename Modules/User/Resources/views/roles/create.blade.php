@extends('layouts.app')

@section('title', 'Create Role')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Crear</li>
</ol>
@endsection

@push('page_css')
<style>
    .custom-control-label {
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('utils.alerts')
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Crear Role <i class="bi bi-check"></i>
                    </button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nombre del Rol <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" required>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="permissions">Permisos <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label class="custom-control-label" for="select-all">Dar todos los Permisos</label>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Dashboard Permissions -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card h-100 border-0 shadow">
                                    <div class="card-header">
                                        Panel Principal
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="show_Dashboard" name="permissions[]"
                                                        value="show_Dashboard"
                                                        {{ old('show_Dashboard') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="show_Dashboard">Dashboard</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Menu Management Permission -->

                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card h-100 border-0 shadow">
                                    <div class="card-header">
                                        Control de Menu
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_user_management" name="permissions[]"
                                                        value="access_user_management"
                                                        {{ old('access_user_management') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="access_user_management">Acceso Control Users</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="edit_own_profile" name="permissions[]"
                                                        value="edit_own_profile"
                                                        {{ old('edit_own_profile') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="edit_own_profile">
                                                        Perfil</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_user" name="permissions[]" value="access_user"
                                                        {{ old('access_user') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_user">
                                                        Acceso Usuario</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_reports" name="permissions[]" value="access_reports"
                                                        {{ old('access_reports') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_reports">
                                                        Acceso Reportes</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_roles" name="permissions[]" value="access_roles"
                                                        {{ old('access_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_roles">
                                                        Acceso Roles</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_machines" name="permissions[]" value="access_machines"
                                                        {{ old('access_machines') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_machines">
                                                        Acceso Equipos</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_machine_categories" name="permissions[]" value="access_machine_categories"
                                                        {{ old('access_machine_categories') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_machine_categories">
                                                        Acceso Categoria</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="v" name="permissions[]" value="add_image"
                                                        {{ old('add_image') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="add_image">
                                                        Acceso Add Image</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="print_barcodes" name="permissions[]" value="print_barcodes"
                                                        {{ old('print_barcodes') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="print_barcodes">
                                                        Acceso Generar Barcode</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_informats" name="permissions[]" value="access_informats"
                                                        {{ old('access_informats') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_informats">
                                                        Acceso Institucion</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Management Permission -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card h-100 border-0 shadow">
                                    <div class="card-header">
                                        Control de Actividades
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="create" name="permissions[]"
                                                        value="create"
                                                        {{ old('create') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="create">Crear </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="edit" name="permissions[]"
                                                        value="edit"
                                                        {{ old('edit') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="edit">Editar </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="show" name="permissions[]"
                                                        value="show"
                                                        {{ old(key: 'show') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="show">Mostrar </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="delete" name="permissions[]"
                                                        value="delete"
                                                        {{ old('delete') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="delete">Eliminar </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="print" name="permissions[]"
                                                        value="print"
                                                        {{ old('print') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="print">
                                                        Imprimir</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                             <!-- Roles Permission -->
                             <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card h-100 border-0 shadow">
                                    <div class="card-header">
                                        Control de Roles
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="create" name="permissions[]"
                                                        value="create_roles"
                                                        {{ old('create_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="create_roles">Crear Rol </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="edit_roles" name="permissions[]"
                                                        value="edit_roles"
                                                        {{ old('edit_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="edit_roles">Editar Roles </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="show_roles" name="permissions[]"
                                                        value="show_roles"
                                                        {{ old(key: 'show_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="show_roles">Mostrar </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="delete_roles" name="permissions[]"
                                                        value="delete_roles"
                                                        {{ old('delete_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="delete_roles">Eliminar </label>
                                                </div>
                                            </div>
                                           

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

@endsection

@push('page_scripts')
<script>
    $(document).ready(function() {
        $('#select-all').click(function() {
            var checked = this.checked;
            $('input[type="checkbox"]').each(function() {
                this.checked = checked;
            });
        })
    });
</script>
@endpush