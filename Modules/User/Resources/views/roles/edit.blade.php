@extends('layouts.app')

@section('title', 'Edit Role')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Edit</li>
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
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Actualización de Role <i class="bi bi-check"></i>
                    </button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nombre de Rol <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" required
                                value="{{ $role->name }}">
                        </div>

                        <hr>
                        <div class="form-group">
                            <label for="permissions">
                                Permisos <span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label class="custom-control-label" for="select-all">Dar todos los permisos</label>
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
                                                        {{ $role->hasPermissionTo('show_Dashboard') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="show_Dashboard">Todas las Gráficas</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- mENU Management Permission -->
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
                                                        {{ $role->hasPermissionTo('access_user_management') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="access_user_management">Acceso</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="edit_own_profile" name="permissions[]"
                                                        value="edit_own_profile"
                                                        {{ $role->hasPermissionTo('edit_own_profile') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="edit_own_profile">Perfil</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_user" name="permissions[]"
                                                        value="access_user"
                                                        {{ $role->hasPermissionTo('access_user') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="access_user">Acceso Usuario</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_reports" name="permissions[]"
                                                        value="access_reports"
                                                        {{ $role->hasPermissionTo('access_reports') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="access_reports">Acceso Reportes</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_roles" name="permissions[]"
                                                        value="access_roles"
                                                        {{ $role->hasPermissionTo('access_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_roles">
                                                        Acceso Roles</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_machines" name="permissions[]" value="access_machines"
                                                        {{ $role->hasPermissionTo('access_machines') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_machines">
                                                        Acceso Equipos</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="access_machine_categories" name="permissions[]" value="access_machine_categories"
                                                        {{ $role->hasPermissionTo('access_machine_categories') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="access_machine_categories">
                                                        Acceso Categorias</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="add_image" name="permissions[]" value="add_image"
                                                        {{ $role->hasPermissionTo('add_image') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="add_image">
                                                        Add Image</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="print_barcodes" name="permissions[]" value="print_barcodes"
                                                        {{ $role->hasPermissionTo('print_barcodes') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="print_barcodes">
                                                        Eliminar Roles</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Roles Management Permission -->
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
                                                        value="create"
                                                        {{ $role->hasPermissionTo('create') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="create">Crear Rol</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="edit_roles" name="permissions[]"
                                                        value="edit_roles"
                                                        {{ $role->hasPermissionTo('edit_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="edit_roles">Editar Rol</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="show_roles" name="permissions[]"
                                                        value="show_roles"
                                                        {{ $role->hasPermissionTo('show_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="show_roles">Mostrar Usuario</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="delete_roles" name="permissions[]"
                                                        value="delete_roles"
                                                        {{ $role->hasPermissionTo('delete_roles') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="delete_roles">Delete Rol</label>
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