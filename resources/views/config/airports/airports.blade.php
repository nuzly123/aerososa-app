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
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $airport)
                        <tr>
                            <td>{{ $airport->airport }}</td>
                            <td>{{ $airport->code }}</td>
                            <td>{{ $airport->created_at }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                
                            </td>
                            <td class="text-center">
                                
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
            </div>
        </div>
    </div>
@stop
