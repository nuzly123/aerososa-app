@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1 class="m-0 text-dark">Empleados</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Nuevo Empleado</h5>
                <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    {{-- @method('PUT') --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">DNI</span>
                                                <input type="text" name="number" hidden>
                                            </div>
                                            <input type="text" class="form-control" name="dni"
                                                placeholder="Identidad" value="{{ $employee->dni }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span for="name" class="input-group-text">Nombre</span>
                                            </div>
                                            <input type="text" class="form-control" name="name" id="name"
                                                required placeholder="Nombre" value="{{ $employee->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11">Apellidos</span>
                                            </div>
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                required placeholder="Apellidos" aria-describedby="basic-addon11"
                                                value="{{ $employee->last_name }}" />
                                        </div>
                                    </div>
                                </div>
                                <label for="nuevo-empleado">Fecha de Nacimiento</label>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <input class="form-control" type="date" name="birth" required
                                            value="{{ date('Y-m-d', strtotime($employee->birth)) }}" />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Teléfono</span>
                                            </div>
                                            <input type="text" class="form-control" name="phone" required
                                                placeholder="Teléfono" value="{{ $employee->phone }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Correo</span>
                                            </div>
                                            <input type="text" class="form-control" name="email" required
                                                placeholder="Correo" value="{{ $employee->email }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Dirección</label>
                                        <textarea class="form-control" name="address" required rows="1">{{ $employee->address }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-3">
                                        <label for="selectContrato" class="form-label">Tipo Contrato</label>
                                        <select class="custom-select rounded-2" name="contract_id" required>
                                            <option value="">- Opción -</option>
                                            @foreach ($contracts as $contract)
                                                <option value="{{ $contract->id }}"
                                                    {{ $employee->contract_id == $contract->id ? 'selected' : '' }}>
                                                    {{ $contract->contract }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="txtCargo" class="form-label">Cargo</label>
                                            <input type="text" class="form-control" required name="position"
                                                id="position" placeholder="Cargo" value="{{ $employee->position }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Departamento</label>
                                        <select class="custom-select rounded-2" name="department_id" required>
                                            <option value="">- Opción -</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                                    {{ $department->department }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Oficina</label>
                                        <select class="custom-select rounded-2" name="office_id" required>
                                            <option value="">- Opción -</option>
                                            @foreach ($offices as $office)
                                                <option value="{{ $office->id }}"
                                                    {{ $employee->office_id == $office->id ? 'selected' : '' }}>
                                                    {{ $office->office }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Fecha Ingreso</label>
                                        <input class="form-control" type="date" required name="entry_date"
                                            value="{{ date('Y-m-d', strtotime($employee->entry_date)) }}" />
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Fotografía</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="photo" id="photo" onchange="updateFileName()">
                                                    <label class="custom-file-label" for="photo" id="photoName">Seleccionar</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <label class="form-label">Ciudad</label>
                                        <select class="custom-select rounded-2" name="city_id" required>
                                            <option value="">- Opción -</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ $employee->city_id == $city->id ? 'selected' : '' }}>
                                                    {{ $city->city }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-11" align="right">
                                            <a href="{{ url('/employees') }}" class="btn btn-default">Regresar</a>
                                        </div>
                                        <div class="col-md-1" align="right">
                                            <button type="submit" class="btn btn-success"
                                                name="nuevoEmpleado">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_update" value="{{ Auth::user()->id }}">
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
@stop

@section('js')
    <script src="../../../resources/js/employee.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
@stop
