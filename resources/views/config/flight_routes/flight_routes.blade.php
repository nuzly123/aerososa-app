@extends('adminlte::page')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nombre de Rutas</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            @include('config.flight_routes.create')
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
                            <th class="text-center">Origen</th>
                            <th class="text-center">Destino</th>
                            <th class="text-center">Creado</th>
                            <th class="text-center">Modificado</th>
                            <th class="text-center">Creado por</th>
                            <th class="text-center">Modificado por</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $flight_route)
                                <tr>
                                    <td class="text-center">{{ $flight_route->id }}</td>
                                    <td class="text-center">{{ $flight_route->route }}</td>
                                    <td class="text-center">{{ $flight_route->originCity->city }}</td>
                                    <td class="text-center">{{ $flight_route->destinationCity->city }}</td>
                                    <td class="text-center">{{ $flight_route->createdBy->user }}</td>
                                    <td class="text-center">{{ $flight_route->updatedBy->user }}</td>
                                    <td class="text-center">{{ $flight_route->created_at }}</td>
                                    <td class="text-center">{{ $flight_route->updated_at }}</td>
                                    <td class="text-center">
                                        {{-- <form action=""> --}}
                                        <a href="flight_routes/{{ $flight_route->id }}/update-status"
                                            class="btn btn-outline-{{ $flight_route->status ? 'success' : 'danger' }} btn-xs">
                                            <span
                                                class="fas {{ $flight_route->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                        </a>
                                        {{-- </form> --}}
                                        <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                            name="editButton" data-toggle="modal"
                                            data-target="#modal-edit{{ $flight_route->id }}">
                                            <span class="fas fa-pen"></span>
                                        </button>



                                    </td>
                                    @include('config.flight_routes.edit')
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
    <script src="../resources/js/flight_routes.js"></script>
@stop
