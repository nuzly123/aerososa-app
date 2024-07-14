@extends('adminlte::page')

@php
    use Carbon\Carbon;
@endphp

@section('content_header')
    <h1>Tráfico Aéreo</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Registro Diario de Tráfico Aéreo</h3>
                <div class="card-tools">
                    <div class="row">
                        <div class="col-md-10">
                            <form id="filter-form" method="POST" action="{{ route('air_traffic.filter') }}">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        <input type="text" id="datepicker" name="date" value="{{ $date }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ url('air_traffic/create') }}" class="btn btn-sm btn-default">
                                <span class="fas fa-plus"></span>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body table-responsive">
                <table id="example" class="table table-dataTable table-striped  dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-left">Referencia</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Vuelo #</th>
                            <th class="text-center">Ruta</th>
                            <th class="text-center">Salida</th>
                            <th class="text-center">LLegada</th>
                            <th class="text-center">Total Pasajeros</th>
                            <th class="text-center">Total LBS</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $air_traffic)
                            <tr>
                                <td class="text-left">{{ $air_traffic->reference }}</td>
                                <td class="text-center">{{ $air_traffic->flight_date }}</td>
                                <td class="text-center">{{ $air_traffic->flight->code }}</td>
                                <td class="text-center">{{ $air_traffic->flight_route }}</td>
                                {{-- <td class="text-center">{{ $air_traffic->departure }}</td> --}}
                                <td class="text-center">{{ Carbon::parse($air_traffic->departure)->format('H:i') }}</td>
                                {{-- <td class="text-center">{{ $air_traffic->arrival }}</td> --}}
                                <td class="text-center">{{ Carbon::parse($air_traffic->arrival)->format('H:i') }}</td>
                                <td class="text-center">{{ $air_traffic->total_passengers }}</td>
                                <td class="text-center">{{ $air_traffic->total_lbs }}</td>
                                {{-- <td class="text-center"><span class="badge bg-danger">
                                        {{ $flight_status_array[$air_traffic->flight_status] }} </span></td> --}}
                                <td class="text-center">
                                    <span class="badge {{ $flight_status_classes[$air_traffic->flight_status] }}">
                                        {{ $flight_status_array[$air_traffic->flight_status] }}
                                    </span>
                                </td>
                                <td class="text-center"><a href="{{ url("air_traffic/{$air_traffic->id}/edit") }}"
                                        class="btn btn-xs btn-outline-warning tablabutton">
                                        <span class="fas fa-pen"></span>
                                    </a>
                                    <button type="submit" class="btn btn-xs btn-outline-info tablabutton" name="infoButton"
                                        data-toggle="modal" data-target="#modal-info-{{ $air_traffic->id }}">
                                        <span class="fas fa-info-circle"></span>
                                    </button>
                                    @include('air_traffic.info')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="../../resources/css/air_traffic.css"> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        /* Estilo para resaltar cada sección del formulario */
        .section {
            background-color: #f9f9f9;
            /* Color de fondo */
            border: 1px solid #ddd;
            /* Borde sólido */
            padding: 20px;
            /* Espaciado interno */
            margin-bottom: 20px;
            /* Espaciado inferior entre secciones */
            border-radius: 5px;
            /* Bordes redondeados */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Sombra */
        }

        /* Estilo para el título de cada sección */
        .section h4 {
            margin-top: 0;
            /* Elimina el margen superior predeterminado del título */
            margin-bottom: 20px;
            /* Espaciado inferior entre el título y los campos */
        }


        .section-title {
            background-color: rgb(107, 126, 146);
            color: #fff;
            padding: 8px 16px;
            margin-bottom: 0;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .list-unstyled {
            list-style: none;
            padding-left: 0;
        }

        .info-section {
            text-align: left;
            margin-left: 5%;
        }
    </style>
@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $('.table-dataTable').dataTable({
            paging: false
        });
    </script>
    <script>
        setTimeout(() => {
            $('#alert').fadeOut('slow');
        }, 2000);
    </script>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                onSelect: function(dateText) {
                    $('#filter-form').submit();
                }
            });
        });
    </script>
@stop
