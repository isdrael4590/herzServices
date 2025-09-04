@extends('layouts.app')

@section('title', 'Edit User')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('company_sites.index') }}">Ubicaciones</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('company_sites.update', $location) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <!-- Dirección -->
                <div class="col-md-12 mb-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address', $location->address) }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Ciudad -->
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                        name="city" value="{{ old('city', $location->city) }}">
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- País -->
                <div class="col-md-6 mb-3">
                    <label for="country" class="form-label">País</label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                        name="country" value="{{ old('country', $location->country) }}">
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Ubicación Padre -->
                <div class="col-md-6 mb-3">
                    <label for="parent_company_sites_id" class="form-label">Ubicación Padre</label>
                    <select class="form-select @error('parent_company_sites_id') is-invalid @enderror" id="parent_company_sites_id"
                        name="parent_company_sites_id">
                        <option value="">Sin ubicación padre</option>
                        @foreach ($parentcompany_sites as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_company_sites_id', $location->parent_company_sites_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->full_name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Seleccione si esta ubicación depende de otra</div>
                    @error('parent_company_sites_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Estado <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                        required>
                        <option value="active" {{ old('status', $location->status) == 'active' ? 'selected' : '' }}>
                            Activo
                        </option>
                        <option value="inactive" {{ old('status', $location->status) == 'inactive' ? 'selected' : '' }}>
                            Inactivo
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Información adicional si tiene ubicaciones hijas -->
            @if ($location->childcompany_sites->count() > 0)
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    <strong>Nota:</strong> Esta ubicación tiene {{ $location->childcompany_sites->count() }}
                    ubicación(es) dependiente(s). Ten cuidado al cambiar la ubicación padre.
                </div>
            @endif

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('company_sites.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Actualizar Ubicación
                </button>
            </div>
        </form>
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@push('page_scripts')

@endpush
