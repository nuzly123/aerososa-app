@extends('adminlte::page')

@section('title', 'AeroSosa | Monitoreo')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Aeropuertos</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            @include('config.airports.create')
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Aeropuerto</th>
                            <th>Código</th>
                            <th>Creado</th>
                            <th>Modificado</th>
                            <th>Creado por</th>
                            <th>Modificado por</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $airport)
                            <tr>
                                <td>{{ $airport->airport }}</td>
                                <td>{{ $airport->code }}</td>
                                <td>{{ $airport->created_at }}</td>
                                <td class="text-center">{{ $airport->update_at ?? 'N/D' }}</td>
                                <td class="text-center"> {{ $airport->user_create }} </td>
                                <td class="text-center"> {{ $airport->user_update }} </td>
                                <td class="text-center">
                                    <form action="actions">
                                        @if ($airport->status != 1)
                                            <button type="submit"
                                                class="btn btn-outline-danger btn-xs tablabutton btnActivar" name="activar"
                                                AirportID={{ $airport->id }}>
                                                <span class="fas fa-toggle-on fa-flip-horizontal"></span>
                                            </button>
                                        @else
                                            <button type="submit"
                                                class="btn btn-outline-success btn-xs tablabutton btnActivar"
                                                name="desactivar" AirportID={{ $airport->id }}>
                                                <span class="fas fa-toggle-on"></span>
                                            </button>
                                        @endif
                                        <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                            name="edit">
                                            <span class="fas fa-pen"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
