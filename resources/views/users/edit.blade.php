@extends('adminlte::page')

@php
    use Illuminate\Support\Facades\Auth;
@endphp

@section('title', 'Monitoreo | Editar Usuario')

@section('content_header')
    <h1 class="m-0 text-dark">Usuarios</h1>
@stop

@section('content')
    {{-- formulario usuario --}}
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-warning mb-4">
                <h5 class="card-header"><i class="fas fa-fw fa-edit"></i>Editar Usuario</h5>
                <form action="{{ route('admin.users.update', $user) }}" method="post">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>Empleado</label>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" readonly
                                                class="form-control" placeholder="Seleccionar Empleado"
                                                value="{{ $user->name }}" required>
                                            <input type="hidden" id="dni" name="dni" value="{{ $user->dni }}">
                                            <div class="input-group-prepend">
                                                {{-- <a href="" type="button" class="btn btn-block btn-default btn-sm"
                                                    name="searchEmployee" data-toggle="modal"
                                                    data-target="#modal-employeeList">
                                                    <i class="fas fa-search pt-2 pr-2 pl-2 text-dark"></i>
                                                </a> --}}

                                                {{-- @include('users.search_employee') --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Correo</label>
                                        <input type="email" class="form-control" id="email" name="email" required
                                            readonly value="{{ $user->email }}">
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nombre de Usuario <code>*</code></label>
                                            <input type="text" name="username" required class="form-control"
                                                id="user" placeholder="Usuario" value="{{ $user->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="selectRole" class="form-label">Rol <code>*</code></label>
                                        <select class="custom-select rounded-2" name="role">
                                            <option value="0">- Opción -</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $user->getRoleNames()->first() == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                                <input type="hidden" id="employee_id" name="employee_id" value="{{ $user->employee_id }}">
                                <input type="hidden" name="user_update" value="{{ Auth::user()->id }}">

                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <a href="{{ url('/users') }}" class="btn btn-default float-left"><i
                                class="fas fa-fw fa-arrow-left"></i>
                            Regresar</a>
                        <button type="submit" class="btn btn-success float-right" name="editEmpleado"><i
                                class="fas fa-fw fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <style>
        .selected {
            background-color: #d0e4f1;
            /* Color de fondo sombreado */
        }
    </style>
@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script>
        $(document).ready(function() {
            // Inicializar DataTable
            var table = $('#employee-table').DataTable({
                "paging": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "lengthChange": false
            });

            // Búsqueda en tiempo real
            $('#employee-search').on('keyup', function() {
                let query = $(this).val();

                if (query.length > 1) {
                    $.ajax({
                        url: '{{ route('employees.search') }}',
                        type: 'GET',
                        data: {
                            'query': query
                        },
                        success: function(data) {
                            table.clear();
                            if (data.length > 0) {
                                data.forEach(function(result) {
                                    var rowNode = table.row.add([
                                        result.id,
                                        result.name,
                                        result.dni,
                                        result.email,
                                        result.has_user ? '1' : '0'
                                    ]).draw().node();

                                    if (result.has_user) {
                                        $(rowNode).addClass('user-exists');
                                    }
                                });
                            } else {
                                table.row.add([
                                    'No se encontraron resultados',
                                    '',
                                    '',
                                    '',
                                ]).draw();
                            }
                        }
                    });
                } else {
                    table.clear().draw();
                }
            });

            var clickTimeout;

            // Manejar clic en las filas de la tabla
            $('#employee-table tbody').on('click', 'tr', function() {
                clearTimeout(clickTimeout);
                var row = $(this);

                clickTimeout = setTimeout(function() {
                    // Resaltar la fila con un clic
                    if (row.hasClass('selected')) {
                        row.removeClass('selected');
                    } else {
                        table.$('tr.selected').removeClass('selected');
                        row.addClass('selected');
                    }
                }, 200); // Un retraso corto para distinguir entre click y dblclick
            });

            // Manejar doble clic en las filas de la tabla
            $('#employee-table tbody').on('dblclick', 'tr', function() {
                clearTimeout(clickTimeout);
                var row = $(this);

                // Verificar si el empleado ya tiene usuario
                if (row.hasClass('user-exists')) {
                    alert('Este empleado ya tiene un usuario y no puede ser seleccionado.');
                    return; // Prevenir selección si el empleado ya tiene usuario
                }

                // Resaltar la fila con doble clic y seleccionar
                if (!row.hasClass('selected')) {
                    table.$('tr.selected').removeClass('selected');
                    row.addClass('selected');
                }

                var data = table.row(this).data();
                if (data) {
                    // Asumimos que el formulario tiene campos con los ids 'name' y 'dni'
                    $('#employee_id').val(data[0]);
                    $('#name').val(data[1]);
                    $('#dni').val(data[2]);
                    $('#email').val(data[3]);
                    // También puedes añadir aquí el resto de campos del formulario que quieras llenar

                    $('#modal-employeeList').modal('hide'); // Cerrar el modal
                }
            });
        });
    </script> --}}

@stop
