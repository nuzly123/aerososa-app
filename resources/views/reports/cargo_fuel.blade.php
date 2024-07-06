@extends('adminlte::page')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-filter"></i>
                            Filtros
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>Fechas:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="txtCargo" class="form-label">Aeronave</label>
                                <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                    id="aircraft_id" required>
                                    <option value="">- Opción -</option>
                                    @foreach ($aircrafts as $aircraft)
                                        <option value="{{ $aircraft->id }}">
                                            {{ $aircraft->registration }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="txtCargo" class="form-label">No. Vuelo</label>
                                <select class="select2 form-control" style="width: 100%;" name="flight_id"
                                    id="flight_selected" required>
                                    <option value="">- Opción -</option>
                                    @foreach ($flights as $flight)
                                        <option value="{{ $flight->id }}">{{ $flight->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informe de Carga y Combustible</h3>
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
                <table id="example" class="table table-dataTable table-striped  dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center"># Vuelo</th>
                            <th class="text-center">Aeronave</th>
                            <th class="text-center">Total Pasajeros</th>
                            <th class="text-center">Total Libras</th>
                            <th class="text-center">Combustible Inicial</th>
                            <th class="text-center">Consumo</th>
                            <th class="text-center">Remanente</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($data as $employee) --}}
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
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $('.table-dataTable').dataTable({
            paging: false,
            searching: false
        });
    </script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2').select2({
                placeholder: "- Opción -",
                allowClear: true,
            });
        });
    </script>

@stop
