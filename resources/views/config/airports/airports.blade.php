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
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>Aeropuerto</th>
                            <th>Código</th>
                            <th class="text-center">Creado</th>
                            <th class="text-center">Modificado</th>
                            <th class="text-center">Creado por</th>
                            <th class="text-center">Modificado por</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $airport)
                                <tr>
                                    <td>{{ $airport->airport }}</td>
                                    <td>{{ $airport->code }}</td>
                                    <td class="text-center">{{ $airport->created_at }}</td>
                                    <td class="text-center">{{ $airport->updated_at ?? 'N/D' }}</td>
                                    <td class="text-center"> {{ $airport->createdBy->username }} </td>
                                    <td class="text-center"> {{ $airport->updatedBy->username ?? 'N/D' }} </td>
                                    <td class="text-center">
                                        {{-- <form action=""> --}}
                                        <a href="airports/{{$airport->id}}/update-status"
                                            class="btn btn-outline-{{ $airport->status ? 'success' : 'danger' }} btn-xs">
                                            <span class="fas {{ $airport->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                        </a>
                                        {{-- </form> --}}
                                        <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                            name="editButton" data-toggle="modal"
                                            data-target="#modal-edit{{ $airport->id }}">
                                            <span class="fas fa-pen"></span>
                                        </button>


                                    </td>
                                    @include('config.airports.edit')
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
@stop
