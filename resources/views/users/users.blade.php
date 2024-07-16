@extends('adminlte::page')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Lista Usuarios</h3>
                <div class="card-tools">
                    {{-- <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button> --}}
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <span class="fas fa-fw fa-plus"></span>Nuevo
                    </a>
                </div>
            </div>
            @if (Session::get('success'))
                <div class="alert alert-success" id="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body table-responsive">
                <table id="users-table" class="table table-dataTable table-striped  dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col" class="text-center">Usuario</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Rol</th>
                            <th scope="col" class="text-center">Creado</th>
                            <th scope="col" class="text-center">Actualizado</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td class="text-center">{{ $user->username }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->getRoleNames()->first() }}</td>
                                <td class="text-center">{{ $user->created_at }}</td>
                                <td class="text-center">{{ $user->updated_at }}</td>
                                <td class="text-center">
                                    <a href="users/{{ $user->id }}/update-status"
                                        class="btn btn-outline-{{ $user->status ? 'success' : 'danger' }} btn-xs">
                                        <span
                                            class="fas {{ $user->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                    </a>
                                    <a href="users/{{ $user->id }}/edit"
                                        class="btn btn-xs btn-outline-warning tablabutton">
                                        <span class="fas fa-pen"></span>
                                    </a>
                                    {{-- <a href="users/{{ $user->id }}/reset-password"
                                        class="btn btn-xs btn-outline-secondary tablabutton">
                                        <span class="fas fa-key"></span>
                                    </a> --}}
                                    {{-- <a href="users/{{ $user->id }}/profile"
                                        class="btn btn-xs btn-outline-info tablabutton">
                                        <span class="fas fa-eye"></span>
                                    </a> --}}
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
