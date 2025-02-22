@extends('layouts.app')

@section('title', 'machine Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('machines.index') }}">Base Datos Equipos</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row mb-3">
            <div class="col-md-12">
                {!! \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG(
                    $machine->IDActivo,
                    $machine->machine_barcode_symbology,
                    2,
                    110,
                ) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <label for="">
                            <h2>PAQUETES DE INSTRUMENTAL</h2>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Código del machineo</th>
                                    <td>{{ $machine->IDActivo }}</td>
                                </tr>
                                <tr>
                                    <th>Barcode simbología</th>
                                    <td>{{ $machine->machine_barcode_symbology }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ $machine->DescActivo }}</td>
                                </tr>
                                <tr>
                                    <th>Categoria</th>
                                    <td>{{ $machine->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Marca</th>
                                    <td>{{ $machine->DescMarca }}</td>
                                </tr>
                                <tr>
                                    <th>MOdelo</th>
                                    <td>{{ $machine->DescModelo }}</td>
                                </tr>
                                
                                <tr>
                                    <th>Hospital</th>
                                    <td>{{ $machine->DescCliente ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th>Note</th>
                                    <td>{{ $machine->machine_note ?? 'N/A' }}</td>
                                </tr>
                            </table>
                            <br>
                        </div>
                      
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        @forelse($machine->getMedia('images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="machine Image" class="img-fluid img-thumbnail mb-2">
                        @empty
                            <img src="{{ $machine->getFirstMediaUrl('images') }}" alt="machine Image"
                                class="img-fluid img-thumbnail mb-2">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
