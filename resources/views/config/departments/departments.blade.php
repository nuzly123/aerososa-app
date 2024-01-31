@extends('adminlte::page')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Departamentos</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
            </div>
            @include('config.departments.create')
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ciudad</th>
                            <th>Creado</th>
                            <th>Modificado</th>
                            <th>Creado por</th>
                            <th>Modificado por</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $department)
                                <tr>
                                    <td>{{ $department->department }}</td>
                                    <td class="text-center">{{ $department->created_at }}</td>
                                    <td class="text-center">{{ $department->updated_at ?? 'N/D' }}</td>
                                    <td class="text-center"> {{ $department->createdBy->user }} </td>
                                    <td class="text-center"> {{ $department->updatedBy->user ?? 'N/D' }} </td>
                                    <td class="text-center">
                                        {{-- <form action=""> --}}
                                        <a href="departments/{{ $department->id }}/update-status"
                                            class="btn btn-outline-{{ $department->status ? 'success' : 'danger' }} btn-xs">
                                            <span
                                                class="fas {{ $department->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                        </a>
                                        {{-- </form> --}}
                                        <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                            name="editButton" data-toggle="modal"
                                            data-target="#modal-edit{{ $department->id }}">
                                            <span class="fas fa-pen"></span>
                                        </button>


                                    </td>
                                    @include('config.departments.edit')
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
