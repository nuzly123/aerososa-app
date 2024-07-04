@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1 class="m-0 text-dark">Aeronaves</h1>
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">Grid Aeronaves</h3>
            <div class="card-tools">
                <div class="row">
                    <div class="mr-2 mt-1">
                        @can('aircrafts.create')
                            <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                                data-target="#modal-nuevo">
                                <span class="fas fa-plus"></span>
                            </button>
                        @endcan
                    </div>
                </div>
                @include('aircrafts.create')
            </div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="row">
                        @foreach ($data as $aircraft)
                            <div class="col-sm-3 col-md-2 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-right border-bottom-0">
                                        <div class="card-tools">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-light btn-sm dropdown-toggle"
                                                    data-toggle="dropdown" data-offset="-52" aria-expanded="false">
                                                    <i class="fas fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" role="menu" style="">
                                                    @can('aircrafts.edit')
                                                        <a type="button" data-toggle="modal"
                                                            data-target="#modal-edit{{ $aircraft->id }}" class="dropdown-item">
                                                            <p class="text-left mb-0"><i class="fas fa-pen mr-3"></i>Editar</p>
                                                        </a>
                                                    @endcan
                                                    @can('reports.aircrafts.history')
                                                        <a href="#" class="dropdown-item">
                                                            <p class="text-left mb-0"><i
                                                                    class="fas fa-history mr-3"></i>Historial
                                                            </p>
                                                        </a>
                                                    @endcan
                                                    <div class="dropdown-divider"></div>
                                                    <a type="button" data-toggle="modal"
                                                        data-target="#modal-info-{{ $aircraft->id }}" class="dropdown-item">
                                                        <p class="text-left mb-0"><i
                                                                class="fas fa-info-circle mr-3"></i>Detalles</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @include('aircrafts.details')
                                    @include('aircrafts.edit')
                                    <div class="card-body pt-0">
                                        <div class="col-12 text-center mb-2">
                                            <img src="{{ asset('storage') . '/' . $aircraft->img }}" alt="aircraft-img"
                                                class="img-fluid">
                                        </div>
                                        <div class="col-12">
                                            <h2 class="lead"><b>{{ $aircraft->registration }}</b></h2>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-6 text-left text-primary">
                                                {{ $aircraft->types->type }}</small>
                                            </div>
                                            <div class="col-6 text-right">
                                                @can('aircrafts.updateStatus')
                                                    <a href="aircrafts/{{ $aircraft->id }}/update-status"
                                                        class="btn btn-{{ $aircraft->status ? 'success' : 'danger' }} btn-xs">
                                                        <span
                                                            class="fas {{ $aircraft->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
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
        </div>
    </div>
@stop

@section('js')
    <script src="../resources/js/aircraft.js"></script>
@stop
