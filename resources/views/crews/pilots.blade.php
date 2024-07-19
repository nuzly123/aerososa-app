@extends('adminlte::page')

@section('title', 'Monitoreo | Pilotos')

@section('content_header')
    <h1 class="m-0 text-dark">Tripulación</h1>
@stop

@section('content')
    <div class="card card-solid card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Grid de Pilotos</h3>
        </div>
        <div class="card-body pb-0">
            <div class="row mt-4">
                @foreach ($pilots as $crew)
                    <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                        <div class="card bg-light flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        @can('crews.addLicense')
                                            <a type="button" data-toggle="modal"
                                                data-target="#modal-licencia{{ $crew->id }}" class="dropdown-item">
                                                <i class="fas fa-pen mr-3"></i>Licencia
                                            </a>
                                        @endcan
                                        {{-- @can('crews.addTypeRating')
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-user-check mr-3"></i>Habilitaciones
                                            </a>
                                        @endcan --}}
                                        {{-- @can('reports.crews.history')
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-history mr-3"></i>Historial
                                            </a>
                                        @endcan --}}
                                        <div class="dropdown-divider"></div>
                                        @can('employees.profile')
                                            <a href="employees/{{ $crew->id }}/profile" class="dropdown-item">
                                                <i class="fas fa-info-circle mr-3"></i>Perfil
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            @include('crews.add_license')
                            <div class="card-body pt-0 text-center">
                                <div class="img-container mb-2">
                                    <img src="{{ asset('storage/' . $crew->photo) }}" alt="user-avatar" class="img-fluid">
                                </div>
                                <p class="lead"><b>{{ $crew->name . ' ' . $crew->last_name }}</b></p>
                                <p class="text-muted text-sm">
                                    @foreach ($licenses as $license)
                                        @if ($crew->id == $license->employee_id)
                                            <i class="fas fa-fw fa-id-badge"></i><strong>Licencia:</strong>
                                            {{ $license->license }} <br>
                                        @endif
                                    @endforeach
                                    @if ($crew->last_activity)
                                        <i class="fas fa-fw fa-history"></i><strong>Último Vuelo:</strong>
                                        {{ $crew->last_activity->flight_route }} <br>
                                        <i class="fas fa-fw fa-calendar-alt"></i><strong>Fecha:</strong>
                                        {{ $crew->last_activity->flight_date }}
                                    @else
                                        Sin actividad de vuelo registrada.
                                    @endif
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-8 text-left">
                                        @foreach ($crew->positions as $index => $position_detail)
                                            <small class="text-primary">
                                                @foreach ($positions as $position)
                                                    @if ($position_detail->positions->position == $position)
                                                        {{ $position_detail->positions->position }}
                                                        @if ($index < $crew->positions->count() - 1)
                                                            ,
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </small>
                                        @endforeach
                                    </div>
                                    <div class="col-4 text-right">
                                        @can('crews.updateStatus')
                                            <a href="employees/{{ $crew->id }}/update-status"
                                                class="btn btn-{{ $crew->status ? 'success' : 'danger' }} btn-xs">
                                                <span
                                                    class="fas {{ $crew->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="../resources/css/employee.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('status'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('status') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        });
    </script>
@stop
