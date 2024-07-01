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
                    <div class="mr-2">
                        {{-- <div class="float-right">
                            <select class="custom-select" style="width: auto;" data-sortorder="">
                                <option value="index"> Ordenar por Nombre </option>
                                <option value="sortData"> Ordenar Fecha de ingreso </option>
                            </select>
                            <div class="btn-group">
                                <a class="btn btn-default" href="javascript:void(0)" data-sortasc=""> Ascendente </a>
                                <a class="btn btn-default" href="javascript:void(0)" data-sortdesc=""> Descendente </a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="mr-2 mt-1">
                        <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                            data-target="#modal-nuevo">
                            <span class="fas fa-plus"></span>
                        </button>
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
                                                    <a type="button" data-toggle="modal"
                                                        data-target="#modal-edit{{ $aircraft->id }}" class="dropdown-item">
                                                        <p class="text-left mb-0"><i class="fas fa-pen mr-3"></i>Editar</p>
                                                    </a>
                                                    {{-- <button type="submit" class="btn">
                                                        <p class="text-left mb-0"><i class="fas fa-pen mr-3"></i>Editar</p>
                                                    </button> --}}
                                                    {{--  <a class="dropdown-item">
                                                        <p class="text-left mb-0"><i
                                                                class="fas fa-info-circle mr-3"></i>Detalles</p>
                                                    </a> --}}
                                                    <a type="button" data-toggle="modal"
                                                        data-target="#modal-detalle-{{ $aircraft->id }}"
                                                        class="dropdown-item">
                                                        <p class="text-left mb-0"><i
                                                                class="fas fa-history mr-3"></i>Historial</p>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item">
                                                        <p class="text-left mb-0"><i class="fas fa-info-circle mr-3"></i>Detalles
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    @include('aircrafts.edit')
                                    <div class="card-body pt-0">
                                        <div class="col-12 text-center mb-2">
                                            <img src="{{ asset('storage') . '/' . $aircraft->img }}" alt="aircraft-img"
                                                class="img-fluid">
                                        </div>
                                        <div class="col-12">

                                            <h2 class="lead"><b>{{ $aircraft->registration }}</b></h2>
                                            {{-- <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic
                                                Artist / Coffee Lover </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i
                                                            class="fas fa-lg fa-building"></i></span> Address: Demo
                                                    Street 123, Demo City 04312, NJ</li>
                                                <li class="small"><span class="fa-li"><i
                                                            class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12
                                                    12 23 52</li>
                                            </ul> --}}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                {{-- <a href="aircraft_types"> --}}<small
                                                        class="">{{ $aircraft->types->type }}</small>{{-- </a> --}}
                                                {{-- <a href="#" class="btn btn-sm bg-teal btn-success">
                                                    <i class="fas fa-gas-pump"></i> GASEO
                                                </a> --}}
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="aircrafts/{{ $aircraft->id }}/update-status"
                                                    class="btn btn-{{ $aircraft->status ? 'success' : 'danger' }} btn-xs">
                                                    <span
                                                        class="fas {{ $aircraft->status ? 'fa-toggle-on fa-flip-horizontal' : 'fa-toggle-on' }}"></span>
                                                </a>
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
