@extends('adminlte::page')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Lista Empleados</h3>
                <div class="card-tools">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">
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
                <table id="example" class="table table-dataTable table-striped  dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Oficina</th>
                            <th class="text-center">Tipo Contrato</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $employee)
                            <tr>
                                <td>{{ $employee->name . ' ' . $employee->last_name }}</td>
                                <td>
                                    @foreach ($employee->positions as $index => $position_detail)
                                        {{ $position_detail->positions->position }}
                                        @if ($index < $employee->positions->count() - 1)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $employee->offices->code }}</td>
                                <td class="text-center">{{ $employee->contracts->contract }}</td>
                                <td class="text-center">
                                    <a href="employees/{{ $employee->id }}/update-status"
                                        class="btn btn-outline-{{ $employee->status ? 'success' : 'danger' }} btn-xs">
                                        <span
                                            class="fas {{ $employee->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                    </a>
                                    {{-- </form> --}}
                                    <a href="employees/{{ $employee->id }}/edit"
                                        class="btn btn-xs btn-outline-warning tablabutton">
                                        <span class="fas fa-pen"></span>
                                    </a>
                                    {{-- <button type="submit" class="btn btn-xs btn-outline-warning tablabutton"
                                        name="editButton" data-toggle="modal" data-target="#modal-edit{{ $employee->id }}">
                                        <span class="fas fa-pen"></span>
                                    </button> --}}
                                    <a href="employees/{{ $employee->id }}/profile"
                                        class="btn btn-xs btn-outline-info tablabutton">
                                        <span class="fas fa-eye"></span>
                                    </a>
                                    {{-- <button type="submit" class="btn btn-xs btn-outline-info tablabutton" name="viewprofile"
                                        data-toggle="modal" data-target="#modal-info-{{ $employee->id }}">
                                        <span class="fas fa-eye"></span>
                                    </button> --}}
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
