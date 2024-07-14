@extends('adminlte::page')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Oficinas</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            @include('config.offices.create')
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Oficina</th>
                            <th class="text-center">Código</th>
                            <th class="text-center">Extensión</th>
                            <th class="text-center">Creado</th>
                            <th class="text-center">Modificado</th>
                            <th class="text-center">Creado por</th>
                            <th class="text-center">Modificado por</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $office)
                                <tr>
                                    <td>{{ $office->office }}</td>
                                    <td class="text-center">{{ $office->code }}</td>
                                    <td class="text-center">{{ $office->extension }}</td>
                                    <td class="text-center">{{ $office->created_at }}</td>
                                    <td class="text-center">{{ $office->updated_at ?? 'N/D' }}</td>
                                    <td class="text-center"> {{ $office->createdBy->username }} </td>
                                    <td class="text-center"> {{ $office->updatedBy->username ?? 'N/D' }} </td>
                                    <td class="text-center">
                                        {{-- <form action=""> --}}
                                        <a href="offices/{{ $office->id }}/update-status"
                                            class="btn btn-outline-{{ $office->status ? 'success' : 'danger' }} btn-xs">
                                            <span
                                                class="fas {{ $office->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                        </a>
                                        {{-- </form> --}}
                                        <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                            name="editButton" data-toggle="modal"
                                            data-target="#modal-edit{{ $office->id }}">
                                            <span class="fas fa-pen"></span>
                                        </button>
                                        
                                        <button type="submit" class="btn btn-xs btn-outline-info tablabutton"
                                            name="infoButton" data-toggle="modal"
                                            data-target="#modal-info-{{ $office->id }}">
                                            <span class="fas fa-info-circle"></span>
                                        </button>
                                    </td>
                                    @include('config.offices.edit')
                                    @include('config.offices.info')
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

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script>
        setTimeout(() => {
            $('#alert').fadeOut('slow');
        }, 2000);
    </script>
@stop
