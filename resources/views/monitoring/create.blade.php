@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1 class="m-0 text-dark">Empleados</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card mb-4"> 
                <h5 class="card-header">Nuevo Registro Tráfico Aéreo</h5>
                <form action="{{ url('/monitoring') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="txtCargo" class="form-label">Aeronave</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span for="name" class="input-group-text">Nombre</span>
                                            </div>
                                            <input type="text" class="form-control" name="name" id="name"
                                                required placeholder="Nombre" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11">Apellidos</span>
                                            </div>
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                required placeholder="Apellidos" aria-describedby="basic-addon11" />
                                        </div>
                                    </div>
                                </div>
                                <label for="nuevo-empleado">Fecha de Nacimiento</label>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <input class="form-control" type="date" name="birth" required />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Teléfono</span>
                                            </div>
                                            <input type="text" class="form-control" name="phone" required
                                                placeholder="Teléfono" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Correo</span>
                                            </div>
                                            <input type="text" class="form-control" name="email" required
                                                placeholder="Correo" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Dirección</label>
                                        <textarea class="form-control" name="address" required rows="1"></textarea>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3" id="licencia_field" style="display: none;">
                                    <label class="form-label">Número de Licencia</label>
                                    <input type="text" class="form-control" name="license_number" id="license_number">
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Fecha Ingreso</label>
                                        <input class="form-control" type="date" required name="entry_date" />
                                    </div>
                                    {{-- <div class="col-md-9">
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
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-11" align="right">
                                        <a href="{{ url('/employees') }}" class="btn btn-default">Regresar</a>
                                    </div>
                                    <div class="col-md-1" align="right">
                                        <button type="submit" class="btn btn-success" name="nuevoEmpleado">Guardar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_create" value="{{ 1 }}">
                    <input type="hidden" name="user_update" value="{{ 1 }}">
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')
    <script src="../../resources/js/employee.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2').select2({
                /* placeholder: "- Opción -", */
                allowClear: false,
                theme: "classic"
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departmentSelect = document.querySelector('select[name="department_id"]');
            licenseField = document.getElementById('licencia_field');
            licenseNumnberField = document.getElementById('license_number');
            //license_number
            departmentSelect.addEventListener('change', function() {
                if (departmentSelect.value === '3') {
                    licenseField.style.display = 'block';

                    /* officeField.style.display = 'none';
                    officeField.value = '0'; */
                } else {
                    licenseNumnberField.value = '';
                    licenseField.style.display = 'none';
                    /* licenseField.value = '';
                    officeField.style.display = 'block'; */
                }
            });
        });
    </script>
@stop
