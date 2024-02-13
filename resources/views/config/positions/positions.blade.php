@extends('adminlte::page')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cargos</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            @include('config.positions.create')
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cargo</th>
                            <th>Creado</th>
                            <th>Modificado</th>
                            <th>Creado por</th>
                            <th>Modificado por</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $position)
                                <tr>
                                    <td>{{ $position->position }}</td>
                                    <td class="text-center">{{ $position->created_at }}</td>
                                    <td class="text-center">{{ $position->updated_at ?? 'N/D' }}</td>
                                    <td class="text-center"> {{ $position->createdBy->user }} </td>
                                    <td class="text-center"> {{ $position->updatedBy->user ?? 'N/D' }} </td>
                                    <td class="text-center">
                                        {{-- <form action=""> --}}
                                        <a href="positions/{{ $position->id }}/update-status"
                                            class="btn btn-outline-{{ $position->status ? 'success' : 'danger' }} btn-xs">
                                            <span
                                                class="fas {{ $position->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                        </a>
                                        {{-- </form> --}}
                                        <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                            name="editButton" data-toggle="modal"
                                            data-target="#modal-edit{{ $position->id }}">
                                            <span class="fas fa-pen"></span>
                                        </button>


                                    </td>
                                    @include('config.positions.edit')
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
