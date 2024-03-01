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
                        <div class="float-right">
                            <select class="custom-select" style="width: auto;" data-sortorder="">
                                <option value="index"> Ordenar por Nombre </option>
                                <option value="sortData"> Ordenar Fecha de ingreso </option>
                            </select>
                            <div class="btn-group">
                                <a class="btn btn-default" href="javascript:void(0)" data-sortasc=""> Ascendente </a>
                                <a class="btn btn-default" href="javascript:void(0)" data-sortdesc=""> Descendente </a>
                            </div>
                        </div>
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
                                    <div class="card-body {{-- pt-0 --}}">
                                        <div class="col-12 text-center">
                                            <img src="{{ asset('storage') . '/' . $aircraft->img }}" alt="aircraft-img"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="card-header text-muted border-bottom-0 text-center pt-0">
                                        {{ $aircraft->types->type}}
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="#" class="btn btn-xs bg-teal">
                                                <i class="fas fa-history"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-primary">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-warning">
                                                <i class="fas fa-pen"></i>
                                            </a>
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
