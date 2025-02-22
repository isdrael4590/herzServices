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
                                    <label>Equipo</label>
                                    <select wire:model="machine_name" class="form-control" name="machine_name">
                                        <option value="">Seleccione el Equipo</option>
                                        @foreach (\Modules\Informat\Entities\Machine::all() as $machine)
                                            <option value="{{ $machine->machine_name }}">{{ $machine->machine_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Validación Biologico</label>
                                    <select wire:model="validation_biologic" class="form-control"
                                        name="validation_biologic">
                                        <option value="">Selecione la Validación</option>
                                        <option value="Correcto">Correcto</option>
                                        <option value="Falla">Falla</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Validación Proceso</label>
                                    <select wire:model="status_cycle" class="form-control" name="status_cycle">
                                        <option value="">Selecione el Estado de Proceso</option>
                                        <option value="Ciclo Aprobado ">Ciclo Aprobado</option>
                                        <option value="Ciclo Falla">Ciclo Falla</option>
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
                                <th>Equipo</th>
                                <th>Lote Equipo</th>
                                <th>Validación Proceso</th>
                                <th>Validación Biológico</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($discharges as $discharge)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($discharge->updated_at)->format('d M, Y') }}</td>
                                    <td>{{ $discharge->reference }}</td>
                                    <td>{{ $discharge->machine_name }}</td>
                                    <td>{{ $discharge->lote_machine }}</td>
                                    <td>
                                        @if ($discharge->status_cycle == 'Ciclo Falla')
                                            <span class="badge badge-info">
                                                {{ $discharge->status_cycle }}
                                            </span>
                                        @elseif ($discharge->status_cycle == 'Ciclo Aprobado')
                                            <span class="badge badge-primary">
                                                {{ $discharge->status_cycle }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($discharge->validation_biologic == 'Falla')
                                            <span class="badge badge-info">
                                                {{ $discharge->validation_biologic }}
                                            </span>
                                        @elseif ($discharge->validation_biologic == 'Correcto')
                                            <span class="badge badge-primary">
                                                {{ $discharge->validation_biologic }}
                                            </span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Datos no Disponibles Descarga</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div @class(['mt-3' => $discharges->hasPages()])>
                        {{ $discharges->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
