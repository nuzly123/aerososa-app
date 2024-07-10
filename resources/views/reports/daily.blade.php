@extends('adminlte::page')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary {{-- card-outline --}}">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-filter"></i>
                            Filtros
                        </h2>
                        <div class="card-tools">
                            {{--  <div class="card-footer"> --}}
                            <button type="submit" class="btn btn-warning float-right"><i
                                    class="fas fa-fw fa-search"></i>Generar</button>
                            {{--  </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="fecha_actual" class="form-label">Fecha del Vuelo</label>
                                <input type="date" class="form-control" name="flight_date" id="fecha_actual"
                                    value="" required>
                            </div>
                            <div class="col-md-4 mb-3">
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
                            <div class="col-md-4 mb-3">
                                <label for="txtCargo" class="form-label">Ruta</label>
                                <select class="select2 form-control" style="width: 100%;" name="flight_route_id"
                                    id="flight_route_id">
                                    <option value="">- Opción -</option>
                                    @foreach ($flight_routes as $flight_route)
                                        <option value="{{ $flight_route->id }}">{{ $flight_route->route }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="txtCargo" class="form-label">Capitán</label>
                                <select class="select2 form-control" style="width: 100%;" name="captain" id="captain">
                                    <option value="">- Opción -</option>
                                    @foreach ($crew_members['capitan'] as $captain)
                                        <option value="{{ $captain->id }}">{{ $captain->name . ' ' . $captain->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="txtCargo" class="form-label">Primer Oficial</label>
                                <select class="select2 form-control" style="width: 100%;" name="first_official"
                                    id="first_official">
                                    <option value="">- Opción -</option>
                                    @foreach ($crew_members['primer_oficial'] as $first_official)
                                        <option value="{{ $first_official->id }}">
                                            {{ $first_official->name . ' ' . $first_official->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="txtCargo" class="form-label">Tripulante de Cabina</label>
                                <select class="select2 form-control" style="width: 100%;" name="flight_assistant"
                                    id="flight_assistant" required>
                                    <option value="">- Opción -</option>
                                    @foreach ($crew_members['tripulante_cabina'] as $flight_assistant)
                                        <option value="{{ $flight_assistant->id }}">
                                            {{ $flight_assistant->name . ' ' . $flight_assistant->last_name }}</option>
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
                <h3 class="card-title">Reporte Diario</h3>
                {{-- <div class="card-tools">
                    <a href="employees/create" class="btn btn-sm btn-default">
                        <span class="fas fa-plus"></span>
                    </a>
                </div> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Aeronave</th>
                                <th class="text-center"># Vuelo</th>
                                <th class="text-center">Ruta</th>
                                <th class="text-center">Salida</th>
                                <th class="text-center">Llegada</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">PX</th>
                                <th class="text-center">DH</th>
                                <th class="text-center">INF</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Aeropuerto</th>
                                <th class="text-center">Gaseo</th>
                                <th class="text-center">Inicial</th>
                                <th class="text-center">Remanente</th>
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
                                <td></td>
                                <td></td>
                                <td></td>
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
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css"> --}}
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../resources/css/reports.css">
@stop

@section('js')
    {{-- <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="//cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../resources/js/reports.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.js"></script>

    {{--  <script>
        $('.table-dataTable').dataTable({
            paging: false,
            searching: false
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2').select2({
                placeholder: "Seleccione",
                allowClear: true,
            });
        });
    </script>

@stop
