<!DOCTYPE html>
<html>
@php
    use Carbon\Carbon;
@endphp

<head>
    <title>Historial de Aeronave</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            /* Reducir el tamaño de fuente general */
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .container {
            padding: 10px;
            /* Reducir el espacio alrededor del contenido */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            /* Reducir el margen inferior */
        }

        .logo {
            width: 100px;
            /* Ajustar el tamaño del logo */
        }

        .generated-by {
            text-align: right;
            font-size: 10px;
            /* Tamaño de fuente para la información de generación */
        }

        h2 {
            font-size: 16px;
            /* Reducir tamaño de subtítulos */
            margin-top: 20px;
            /* Reducir espacio superior */
            margin-bottom: 10px;
            /* Reducir espacio inferior */
        }

        .section {
            margin-bottom: 10px;
            /* Reducir el espacio entre secciones */
        }

        .section-title {
            font-size: 12px;
            /* Reducir tamaño de título de sección */
            font-weight: bold;
            margin-bottom: 5px;
            /* Reducir espacio inferior */
            text-align: left;
            background-color: #f2f2f2;
            padding: 5px;
            border: 1px solid #ddd;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            /* Reducir espacio inferior */
        }

        /* .resumen {
            width: auto;
            border-collapse: collapse;
            margin-bottom: 10px;
        } */

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 5px;
            /* Reducir el padding dentro de las celdas */
            text-align: left;
            font-size: 10px;
            /* Reducir tamaño de fuente dentro de las tablas */
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('storage/uploads/aerososa-logo.png') }}" alt="Aerososa Logo" class="logo">
            <p class="text-right">Generado por: {{ Auth::user()->username }}</p>
        </div>

        <h2>Informe de Movimientos</h2>
        <p><strong>Fecha(s):</strong>
            {{ $real_fecha_inicial ? Carbon::parse($real_fecha_inicial)->format('Y-m-d') : '-' }} 
            {{ $real_fecha_final ? '/ '.Carbon::parse($real_fecha_final)->format('Y-m-d') : '-' }}
        </p>
        
        <div class="section">
            <h2 class="section-title">{{ $aircraft ? $aircraft->registration : '' }}</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Referencia de Vuelo</th>
                        <th>No. Vuelo</th>
                        <th>Ruta</th>
                        <th>Tiempo de Vuelo (mins)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $data)
                        <tr>
                            <td class="text-center">{{ $counter++ }}</td>
                            <td class="text-center">{{ $data['result']->flight_date }}</td>
                            <td class="text-center">{{ $data['result']->reference }}</td>
                            <td class="text-center">{{ $data['result']->flight->code }}</td>
                            <td class="text-center">{{ $data['result']->flight_route }}</td>
                            <td class="text-center">{{ $data['flight_time'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (empty($aircraft))
            <div class="section">
                <h2 class="section-title">Resumen de Piernas Voladas por Equipo</h2>
                <table class="data-table resumen">
                    @foreach ($aircrafts as $aircraft)
                        @if (isset($legsPerAircraft[$aircraft->id]))
                            <tr>
                                <th>{{ $aircraft->registration }}</th>
                                <td>{{ $legsPerAircraft[$aircraft->id] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        @endif
    </div>
</body>

</html>
