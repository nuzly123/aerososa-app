@extends('adminlte::page')

@section('content_header')
    <h1>Tráfico Aéreo</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registro Diario de Tráfico Aéreo</h3>
                <div class="card-tools">
                    {{-- <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                    data-target="#modal-nuevo">
                    <span class="fas fa-plus"></span>
                </button> --}}
                    <a href="air_traffic/create" class="btn btn-sm btn-default">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body">
                <table id="example" class="table table-dataTable table-striped  dt-responsive" style="width:100%">
                    <thead>
                        <tr>
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
                                <td class="text-center">{{ $air_traffic->flight_date }}</td>
                                <td class="text-center">{{ $air_traffic->flight->code }}</td>
                                <td class="text-center">{{ $air_traffic->flight_route }}</td>
                                <td class="text-center">{{ $air_traffic->departure }}</td>
                                <td class="text-center">{{ $air_traffic->arrival }}</td>
                                <td class="text-center">{{ $air_traffic->total_passengers }}</td>
                                <td class="text-center">{{ $air_traffic->total_lbs }}</td>
                                <td class="text-center">{{ $flight_status_array[$air_traffic->flight_status] }}</td>
                                <td class="text-center"><a href="air_traffic/{{ $air_traffic->id }}/edit"
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
    <link rel="stylesheet" href="../resources/css/air_traffic.css">
@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('.table-dataTable').dataTable();
    </script>
    <script>
        setTimeout(() => {
            $('#alert').fadeOut('slow');
        }, 2000);
    </script>
@stop
