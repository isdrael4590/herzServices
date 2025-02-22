<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reporte Descarga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/printer/css/bootstrap.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/printer/css/style.css') }}">
    <style>
        /* default for all pages */
        @page {
            size: A4 portrait;
        }

        p {
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <div class="printer-16 printer-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="printer-inner-9" id="printer_wrapper">
                        <div class="printer-top">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4">
                                    <div class="logo">
                                        <img src="{{ $institute->getFirstMediaUrl('institutes') }}"
                                            alt="Institute Image" class="img-fluid  mb-1">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="printer">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="printer">
                                        <div>Versión: <strong> 01</strong></div>
                                        <div>Vigente: <strong> Septiembre 2024</strong></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="printer-info">
                            <div class="row">

                                <div class="printer-number">
                                    <h6 class="print-title-2">Reporte Físico del proceso de esterilización:</h6>
                                    <p class="printo-addr"> Fecha:
                                        {{ \Carbon\Carbon::parse($discharge->updated_at)->format('d M, Y') }}
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="printer-info">
                            <div class="row mb-4">
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h4 class="print-title-1 border-bottom">Institución:</h4>
                                    <div>{{ Institutes()->institute_name }}</div>
                                    <div>Dirección: {{ Institutes()->institute_address }}</div>
                                    <div>Área: {{ Institutes()->institute_area }}</div>
                                    <div>Ciudad: {{ Institutes()->institute_city }}</div>
                                    <div>País: {{ Institutes()->institute_country }}</div>
                                </div>
                                
                               
                             
                            </div>
                        </div>

                        <div class="product-summary">
                            <div>
                                <table class="default-table printer-table">
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
                            </div>

                            <br>

                            <table class="default-table ">
                                <tr>
                                    <br><br><br>
                                    <td>Responsable: <span> {{ $discharge->operator }}</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="printer-informeshon-footer">
                            <ul>
                                <li><strong>Nota:</strong> Asegurarse que el producto entregado sea el correcto.</li>
                            </ul>
                            <ul>
                                <li>

                                    <img src="{{ $dataUrlogo }}" alt="Institute Image" class="img-fluid mb-2"
                                        width="80px">
                                    <br>
                                    {{ Settings()->company_name }} -
                                    {{ Settings()->company_email }} -
                                    {{ Settings()->company_phone }}
    
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
            <div class="printer-btn-section clearfix d-print-none">
                <a href="javascript:window.print()" class="btn btn-lg btn-print">
                    Imprimir
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>

</body>

</html>
