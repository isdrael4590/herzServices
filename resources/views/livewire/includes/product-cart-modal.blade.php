<div class="d-inline-block">
    <!-- Button trigger Discount Modal -->
    <span wire:click="$dispatch('inputDyrtStateRefresh', { product_id: {{ $cart_item->id }}, row_id: '{{ $cart_item->rowId }}' })" role="button" class="badge badge-warning pointer-event" data-toggle="modal" data-target="#inputDyrtState{{ $cart_item->id }}">
        <i class="bi bi-pencil-square text-white"></i>
    </span>
    <!-- Discount Modal -->
    <div wire:ignore.self class="modal fade" id="inputDyrtState{{ $cart_item->id }}" tabindex="-1" role="dialog" aria-labelledby="inputDyrtStateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputDyrtStateLabel">
                        {{ $cart_item->name }}
                        <br>
                        <span class="badge badge-success">
                        {{ $cart_item->options->code }}
                    </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('message_inputDyrtState' . $cart_item->id))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <span>{{ session('message_inputDyrtState' . $cart_item->id) }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Nivel de Infección <span class="text-danger">*</span></label>
                        <select wire:model.live="type_dirt.{{ $cart_item->id }}" class="form-control" required>
                            <option  disabled>-- SELECCIONAR EL NIVEL DE INFECCION--</option>
                            <option value="NO CRITICO"> NO CRITICO</option>
                            <option value="SEMICRITICO"> SEMI-CRITICO</option>
                            <option selected value="CRITICO"> CRÍTICO</option>
                           {{--<option selected value="REPROCESADO"> REPROCESADO</option>--}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estado del Instrumental <span class="text-danger">*</span></label>
                        <select wire:model.live="state_rumed.{{ $cart_item->id }}" class="form-control" required>
                            <option value="BUENO">BUENO</option>
                            <option value="REGULAR">REGULAR</option>
                            <option value="MALO">MALO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Paciente (Solo Casa Comercial) <span class="text-danger">*</span></label>
                        <input wire:model="item_patient.{{ $cart_item->id }}" type="text" class="form-control" value="{{ $item_patient[$cart_item->id] }}">
                    </div>
                    <div class="form-group">
                        <label>Casa Comercial (Si Aplica) <span class="text-danger">*</span></label>
                        <input wire:model="item_outside_company.{{ $cart_item->id }}" type="text" class="form-control" value="{{ $item_outside_company[$cart_item->id] }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button wire:click="setProductoptions('{{ $cart_item->rowId }}', {{ $cart_item->id }})" type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
