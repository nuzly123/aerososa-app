<!DOCTYPE html>
<html>

<head>
    <title>Detalles de Tráfico Aéreo</title>
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
            {{-- <p class="text-left">Vuelo #{{ $air_traffic->reference }}</p> --}}
        </div>

        <h2>Informe de Tráfico Aéreo</h2>

        <div class="section">
            <h2 class="section-title">Información del Vuelo</h2>
            <table class="data-table">
                <tr>
                    <th>Referencia</th>
                    <td>{{ $air_traffic->reference }}</td>
                </tr>
                <tr>
                    <th>Fecha de Vuelo</th>
                    <td>{{ $air_traffic->flight_date }}</td>
                </tr>
                <tr>
                    <th>No. Vuelo</th>
                    <td>{{ $air_traffic->flight->code }}</td>
                </tr>
                <tr>
                    <th>Aeronave</th>
                    <td>{{ $air_traffic->aircraft->registration }}</td>
                </tr>
                <tr>
                    <th>Ruta</th>
                    <td>{{ $air_traffic->flight_route }}</td>
                </tr>
                <tr>
                    <th>Hora Salida</th>
                    <td>{{ $air_traffic->departure }}</td>
                </tr>
                <tr>
                    <th>Hora Llegada</th>
                    <td>{{ $air_traffic->arrival }}</td>
                </tr>
                <tr>
                    <th>Estado de Vuelo</th>
                    <td>{{ $flight_status_array[$air_traffic->flight_status] }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Pasajeros</h2>
            <table class="data-table">
                <tr>
                    <th>PX</th>
                    <th>DH</th>
                    <th>INF</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td class="text-center">{{ $air_traffic->px }}</td>
                    <td class="text-center">{{ $air_traffic->dh }}</td>
                    <td class="text-center">{{ $air_traffic->inf }}</td>
                    <td class="text-center">{{ $air_traffic->total_passengers }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Libras</h2>
            <table class="data-table">
                <tr>
                    <th>PX</th>
                    <th>Carga</th>
                    <th>Trans</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td class="text-center">{{ $air_traffic->px_lbs }}</td>
                    <td class="text-center">{{ $air_traffic->freight }}</td>
                    <td class="text-center">{{ $air_traffic->trans_weight }}</td>
                    <td class="text-center">{{ $air_traffic->total_lbs }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Tripulación Asignada</h2>
            <table class="data-table">
                <tr>
                    <th>Capitán</th>
                    <td>{{ $air_traffic->captain->name . ' ' . $air_traffic->captain->last_name }}</td>
                </tr>
                <tr>
                    <th>Primer Oficial</th>
                    <td>{{ $air_traffic->first_official->name . ' ' . $air_traffic->first_official->last_name }}</td>
                </tr>
                <tr>
                    <th>Tripulantes de Cabina</th>
                    <td>
                        @if ($air_traffic->flightAssistants && !$air_traffic->flightAssistants->isEmpty())
                            @foreach ($air_traffic->flightAssistants as $assistantDetail)
                                {{ $assistantDetail->name . ' ' . $assistantDetail->last_name }}<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Observador</th>
                    <td>{{ $air_traffic->obsservant ? $air_traffic->obsservant : 'N/A' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Tránsitos</h2>
            <table class="data-table">
                <tr>
                    <th>TGU</th>
                    <th>SAP</th>
                    <th>RTB</th>
                    <th>LCE</th>
                </tr>
                <tr>
                    <td class="text-center">{{ $air_traffic->trans_tgu }}</td>
                    <td class="text-center">{{ $air_traffic->trans_sap }}</td>
                    <td class="text-center">{{ $air_traffic->trans_rtb }}</td>
                    <td class="text-center">{{ $air_traffic->trans_lce }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Combustible (LBS)</h2>
            <table class="data-table">
                <tr>
                    <th>Inicial</th>
                    <th>Gaseo</th>
                    <th>Consumo</th>
                    <th>Remanente</th>
                </tr>
                <tr>
                    <td class="text-center">{{ $air_traffic->initial_fuel }}</td>
                    <td class="text-center">{{ $fueling ? $fueling->fuel_amount : '0' }}</td>
                    <td class="text-center">{{ $air_traffic->fuel_consumption }}</td>
                    <td class="text-center">{{ $air_traffic->residual_fuel }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2 class="section-title">Observaciones</h2>
            <p>{{ $air_traffic->remark ? $air_traffic->remark : 'Ninguna.' }}</p>
        </div>
    </div>
</body>

</html>
