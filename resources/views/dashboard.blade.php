@extends('adminlte::page')

@section('title', 'Monitoreo | Dashboard')

@php
    use Carbon\Carbon;
@endphp

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_vuelos }}</h3>
                    <p>Vuelos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-plane"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $total_pasajeros }}</h3>
                    <p>Pasajeros</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_lbs }}<sup style="font-size: 20px">Lbs</sup></h3>
                    <p>Peso</p>
                </div>
                <div class="icon">
                    <i class="fas fa-weight"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $total_gaseos }}<sup style="font-size: 20px">Lbs</sup></h3>
                    <p>Gaseos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-gas-pump"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {{-- TABLA DE ULTIMOS MOVIMIENTOS --}}
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Últimos Movimientos - <i>HOY
                            {{ Carbon::now()->locale('es')->isoFormat('LL') }}</i></h3>
                    <div class="card-tools">
                        <a href="{{ route('air_traffic.index') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-center">No. Vuelo</th>
                                <th class="text-center">Ruta</th>
                                <th class="text-center">Salida</th>
                                <th class="text-center">Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($latest_flights->count() > 0)
                                @foreach ($latest_flights as $flight)
                                    <tr>
                                        <td class="text-center">{{ $flight->flight->code }}</td>
                                        <td class="text-center">{{ $flight->flight_route }}</td>
                                        <td class="text-center">{{ Carbon::parse($flight->departure)->format('H:i') }}</td>
                                        <td class="text-center">
                                            @if (isset($flight_status_array[$flight->flight_status]))
                                                <span class="badge {{ $flight_status_classes[$flight->flight_status] }}">
                                                    {{ $flight_status_array[$flight->flight_status] }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Estado desconocido</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @for ($i = $latest_flights->count(); $i < 5; $i++)
                                    <tr>
                                        <td></td>
                                        <td colspan="3"></td>
                                    </tr>
                                @endfor
                            @else
                                @for ($i = 0; $i < 5; $i++)
                                    <tr>
                                        <td></td>
                                        <td colspan="3">No hay movimientos registrados hoy.</td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- REMANENTES DE AERONAVES --}}
            <div class="card card-danger">
                <div class="card-header">
                    <h5 class="card-title">Vuelos por Ruta - <i>MES DE <span
                                style="text-transform: uppercase;">{{ \Carbon\Carbon::now()->locale('es')->translatedFormat('F') }}</span></i>
                    </h5>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="flightsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Gaseos por Aeronave - <i>MES DE <span
                                style="text-transform: uppercase;">{{ \Carbon\Carbon::now()->locale('es')->translatedFormat('F') }}</span></i>
                    </h5>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="fuelingsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Último Remanente por Aeronave</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <th class="text-center">Matrícula</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Remanente (LBS)</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($aircrafts as $aircraft)
                                @if (!empty($aircraft->residual_fuel))
                                    <tr>
                                        <td class="text-center">{{ $aircraft->registration }}</td>
                                        <td class="text-center">{{ $aircraft->types->type }}</td>
                                        <td class="text-center"><span
                                                class="badge badge bg-warning">{{ $aircraft->residual_fuel->residual_fuel_amount }}</span>
                                        </td>
                                        <td class="text-center"><a href="{{ route('aircrafts.index') }}"><i
                                                    class="fas fa-search"></i></a></td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet"> --}}
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- GENERAR GRAFICO DE VUELOS POR RUTAS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route('charts.flights') }}')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('flightsChart').getContext('2d');

                    // Colores de AdminLTE
                    const adminLteColors = [
                        'rgba(255, 0, 0, 0.5)', // Red
                        'rgba(0, 123, 255, 0.5)', // Blue
                        'rgba(255, 193, 7, 0.5)', // Yellow
                        'rgba(40, 167, 69, 0.5)', // Green
                        'rgba(108, 117, 125, 0.5)', // Gray
                        'rgba(6, 214, 160, 0.5)', // Teal
                    ];

                    // Asegurarse de que haya suficientes colores para todas las categorías
                    const backgroundColors = adminLteColors.slice(0, Object.keys(data).length);

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: Object.keys(data),
                            datasets: [{
                                label: 'Vuelos',
                                data: Object.values(data),
                                backgroundColor: backgroundColors,
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            // Otras opciones de personalización aquí
                        }
                    });
                });
        });
    </script>

    {{-- GRAFICA DE GASEOS POR AERONAVE --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route('charts.fuelings') }}')
                .then(response => response.json())
                .then(data => {
                    // Configurar el gráfico de barras
                    const ctx = document.getElementById('fuelingsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.aircraft_names,
                            datasets: [{
                                label: 'Cantidad de Gaseo',
                                data: data.fuel_amounts,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de las barras
                                borderColor: 'rgba(54, 162, 235, 1)', // Borde de las barras
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true // Comenzar el eje Y desde cero
                                }
                            },
                            // Más opciones de personalización aquí
                        }
                    });
                });
        });
    </script>
@stop
