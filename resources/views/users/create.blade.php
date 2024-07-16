@extends('adminlte::page')

@php
    use Illuminate\Support\Facades\Auth;
@endphp
@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Usuarios</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Nuevo Usuario</h5>
                <form id="userForm" action="{{ url('/users') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Empleado</label>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" readonly
                                                class="form-control" placeholder="Seleccionar Empleado" required>
                                            <input type="hidden" id="dni" name="dni">
                                            <div class="input-group-prepend">
                                                <a href="" type="button" class="btn btn-block btn-default btn-sm"
                                                    name="searchEmployee" data-toggle="modal"
                                                    data-target="#modal-employeeList">
                                                    <i class="fas fa-search pt-2 pr-2 pl-2 text-dark"></i>
                                                </a>
                                                @include('users.search_employee')
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Correo</label>
                                        <input type="email" class="form-control" id="email" name="email" required
                                            readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nombre de Usuario <code>*</code></label>
                                            <input type="text" name="username" required class="form-control"
                                                id="user" placeholder="Usuario">
                                            <span id="username-error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contraseña <code>*</code></label>
                                            <input type="password" name="password" required class="form-control"
                                                id="password" placeholder="********">
                                            <span id="password-error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Repetir Contraseña <code>*</code></label>
                                            <input type="password" required class="form-control" name="repetir"
                                                id="validate_password" placeholder="********">
                                            <span id="repeat-password-error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="selectRole" class="form-label">Rol <code>*</code></label>
                                        <select class="custom-select rounded-2" name="role">
                                            <option value="0">- Opción -</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="employee_id" name="employee_id">
                                <input type="hidden" name="user_create" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="user_update" value="{{ Auth::user()->id }}">
                                <div class="col-md-12" align="right">
                                    <button type="submit" class="btn btn-success" name="nuevoEmpleado">Guardar</button>
                                </div>
                            </div>
                        </div>
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
    <script>
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
    </script>

    <script>
        $(document).ready(function() {
            function checkFormValidity() {
                let isValid = true;
                if ($('#username-error').text() !== '' || $('#password-error').text() !== '' || $(
                        '#repeat-password-error').text() !== '') {
                    isValid = false;
                }
                $('button[name="nuevoEmpleado"]').attr('disabled', !isValid);
            }

            $('#user').on('blur', function() {
                let username = $(this).val();
                if (username.length > 0) {
                    $.ajax({
                        url: '{{ route('admin.username.check') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            username: username
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#username-error').text(
                                    'El nombre de usuario ya está en uso.');
                            } else {
                                $('#username-error').text('');
                            }
                            checkFormValidity();
                        }
                    });
                }
            });

            $('#password, #validate_password').on('keyup', function() {
                let password = $('#password').val();
                let repeatPassword = $('#validate_password').val();

                if (password.length < 8 || !/[!@#$%^&*(),.?":{}|<>]/g.test(password)) {
                    $('#password-error').text(
                        'La contraseña debe tener al menos 8 caracteres y un carácter especial.');
                } else {
                    $('#password-error').text('');
                }

                if (password !== repeatPassword) {
                    $('#repeat-password-error').text('Las contraseñas no coinciden.');
                } else {
                    $('#repeat-password-error').text('');
                }
                checkFormValidity();
            });

            $('#userForm').on('submit', function(e) {
                if ($('#username-error').text() !== '' || $('#password-error').text() !== '' || $(
                        '#repeat-password-error').text() !== '') {
                    e.preventDefault();
                }
            });

            checkFormValidity();
        });
    </script>

@stop
