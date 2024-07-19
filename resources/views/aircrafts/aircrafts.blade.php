@extends('adminlte::page')

@section('title', 'Monitoreo | Aeronaves')

@section('content_header')
    <h1 class="m-0 text-dark">Aeronaves</h1>
@stop

@section('content')
    <div class="card card-danger card-outline">
        <div class="card-header">
            <h3 class="card-title">Grid Aeronaves</h3>
            <div class="card-tools">
                @can('aircrafts.create')
                    <button type="submit" class="btn btn-primary" name="addButton" data-toggle="modal"
                        data-target="#modal-nuevo">
                        <span class="fas fa-plus"></span> Nuevo
                    </button>
                @endcan
                @include('aircrafts.create')
            </div>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success" id="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="card-body pb-0">
            <div class="row mt-4">
                @foreach ($data as $aircraft)
                    <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                        <div class="card bg-light flex-fill">
                            <div class="card-header text-right border-bottom-0">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        @can('aircrafts.edit')
                                            <a type="button" data-toggle="modal" data-target="#modal-edit{{ $aircraft->id }}"
                                                class="dropdown-item">
                                                <i class="fas fa-pen mr-3"></i>Editar
                                            </a>
                                        @endcan
                                        {{-- @can('reports.aircrafts.history')
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-history mr-3"></i>Historial
                                            </a>
                                        @endcan --}}
                                        <div class="dropdown-divider"></div>
                                        <a type="button" data-toggle="modal" data-target="#modal-info-{{ $aircraft->id }}"
                                            class="dropdown-item">
                                            <i class="fas fa-info-circle mr-3"></i>Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @include('aircrafts.details')
                            @include('aircrafts.edit')

                            <div class="card-body pt-0 text-center">
                                <div class="img-container mb-2">
                                    <img src="{{ asset('storage') . '/' . $aircraft->img }}" alt="aircraft-img"
                                        class="img-fluid">
                                </div>
                                <h2 class="lead"><b>{{ $aircraft->registration }}</b></h2>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-6 text-left text-primary">
                                        {{ $aircraft->types->type }}
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
@stop


@section('css')
    <link rel="stylesheet" href="../resources/css/aircraft.css">
@stop

@section('js')
    <script src="{{ asset('js/aircraft.js') }}"></script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('#alert').fadeOut('slow');
            }, 2000);
        });
    </script>
@stop
