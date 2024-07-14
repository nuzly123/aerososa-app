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

        <div class="section">
            <h2 class="section-title">{{ $pilot ? $pilot->name . ' ' . $pilot->last_name : '' }}</h2>
            @if (!empty($pilot))
                <p><strong>Cargo(s):</strong>
                    @foreach ($pilot->positions as $position)
                        {{ $position->positions->position . ',' }}
                    @endforeach
                </p>
            @endif
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>No. Vuelo</th>
                        <th>Ruta</th>
                        @if (is_null($pilot))
                            <th>Capitán</th>
                            <th>Primer Oficial</th>
                        @endif
                        <th>Referencia de Vuelo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td class="text-center">{{ $counter++ }}</td>
                            <td class="text-center">{{ Carbon::parse($result->flight_date)->format('d-m-Y') }}</td>
                            <td class="text-center">{{ $result->flight->code }}</td>
                            <td class="text-center">{{ $result->flight_route }}</td>
                            @if (is_null($pilot))
                                <td class="text-center">{{ $result->captain->name . ' ' . $result->captain->last_name }}
                                </td>
                                <td class="text-center">
                                    {{ $result->first_official->name . ' ' . $result->first_official->last_name }}</td>
                            @endif
                            <td class="text-center">{{ $result->reference }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        @if (empty($pilot))
            <div class="section">
                <h2 class="section-title">Resumen de Piernas Voladas por Equipo</h2>
                <table class="data-table resumen">
                    @php
                        $processedPilots = collect();
                    @endphp

                    @foreach ($results as $result)
                        @if (isset($legsPerPilot[$result->captain->id]) && !$processedPilots->contains($result->captain->id))
                            <tr>
                                <th>{{ $result->captain->name . ' ' . $result->captain->last_name }}</th>
                                <td>{{ $legsPerPilot[$result->captain->id] }}</td>
                            </tr>
                            @php
                                $processedPilots->push($result->captain->id);
                            @endphp
                        @endif

                        @if (isset($legsPerPilot[$result->first_official->id]) && !$processedPilots->contains($result->first_official->id))
                            <tr>
                                <th>{{ $result->first_official->name . ' ' . $result->first_official->last_name }}</th>
                                <td>{{ $legsPerPilot[$result->first_official->id] }}</td>
                            </tr>
                            @php
                                $processedPilots->push($result->first_official->id);
                            @endphp
                        @endif
                    @endforeach
                </table>


            </div>
        @endif
    </div>
</body>

</html>
