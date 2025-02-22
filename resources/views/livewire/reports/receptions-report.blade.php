<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Fecha Inicio <span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Fecha Fin <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Área</label>
                                    <select wire:model="area_id" class="form-control" name="area_id">
                                        <option value="">Seleccione el área</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select wire:model="status_reception" class="form-control" name="status_reception">
                                        <option value="">Selecione la Validación</option>
                                        <option value="Registrado">Registrado</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Procesado">Procesado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                Filtrar Reporte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center mb-0">
                        <div wire:loading.flex
                            class="col-12 position-absolute justify-content-center align-items-center"
                            style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Referencia</th>
                                <th>Área</th>
                                <th>Estado</th>
                                <th>Persona Entrega</th>
                                <th>Persona que recibe</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($receptions as $reception)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($reception->updated_at)->format('d M, Y') }}</td>
                                    <td>{{ $reception->reference }}</td>
                                    <td>{{ $reception->area }}</td>
                                    <td>
                                        @if ($reception->status == 'Pendiente')
                                            <span class="badge badge-info">
                                                {{ $reception->status }}
                                            </span>
                                        @elseif ($reception->status == 'Registrado')
                                            <span class="badge badge-primary">
                                                {{ $reception->status }}
                                            </span>
                                        @elseif ($reception->status == 'Procesado')
                                            <span class="badge badge-primary">
                                                {{ $reception->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $reception->delivery_staff }}</td>
                                    <td>{{ $reception->operator }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Datos no Disponible de Registro</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div @class(['mt-3' => $receptions->hasPages()])>
                        {{ $receptions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
