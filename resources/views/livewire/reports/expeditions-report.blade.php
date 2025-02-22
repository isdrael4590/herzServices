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
                                    <select wire:model="area_expedition" class="form-control" name="area_expedition">
                                        <option value="">Seleccione el Área</option>
                                        @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                            <option value="{{ $area->area_name }}">{{ $area->area_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select wire:model="status_expedition" class="form-control" name="status_expedition">
                                        <option value="">Selecione el estado</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Despachado">Despachado</option>
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
                            @forelse($expeditions as $expedition)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($expedition->updated_at)->format('d M, Y') }}</td>
                                    <td>{{ $expedition->reference }}</td>
                                    <td>{{ $expedition->area_expedition }}</td>
                                    <td>
                                        @if ($expedition->status_expedition == 'Pendiente')
                                            <span class="badge badge-info">
                                                {{ $expedition->status_expedition }}
                                            </span>
                                        @elseif ($expedition->status_expedition == 'Despachado')
                                            <span class="badge badge-primary">
                                                {{ $expedition->status_expedition }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $expedition->operator }}</td>
                                    <td>{{ $expedition->staff_expedition }}</td>
                           
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Datos no Disponible de Despacho</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div @class(['mt-3' => $expeditions->hasPages()])>
                        {{ $expeditions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
