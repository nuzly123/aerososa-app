@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Usuarios</h1>
@stop

@section('content')
    {{-- formulario usuario --}}
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Nuevo Usuario</h5>
                <form action="{{ url('/users') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" id="name" readonly class="form-control"
                                                placeholder="Seleccionar Empleado" required>
                                            <input type="hidden" name="dni">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        {{-- <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span for="name" class="input-group-text">Usuario</span>
                                            </div>
                                            <input type="text" class="form-control" name="user" id="user"
                                                required placeholder="Usuario" />
                                        </div> --}}
                                        <div class="form-group">
                                            <label>Nombre de Usuario <code>*</code></label>
                                            <input type="text" name="user" required class="form-control"
                                                id="user" placeholder="Usuario">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        {{-- <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11">Contraseña</span>
                                            </div>
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                required placeholder="Contraseña" aria-describedby="basic-addon11" />
                                        </div> --}}
                                        <div class="form-group">
                                            <label>Contraseña <code>*</code></label>
                                            <input type="text" name="password" required class="form-control"
                                                id="password" placeholder="********">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Repetir Contraseña <code>*</code></label>
                                            <input type="text" required class="form-control"
                                                id="validate_password" placeholder="********">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="selectContrato" class="form-label">Rol <code>*</code></label>
                                        <select class="custom-select rounded-2" name="contract_id" required>
                                            <option value="">- Opción -</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Fotografía</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="photo"
                                                        id="photo" onchange="updateFileName()">
                                                    <label class="custom-file-label" for="photo"
                                                        id="photoName">Seleccionar</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" align="right">
                                    <button type="submit" class="btn btn-success" name="nuevoEmpleado">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_create" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="user_update" value="{{ Auth::user()->id }}">
                </form>
            </div>
        </div>
    </div>
@stop

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
                                    table.row.add([
                                        result.name,
                                        result.dni,
                                        result.email,
                                        result.has_user ? '1' : '0'
                                    ]).draw().node();

                                    if (result.has_user) {
                                        $(row).addClass('user-exists');
                                    }
                                });
                            } else {
                                table.row.add([
                                    'No se encontraron resultados',
                                    '',
                                    ''
                                ]).draw();
                            }
                        }
                    });
                } else {
                    table.clear().draw();
                }
            });

            var clickTimeout;

            if ($(this).hasClass('user-exists')) {
                alert('Este empleado ya tiene un usuario y no puede ser seleccionado.');
                return; // Prevenir selección si el empleado ya tiene usuario
            }


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

                // Resaltar la fila con doble clic y seleccionar
                if (!row.hasClass('selected')) {
                    table.$('tr.selected').removeClass('selected');
                    row.addClass('selected');
                }

                var data = table.row(this).data();
                if (data) {
                    // Asumimos que el formulario tiene campos con los ids 'name' y 'last_name'
                    $('#name').val(data[0]);
                    $('#dni').val(data[1]);
                    // También puedes añadir aquí el resto de campos del formulario que quieras llenar

                    $('#modal-employeeList').modal('hide'); // Cerrar el modal
                }
            });
        });
    </script> --}}
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
                                    ''
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
                    $('#name').val(data[0]);
                    $('#dni').val(data[1]);
                    // También puedes añadir aquí el resto de campos del formulario que quieras llenar

                    $('#modal-employeeList').modal('hide'); // Cerrar el modal
                }
            });
        });
    </script>

@stop
