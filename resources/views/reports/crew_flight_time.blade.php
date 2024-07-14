<!DOCTYPE html>
<html>
@php
    use Carbon\Carbon;
@endphp

<head>
    <title>Historial de Piloto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
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
            font-size: 14px;
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

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 5px;
            /* Reducir el padding dentro de las celdas */
            text-align: left;
            font-size: 12px;
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

        <h2>Informe de Horas Acumuladas</h2>

        <div class="section">
            <h2 class="section-title">{{ $pilot->name . ' ' . $pilot->last_name }}</h2>
            <p><strong>Cargo(s):</strong>
                @foreach ($pilot->positions as $position)
                    {{ $position->positions->position . ',' }}
                @endforeach
            </p>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Referencia de Vuelo</th>
                        <th>No. Vuelo</th>
                        <th>Ruta</th>
                        <th>Tiempo de Vuelo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td class="text-center">{{ $counter++ }}</td>
                            <td class="text-center">{{ Carbon::parse($result->created_at)->format('d-m-Y') }}</td>
                            <td class="text-center">{{ $result->airTraffic->reference }}</td>
                            <td class="text-center">{{ $result->airTraffic->flight->code }}</td>
                            <td class="text-center">{{ $result->airTraffic->flight_route }}</td>
                            <td class="text-center">{{ $result->pilot_flight_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h2 class="section-title">Resumen</h2>
            <table class="data-table">
                <tr>
                    <th style="">Fecha Inicial: </th>
                    <td>{{ $real_fecha_inicial ? Carbon::parse($real_fecha_inicial)->format('d-m-Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Fecha Final: </th>
                    <td>{{ $real_fecha_final ? Carbon::parse($real_fecha_final)->format('d-m-Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Total en Minutos: </th>
                    <td>{{ $total_minutes . 'm' }}</td>
                </tr>
                <tr>
                    <th>Total en Horas: </th>
                    <td>{{ $total_flight_time }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
