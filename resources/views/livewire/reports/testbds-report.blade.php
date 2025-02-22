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
                                    <select wire:model="machine_id" class="form-control" name="machine_id">
                                        <option value="">Seleccione el Equipo</option>
                                        @foreach ($machines as $machine)
                                            <option value="{{ $machine->id }}">{{ $machine->machine_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Validación Test Bowie & Dick</label>
                                    <select wire:model="testbd_validation" class="form-control" name="testbd_validation">
                                        <option value="">Selecione la Validación</option>
                                        <option value="Correcto">Correcto</option>
                                        <option value="Falla">Falla</option>
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
                                <th>Validación</th>
                                <th>Lote BD</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testbds as $testbd)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($testbd->updated_at)->format('d M, Y') }}</td>
                                    <td>{{ $testbd->testbd_reference }}</td>
                                    <td>{{ $testbd->machine_name }}</td>
                                    <td>
                                        @if ($testbd->validation_bd == 'Falla')
                                            <span class="badge badge-info">
                                                {{ $testbd->validation_bd }}
                                            </span>
                                        @elseif ($testbd->validation_bd == 'Correcto')
                                            <span class="badge badge-primary">
                                                {{ $testbd->validation_bd }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $testbd->lote_machine }}</td>
                                    <td>{{ $testbd->lote_bd }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Datos no  Disponible de Test Bowie & Dick</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div @class(['mt-3' => $testbds->hasPages()])>
                        {{ $testbds->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
