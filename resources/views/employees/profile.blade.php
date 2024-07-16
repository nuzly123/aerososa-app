@extends('adminlte::page')

@section('content_header')
    <h1>Perfil Empleado</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- IMAGEN y ACTUALIZAR -->
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                style="object-fit: cover; width: 150px; height: 150px;"
                                src="{{ asset('storage') . '/' . $employee->photo }}" alt="foto-perfil">
                        </div>
                        <h3 class="profile-username text-center">{{ $employee->name . ' ' . $employee->last_name }}</h3>
                        <p class="text-muted text-center">{{ $employee->position }}</p>
                        <button class="btn btn-primary btn-block" id="update-photo-btn"><b>Actualizar foto</b></button>
                        <br>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Oficina</b> <a class="float-right">{{ $employee->offices->office }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Departamento</b> <a class="float-right">{{ $employee->departments->department }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Cumpleaños</b> <a
                                    class="float-right">{{ date('Y-m-d', strtotime($employee->birth)) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- DETALLES -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detalles del Empleado</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Datos Personales</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush mb-4">
                                            <li class="list-group-item">
                                                <b>Correo electrónico:</b> {{ $employee->email }}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Teléfono:</b> {{ $employee->phone }}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Dirección:</b> {{ $employee->address }}
                                            </li>
                                            <li class="list-group-item">
                                                <b>Fecha de Ingreso:</b>
                                                {{ date('Y-m-d', strtotime($employee->entry_date)) }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <h5>Información Adicional</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <b>Cargo(s):</b>
                                        @foreach ($employee->positions as $position)
                                            {{ $position->positions->position }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tipo de Contrato:</b> {{ $employee->contracts->contract }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">
                            <i class="fas fa-fw fa-edit"></i> Editar Empleado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('employees.updateImgForm')


@stop

@section('css')
    <link rel="stylesheet" href="../../../resources/css/employee.css">
@stop

@section('js')
    <script src="../../../resources/js/employee.js"></script>
    <script>
        document.getElementById('update-photo-btn').addEventListener('click', function() {
            $('#updatePhotoModal').modal('show');
        });

        $('#update-photo-form').on('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('employees.update-photo', $employee->id) }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('#updatePhotoModal').modal('hide');
                        location.reload(); // Recargar la página para mostrar la nueva foto
                    } else {
                        alert('Error al actualizar la foto');
                    }
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error,
                    });
                }
            });
        });
    </script>
@stop
