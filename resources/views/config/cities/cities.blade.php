@extends('adminlte::page')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
           <h3 class="card-title">Ciudades</h3>
            <div class="card-tools">
                <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal" data-target="#modal-newUser">
                    <span class="fas fa-plus"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
        </div>
    </div>
</div>
@stop


