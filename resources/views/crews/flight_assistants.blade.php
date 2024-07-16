@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1 class="m-0 text-dark">Tripulación</h1>
@stop

@section('content')
    <div class="card card-solid card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Grid de Tripulantes de Cabina</h3>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="row">
                        @foreach ($flight_assistants as $crew)
                            <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                                <div class="card bg-light flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        <div class="card-tools">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-light btn-sm dropdown-toggle"
                                                    data-toggle="dropdown" data-offset="-52" aria-expanded="false">
                                                    <i class="fas fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" role="menu" style="">
                                                    {{-- @can('crews.addTypeRating')
                                                        <a href="#" class="dropdown-item">
                                                            <p class="text-left mb-0"><i
                                                                    class="fas fa-user-check mr-3"></i>Habilitaciones
                                                            </p>
                                                        </a>
                                                    @endcan --}}
                                                    {{-- @can('reports.crews.history')
                                                        <a href="#" class="dropdown-item">
                                                            <p class="text-left mb-0"><i
                                                                    class="fas fa-history mr-3"></i>Historial
                                                            </p>
                                                        </a>
                                                    @endcan --}}
                                                    <div class="dropdown-divider"></div>
                                                    @can('employees.profile')
                                                        <a href="employees/{{ $crew->id }}/profile" class="dropdown-item">
                                                            <p class="text-left mb-0"><i
                                                                    class="fas fa-info-circle mr-3"></i>Perfil</p>
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12 text-center mb-2">
                                                <div class="img-container">
                                                    <img src="{{ asset('storage') . '/' . $crew->photo }}"
                                                        alt="employee-photo" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <p>
                                                    {{ $crew->name . ' ' . $crew->last_name }}
                                                </p>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="text-muted text-sm">
                                                    @foreach ($licenses as $license)
                                                        @if ($crew->id == $license->employee_id)
                                                            <i class="fas fa-fw fa-id-badge"></i><strong>Licencia:</strong>
                                                            {{ $license->license }}
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-8 text-left">
                                                @foreach ($crew->positions as $index => $position_detail)
                                                    {{-- {{ $position_detail->positions->position }}
                                                @if ($index < $crew->positions->count() - 1)
                                                    ,
                                                @endif --}}
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
                                            <div class="col-md-4 text-right">
                                                @can('crews.updateStatus')
                                                    <a href="employees/{{ $crew->id }}/update-status"
                                                        class="btn btn-{{ $crew->status ? 'success' : 'danger' }} btn-xs">
                                                        <span
                                                            class="fas {{ $crew->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                                    </a>
                                                @endcan
                                            </div>
                                            {{--  <div class="text-right">
                                                <a href="#" class="btn btn-xs bg-teal">
                                                    <i class="fas fa-history"></i>
                                                </a>
                                                <a href="#" class="btn btn-xs btn-primary">
                                                    <i class="fas fa-user"></i> Ver Perfil
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="../resources/css/employee.css">
@stop
