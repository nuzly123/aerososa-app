@extends('adminlte::page')

@section('content_header')
    <h1>Detalle de Rutas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalles de Rutas</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            @include('config.flight_route_details.create')
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Ruta</th>
                            <th class="text-center">Tipo de Avión</th>
                            <th class="text-center">Tiempo</th>
                            <th class="text-center">Combustible</th>
                            <th class="text-center">Creado</th>
                            <th class="text-center">Modificado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $flight_route_detail)
                                <tr>
                                    <td class="text-center">{{ $flight_route_detail->id }}</td>
                                    <td class="text-center">{{ $flight_route_detail->route->route }}</td>
                                    <td class="text-center">{{ $flight_route_detail->aircraftType->type }}</td>
                                    <td class="text-center">{{ $flight_route_detail->time }}</td>
                                    <td class="text-center">{{ $flight_route_detail->fuel }}</td>
                                    <td class="text-center">{{ $flight_route_detail->createdBy->user }}</td>
                                    <td class="text-center">{{ $flight_route_detail->updatedBy->user }}</td>
                                    <td class="text-center">
                                        {{-- <form action=""> --}}
                                        <a href="{{-- flight_routes/{{ $flight_route->id }}/update-status --}}"
                                            class="btn btn-outline-{{ $flight_route_detail->status ? 'success' : 'danger' }} btn-xs">
                                            <span
                                                class="fas {{ $flight_route_detail->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                        </a>
                                        {{-- </form> --}}
                                        <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                            name="editButton" data-toggle="modal" data-target=".modal-edit" disabled>
                                            <span class="fas fa-pen"></span>
                                        </button>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
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

@section('css')
    <!-- CSS de Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../resources/css/route_details.css">

    {{--  <!-- CSS de Select2 Theme (opcional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2-bootstrap.min.css" rel="stylesheet" /> --}}
@stop

@section('js')
    <script>
        setTimeout(() => {
            $('#alert').fadeOut('slow');
        }, 2000);
    </script>

    <!-- JavaScript de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 en el campo de selección de ruta
            $('#route_id').select2({
                /* theme: 'bootstrap', // Tema opcional */
                placeholder: 'Seleccionar Ruta',
                allowClear: true, // Permitir borrar la selección
            });
        });
    </script>
@stop
