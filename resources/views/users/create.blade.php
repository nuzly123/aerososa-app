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
                                            <input type="text" disabled class="form-control" placeholder="Buscar Empleado">
                                            <div class="input-group-prepend">
                                                {{-- <div class="input-group-text"> --}}
                                                    <a href="" type="button" class="btn btn-block btn-default btn-sm" name="searchEmployee"
                                                        data-toggle="modal" data-target="#modal-employeeList">
                                                        <i class="fas fa-search pt-2 pr-2 pl-2 text-dark"></i>
                                                    </a>
                                                    @include('users.search_employee')
                                                {{-- </div> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11">Empleado</span>
                                                <input type="text" name="number" hidden>
                                            </div>
                                            <input type="text" class="form-control" name="dni"
                                                placeholder="Identidad" required />  
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span for="name" class="input-group-text">Usuario</span>
                                            </div>
                                            <input type="text" class="form-control" name="name" id="name"
                                                required placeholder="Nombre" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11">Contraseña</span>
                                            </div>
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                required placeholder="Apellidos" aria-describedby="basic-addon11" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="selectContrato" class="form-label">Rol</label>
                                        <select class="custom-select rounded-2" name="contract_id" required>
                                            <option value="">- Opción -</option>
                                            {{--  @foreach ($contracts as $contract)
                                                <option value="{{ $contract->id }}">{{ $contract->contract }}</option>
                                            @endforeach --}}
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
                    <input type="hidden" name="user_create" value="{{ 1 }}">
                    <input type="hidden" name="user_update" value="{{ 1 }}">
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
@stop

@section('js')
    <script src="../../resources/js/employee.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
@stop
