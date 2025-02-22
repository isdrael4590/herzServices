@php
    $Brand_max_id = \Modules\Informat\Entities\Brand::max('id') + 1;
    $brand_code = 'Eq_' . str_pad($Brand_max_id, 2, '0', STR_PAD_LEFT);
@endphp
<div class="modal fade" id="BrandCreateModal" tabindex="-1" role="dialog" aria-labelledby="BrandCreateModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brandCreateModalLabel">Crear Marca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('brand.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="brand_code">Código Marca <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="brand_code" required
                            value="{{ $brand_code }}">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="brand_name">Nombre del Marca <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="brand_name" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="brand_model">Modelo Marca <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="brand_model" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="brand_type">Tipo de Marca <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-control" name="brand_type" id="brand_type" required>
                                <option value="" selected disabled>Selección Tipo de Marca
                                </option>
                                <option value="Autoclave">Autoclave</option>
                                <option value="Peroxido">Peroxido</option>
                            </select>
                        </div>
                    </div>
                   

                    <div class="form-group">
                        <label class="font-weight-bold" for="brand_serial">Serie del Marca <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="brand_serial" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="brand_factory">Marca del esterilizador <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="brand_factory" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="brand_country">País de fabricación <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="brand_country" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear <i class="bi bi-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
