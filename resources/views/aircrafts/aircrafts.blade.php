@extends('adminlte::page')

@section('content_header')
    <h1>Aeronaves</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
           {{--  <h3 class="card-title">Lista Aeronaves</h3> --}}
            <div class="card-tools">
                {{-- <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                    data-target="#modal-nuevo">
                    <span class="fas fa-plus"></span>
                </button> --}}
                <a href="employees/create" class="btn btn-sm btn-default">
                    <span class="fas fa-plus"></span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($data as $aircraft)
                    <div class="col-sm-3 col-md-2 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body {{-- pt-0 --}}">
                                <div class="col-12 text-center">
                                    <img src="{{ asset('storage') . '/' . $aircraft->photo }}" alt="user-avatar"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="card-header text-muted border-bottom-0 text-center pt-0">
                                {{$aircraft->type}}
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    {{ $aircraft->registration}}
                                    <a href="#" class="btn btn-xs btn-primary">
                                        <i class="fas fa-user"></i> Detalles
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
@stop
