@extends('adminlte::page')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista Empleados</h3>
                <div class="card-tools">
                    {{-- <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span>
                    </button> --}}
                    <a href="employees/create" class="btn btn-sm btn-default">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-dataTable table-striped  dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Oficina</th>
                            <th class="text-center">Tipo Contrato</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->offices->office }}</td>
                                <td class="text-center">{{ $employee->contracts->contract }}</td>
                                <td class="text-center">
                                    <a href="stations/{{ $employee->id }}/update-status"
                                        class="btn btn-outline-{{ $employee->status ? 'success' : 'danger' }} btn-xs">
                                        <span
                                            class="fas {{ $employee->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                    </a>
                                    {{-- </form> --}}
                                    <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                        name="editButton" data-toggle="modal" data-target="#modal-edit{{ $employee->id }}">
                                        <span class="fas fa-pen"></span>
                                    </button>
                                    <button type="submit" class="btn btn-xs btn-outline-info tablabutton" name="infoButton"
                                        data-toggle="modal" data-target="#modal-info-{{ $employee->id }}">
                                        <span class="fas fa-info-circle"></span>
                                    </button>
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
@stop
