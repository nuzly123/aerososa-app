@extends('adminlte::page')

@section('title', 'Monitoreo | Vuelos')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Vuelos de Itinerario</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            @include('config.flights.create')
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Código</th>
                            <th class="text-center">Ruta</th>
                            <th class="text-center">Salida</th>
                            <th class="text-center">Llegada</th>
                            <th class="text-center">Duración</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $flight)
                                <tr>
                                    <td class="text-center">{{ $flight->code }}</td>
                                    <td class="text-center">{{ $flight->flightRoute->route }}</td>
                                    <td class="text-center"> {{ $flight->departure }} </td>
                                    <td class="text-center"> {{ $flight->arrival }} </td>
                                    <td class="text-center"> {{ $flight->flight_time }} </td>
                                    <td class="text-center">
                                        {{-- <form action=""> --}}
                                        <a href="flights/{{ $flight->id }}/update-status"
                                            class="btn btn-outline-{{ $flight->status ? 'success' : 'danger' }} btn-xs">
                                            <span
                                                class="fas {{ $flight->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                        </a>
                                        {{-- </form> --}}
                                        <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                            name="editButton" data-toggle="modal"
                                            data-target="#modal-edit{{ $flight->id }}">
                                            <span class="fas fa-pen"></span>
                                        </button>


                                    </td>
                                    @include('config.flights.edit')
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-warning">
                                        <i class="icon fas fa-exclamation-triangle"></i> No hay registros.
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        setTimeout(() => {
            $('#alert').fadeOut('slow');
        }, 2000);
    </script>
    <script src="../resources/js/flight.js"></script>
@stop
