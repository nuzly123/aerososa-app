@extends('adminlte::page')

@section('content_header')
    <h1>Tráfico Aéreo</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registro Diario de Tráfico Aéreo</h3>
                <div class="card-tools">
                    {{-- <button type="submit" class="btn btn-sm btn-default" name="addButton" data-toggle="modal"
                    data-target="#modal-nuevo">
                    <span class="fas fa-plus"></span>
                </button> --}}
                    <a href="monitoring/create" class="btn btn-sm btn-default">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-dataTable table-striped  dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Vuelo #</th>
                            <th>Ruta</th>
                            <th>Salida</th>
                            <th>LLegada</th>
                            <th>PAX</th>
                            <th>LBS</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('.table-dataTable').dataTable();
    </script>
@stop
