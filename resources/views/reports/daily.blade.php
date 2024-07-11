@extends('adminlte::page')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                {{-- MONITOREO --}}
                <h5 class="mt-4 mb-2">Módulo de Monitoreo</h5>
                {{-- REPORTE DE TRAFICO AEREO --}}
                <div class="card card-primary collapsed-card shadow">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Reporte de Tráfico Aéreo
                        </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Este reporte genera un documento de excel con los datos de Tráfico Aéreo, aplique los filtros
                            necesarios:</p>
                        <form id="airTraffic_report">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_actual" class="form-label">Fecha del Vuelo</label>
                                    <input type="date" class="form-control" name="flight_date" id="fecha_actual"
                                        value="">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">Aeronave</label>
                                    <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                        id="aircraft_id">
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
                                    <select class="select2 form-control" style="width: 100%;" name="flight_route"
                                        id="flight_route">
                                        <option value="">- Opción -</option>
                                        @foreach ($flight_routes as $flight_route)
                                            <option value="{{ $flight_route->route }}">{{ $flight_route->route }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">Capitán</label>
                                    <select class="select2 form-control" style="width: 100%;" name="captain_id"
                                        id="captain">
                                        <option value="">- Opción -</option>
                                        @foreach ($crew_members['capitan'] as $captain)
                                            <option value="{{ $captain->id }}">
                                                {{ $captain->name . ' ' . $captain->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">Primer Oficial</label>
                                    <select class="select2 form-control" style="width: 100%;" name="first_official_id"
                                        id="first_official">
                                        <option value="">- Opción -</option>
                                        @foreach ($crew_members['primer_oficial'] as $first_official)
                                            <option value="{{ $first_official->id }}">
                                                {{ $first_official->name . ' ' . $first_official->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right" id="exportButton"><i
                                class="fas fa-fw fa-file-excel"></i>Excel</button>
                    </div>
                    </form>
                </div>
                {{-- REPORTE DE VUELO --}}
                <div class="card card-primary collapsed-card shadow}">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Reporte de Vuelo
                        </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Este reporte muestra los detalles de un vuelo específico, seleccione el código de vuelo y la
                            fecha que busca:</p>
                        <form id="flight_report">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">No. Vuelo</label>
                                    <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                        id="aircraft_id">
                                        <option value="">- Opción -</option>
                                        @foreach ($flights as $flight)
                                            <option value="{{ $flight->id }}">
                                                {{ $flight->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_actual" class="form-label">Fecha del Vuelo</label>
                                    <input type="date" class="form-control" name="flight_date" id="fecha_actual"
                                        value="">
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group float-right">
                            <button type="submit" class="btn btn-danger" id="exportButton"><i
                                    class="fas fa-fw fa-file-pdf"></i>PDF</button>
                            <button type="submit" class="btn btn-secondary" id="exportButton"><i
                                    class="fas fa-fw fa-print"></i>Imprimir</button>
                        </div>
                    </div>
                    </form>
                </div>

                {{-- AERONAVES --}}
                <h5 class="mt-4 mb-2">Módulo de Aeronaves</h5>
                {{-- REPORTE DE MOVIMIENTOS DE AERONAVE --}}
                <div class="card card-primary collapsed-card shadow}">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Reporte de Movimientos
                        </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Instrucciones</p>
                        <form id="aircraft_report">
                            <div class="row">
                                {{-- <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">No. Vuelo</label>
                                    <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                        id="aircraft_id">
                                        <option value="">- Opción -</option>
                                        @foreach ($flights as $flight)
                                            <option value="{{ $flight->id }}">
                                                {{ $flight->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_actual" class="form-label">Fecha del Vuelo</label>
                                    <input type="date" class="form-control" name="flight_date" id="fecha_actual"
                                        value="">
                                </div> --}}
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group float-right">
                            <button type="submit" class="btn btn-danger" id="exportButton"><i
                                    class="fas fa-fw fa-file-pdf"></i>PDF</button>
                            <button type="submit" class="btn btn-success" id="exportButton"><i
                                    class="fas fa-fw fa-file-excel"></i>Excel</button>
                            <button type="submit" class="btn btn-secondary" id="exportButton"><i
                                    class="fas fa-fw fa-print"></i>Imprimir</button>
                        </div>
                    </div>
                    </form>
                </div>
                {{-- REPORTE DE GASEOS --}}
                <div class="card card-primary collapsed-card shadow}">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Reporte de Gaseos
                        </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Instrucciones</p>
                        <form id="aircraft_report">
                            <div class="row">
                                {{-- <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">No. Vuelo</label>
                                    <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                        id="aircraft_id">
                                        <option value="">- Opción -</option>
                                        @foreach ($flights as $flight)
                                            <option value="{{ $flight->id }}">
                                                {{ $flight->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_actual" class="form-label">Fecha del Vuelo</label>
                                    <input type="date" class="form-control" name="flight_date" id="fecha_actual"
                                        value="">
                                </div> --}}
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group float-right">
                            <button type="submit" class="btn btn-danger" id="exportButton"><i
                                    class="fas fa-fw fa-file-pdf"></i>PDF</button>
                            <button type="submit" class="btn btn-success" id="exportButton"><i
                                    class="fas fa-fw fa-file-excel"></i>Excel</button>
                            <button type="submit" class="btn btn-secondary" id="exportButton"><i
                                    class="fas fa-fw fa-print"></i>Imprimir</button>
                        </div>
                    </div>
                    </form>
                </div>


                {{-- TRIPULACION --}}
                <h5 class="mt-4 mb-2">Módulo de Tripulación</h5>
                {{-- REPORTE DE MOVIMIENTOS DE PILOTOS --}}
                <div class="card card-primary collapsed-card shadow}">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Reporte de Movimientos
                        </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Instrucciones</p>
                        <form id="crew_history_report">
                            {{-- <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">No. Vuelo</label>
                                    <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                        id="aircraft_id">
                                        <option value="">- Opción -</option>
                                        @foreach ($flights as $flight)
                                            <option value="{{ $flight->id }}">
                                                {{ $flight->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_actual" class="form-label">Fecha del Vuelo</label>
                                    <input type="date" class="form-control" name="flight_date" id="fecha_actual"
                                        value="">
                                </div>
                            </div> --}}
                    </div>
                    <div class="card-footer">
                        <div class="btn-group float-right">
                            <button type="submit" class="btn btn-danger" id="exportButton"><i
                                    class="fas fa-fw fa-file-pdf"></i>PDF</button>
                            <button type="submit" class="btn btn-success" id="exportButton"><i
                                    class="fas fa-fw fa-file-excel"></i>Excel</button>
                            <button type="submit" class="btn btn-secondary" id="exportButton"><i
                                    class="fas fa-fw fa-print"></i>Imprimir</button>
                        </div>
                    </div>
                    </form>
                </div>
                {{-- REPORTE DE HORAS ACUMULADAS POR PILOTO --}}
                <div class="card card-primary collapsed-card shadow}">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Reporte de Horas Acumuladas
                        </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Instrucciones</p>
                        <form id="crew_flight_time_report">
                            {{-- <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">No. Vuelo</label>
                                    <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                        id="aircraft_id">
                                        <option value="">- Opción -</option>
                                        @foreach ($flights as $flight)
                                            <option value="{{ $flight->id }}">
                                                {{ $flight->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_actual" class="form-label">Fecha del Vuelo</label>
                                    <input type="date" class="form-control" name="flight_date" id="fecha_actual"
                                        value="">
                                </div>
                            </div> --}}
                    </div>
                    <div class="card-footer">
                        <div class="btn-group float-right">
                            <button type="submit" class="btn btn-danger" id="exportButton"><i
                                    class="fas fa-fw fa-file-pdf"></i>PDF</button>
                            <button type="submit" class="btn btn-success" id="exportButton"><i
                                    class="fas fa-fw fa-file-excel"></i>Excel</button>
                            <button type="submit" class="btn btn-secondary" id="exportButton"><i
                                    class="fas fa-fw fa-print"></i>Imprimir</button>
                        </div>
                    </div>
                    </form>
                </div>
                {{-- REPORTE DE PIERNAS VOLADAS POR PILOTO --}}
                <div class="card card-primary collapsed-card shadow}">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Reporte de Piernas Voladas
                        </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Instrucciones</p>
                        <form id="crew_flight_legs_report">
                            {{-- <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="txtCargo" class="form-label">No. Vuelo</label>
                                    <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                        id="aircraft_id">
                                        <option value="">- Opción -</option>
                                        @foreach ($flights as $flight)
                                            <option value="{{ $flight->id }}">
                                                {{ $flight->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_actual" class="form-label">Fecha del Vuelo</label>
                                    <input type="date" class="form-control" name="flight_date" id="fecha_actual"
                                        value="">
                                </div>
                            </div> --}}
                    </div>
                    <div class="card-footer">
                        <div class="btn-group float-right">
                            <button type="submit" class="btn btn-danger" id="exportButton"><i
                                    class="fas fa-fw fa-file-pdf"></i>Exportar</button>
                            <button type="submit" class="btn btn-secondary" id="exportButton"><i
                                    class="fas fa-fw fa-print"></i>Imprimir</button>
                        </div>
                    </div>
                    </form>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
        var inputFecha = document.getElementById("fecha_actual");
        var fechaActual = new Date();
        var formattedFecha = fechaActual.getFullYear() + "-" + ((fechaActual.getMonth() + 1) < 10 ? '0' : '') + (fechaActual
            .getMonth() + 1) + "-" + (fechaActual.getDate() < 10 ? '0' : '') + fechaActual.getDate();
        inputFecha.value = formattedFecha;
    </script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2').select2({
                placeholder: "Seleccione",
                allowClear: true,
            });
        });
    </script>

    {{-- @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        </script>
    @endif --}}

    {{-- <script>
        $(document).ready(function() {
            $('#exportButton').click(function() {
                var formData = $('#filters').serialize();
                $.ajax({
                    url: '{{ route('export.daily') }}',
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Export Successful',
                                text: 'The file has been exported successfully. Click below to download.',
                                showCancelButton: true,
                                confirmButtonText: 'Download',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.file;
                                }
                            });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.responseJSON.error,
                        });
                    }
                });
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('#airTraffic_report').on('submit', function(event) {
                event.preventDefault();
                var formData = $('#airTraffic_report').serialize();
                $.ajax({
                    url: '{{ route('export.daily') }}',
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            window.location.href = "{{ route('export.daily') }}" + "?" +
                                formData;
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Sin Registros',
                            text: response.responseJSON.error,
                        });
                        console.error(response.responseJSON.error);
                    }
                });
            });
        });
    </script>

@stop
