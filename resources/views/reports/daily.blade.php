@extends('adminlte::page')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                {{-- MONITOREO --}}
                @can('reports.airTraffic')
                    <h5 class="mt-4 mb-2">Módulo de Monitoreo</h5>
                @endcan
                {{-- REPORTE DE TRAFICO AEREO --}}
                @can('export.daily')
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
                                    class="fas fa-fw fa-file-excel"></i>Exportar Excel</button>
                        </div>
                        </form>
                    </div>
                @endcan
                {{-- REPORTE DE VUELO --}}
                @can('reports.flight')
                    <div class="card card-primary collapsed-card shadow">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-fw fa-file-alt"></i>
                                Reporte de Vuelo
                            </h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Este reporte muestra los detalles de un vuelo específico, ingrese la referencia de vuelo:</p>
                            <form id="flight_report">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="flight_reference" class="form-label">Referencia de Vuelo:</label>
                                        <input type="text" class="form-control" name="flight_reference" id="flight_reference"
                                            required>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-danger" id="generate_pdf_button"><i
                                        class="fas fa-fw fa-file-pdf"></i>Exportar PDF</button>
                            </div>
                        </div>
                    </div>
                @endcan
                {{-- AERONAVES --}}
                @can('reports.aircrafts')
                    <h5 class="mt-4 mb-2">Módulo de Aeronaves</h5>
                @endcan
                {{-- REPORTE DE MOVIMIENTOS DE AERONAVE --}}
                @can('reports.aircraft_history')
                    <div class="card card-primary collapsed-card shadow">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-fw fa-file-alt"></i>
                                Reporte de Movimientos
                            </h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Ingrese el rango de fechas</p>
                            <form id="aircraft_history_report">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="txtCargo" class="form-label">Aeronave</label>
                                        <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                            id="history_aircraft_id">
                                            <option value="">- Opción -</option>
                                            @foreach ($aircrafts as $aircraft)
                                                <option value="{{ $aircraft->id }}">
                                                    {{ $aircraft->registration }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Desde</label>
                                        <input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Hasta</label>
                                        <input type="date" class="form-control" name="fecha_final" id="fecha_final">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-danger" id="generate_aircraft_history_pdf_button"><i
                                        class="fas fa-fw fa-file-pdf"></i>Exportar PDF</button>
                            </div>
                        </div>
                    </div>
                @endcan
                {{-- REPORTE DE GASEOS --}}
                @can('reports.aircraft_fuelings')
                    <div class="card card-primary collapsed-card shadow">
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
                            <form id="fueling_report">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="txtCargo" class="form-label">Aeronave</label>
                                        <select class="select2 form-control" style="width: 100%;" name="aircraft_id"
                                            id="fuel_aircraft_id">
                                            <option value="">- Opción -</option>
                                            @foreach ($aircrafts as $aircraft)
                                                <option value="{{ $aircraft->id }}">
                                                    {{ $aircraft->registration }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Desde</label>
                                        <input type="date" name="fecha_inicial" id="fuel_fecha_inicial"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Hasta</label>
                                        <input type="date" class="form-control" name="fecha_final" id="fuel_fecha_final">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Aeropuerto</label>
                                        <select class="select2 form-control" style="width: 100%;" name="airport_id"
                                            id="airport_id">
                                            <option value="">- Opción -</option>
                                            @foreach ($airports as $airport)
                                                <option value="{{ $airport->id }}">
                                                    {{ $airport->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Despachador de Vuelo</label>
                                        <select class="select2 form-control" style="width: 100%;" name="despachador_id"
                                            id="despachador_id">
                                            <option value="">- Opción -</option>
                                            @foreach ($crew_members['despachador_vuelo'] as $despachador)
                                                <option value="{{ $despachador->id }}">
                                                    {{ $despachador->name . ' ' . $despachador->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-danger" id="fueling_pdf_button"><i
                                        class="fas fa-fw fa-file-pdf"></i>Exportar PDF</button>
                            </div>
                        </div>
                        </form>
                    </div>
                @endcan
                {{-- TRIPULACION --}}
                @can('reports.crews')
                    <h5 class="mt-4 mb-2">Módulo de Tripulación</h5>
                @endcan
                {{-- REPORTE DE MOVIMIENTOS DE PILOTOS --}}
                @can('reports.crew_history')
                    <div class="card card-primary collapsed-card shadow">
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
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Piloto</label>
                                        <select class="select2 form-control" style="width: 100%;" name="pilot_id"
                                            id="pilot_id_report">
                                            <option value="">- Opción -</option>
                                            @foreach ($pilots as $pilot)
                                                <option value="{{ $pilot->id }}">
                                                    {{ $pilot->name . ' ' . $pilot->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Desde</label>
                                        <input type="date" name="fecha_inicial" id="fecha_inicial_report"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hasta</label>
                                        <input type="date" class="form-control" name="fecha_final"
                                            id="fecha_final_report">
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-danger" id="crew_history_reportButton"><i
                                        class="fas fa-fw fa-file-pdf"></i>Exportar PDF</button>
                            </div>
                        </div>
                        </form>
                    </div>
                @endcan
                {{-- REPORTE DE HORAS ACUMULADAS POR PILOTO --}}
                @can('reports.crew_flight_time')
                    <div class="card card-primary collapsed-card shadow">
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
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Piloto</label>
                                        <select class="select2 form-control" style="width: 100%;" name="pilot_id"
                                            id="pilot_id_crew_flight">
                                            <option value="">- Opción -</option>
                                            @foreach ($pilots as $pilot)
                                                <option value="{{ $pilot->id }}">
                                                    {{ $pilot->name . ' ' . $pilot->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Desde</label>
                                        <input type="date" name="fecha_inicial" id="fecha_inicial_crew_flight"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hasta</label>
                                        <input type="date" class="form-control" name="fecha_final"
                                            id="fecha_final_crew_flight">
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-danger" id="exportCrewFlightTimeButton"><i
                                        class="fas fa-fw fa-file-pdf"></i>Exportar PDF</button>
                            </div>
                        </div>
                        </form>
                    </div>
                @endcan
                {{-- REPORTE DE TRIPULACION ASIGNADA POR VUELO --}}
                @can('reports.assigned_crews')
                    <div class="card card-primary collapsed-card shadow">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-fw fa-file-alt"></i>
                                Reporte de Tripulaciones Asignadas
                            </h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Instrucciones</p>
                            <form id="crew_assigned_crews_report">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Desde</label>
                                        <input type="date" name="fecha_inicial" id="fecha_inicial_assigned"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hasta</label>
                                        <input type="date" class="form-control" name="fecha_final"
                                            id="fecha_final_assigned">
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-danger" id="exportAssignedCrewsButton"><i
                                        class="fas fa-fw fa-file-pdf"></i>Exportar PDF</button>
                            </div>
                        </div>
                        </form>
                    </div>
                @endcan
            </div>
        </div>

    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css"> --}}
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    {{-- REPORTE EXCEL TRAFICO AEREO --}}
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

    {{-- REPORTE DE VUELO --}}
    <script>
        document.getElementById('generate_pdf_button').addEventListener('click', function() {
            var flightReference = document.getElementById('flight_reference').value
                .trim(); // Obtener y limpiar el valor del campo

            // Validar si el campo está vacío
            if (flightReference === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor ingresa la referencia de vuelo.',
                });
                return; // Detener la ejecución si el campo está vacío
            }

            Swal.fire({
                icon: 'info',
                title: 'Procesando...',
                text: 'Se está generando el reporte, por favor espera.',
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            fetch('{{ route('reports.flight') }}?flight_reference=' + encodeURIComponent(flightReference), {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    Swal.close(); // Cerrar el SweetAlert de procesando
                    if (!response.ok) {
                        throw new Error('No se encontró el registro de vuelo.');
                    }
                    return response.blob();
                })
                .then(blob => {
                    // Crear un objeto URL del blob y abrir una nueva ventana para imprimir el PDF
                    var url = window.URL.createObjectURL(blob);
                    var printWindow = window.open(url);
                    /* printWindow.onload = function() {
                        printWindow.print();
                    }; */

                    // Limpiar el campo de referencia de vuelo
                    document.getElementById('flight_reference').value = '';

                    // Mostrar SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'El reporte se ha generado correctamente.',
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message,
                    });
                });
        });
    </script>

    {{-- REPORTE DE HISTORIAL DE AERONAVES --}}
    <script>
        document.getElementById('generate_aircraft_history_pdf_button').addEventListener('click', function() {
            var aircraftId = document.getElementById('history_aircraft_id').value.trim();
            var fechaInicial = document.getElementById('fecha_inicial').value.trim();
            var fechaFinal = document.getElementById('fecha_final').value.trim();
            console.log(aircraftId);
            // Validar si al menos uno de los campos está lleno
            if (aircraftId === '' && fechaInicial === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor ingrese la fecha inicial.',
                });
                return; // Detener la ejecución si los campos están vacíos
            }

            Swal.fire({
                icon: 'info',
                title: 'Procesando...',
                text: 'Se está generando el reporte, por favor espera.',
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            var url = '{{ route('reports.aircraft_history') }}?aircraft_id=' + encodeURIComponent(aircraftId) +
                '&fecha_inicial=' + encodeURIComponent(fechaInicial) + '&fecha_final=' + encodeURIComponent(
                    fechaFinal);

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    Swal.close(); // Cerrar el SweetAlert de procesando
                    if (!response.ok) {
                        throw new Error('No se encontraron registros para los filtros seleccionados.');
                    }
                    return response.blob();
                })
                .then(blob => {
                    // Crear un objeto URL del blob y abrir una nueva ventana para imprimir el PDF
                    var url = window.URL.createObjectURL(blob);
                    var printWindow = window.open(url);
                    /* printWindow.onload = function() {
                        printWindow.print();
                    }; */

                    // Limpiar los campos del formulario
                    document.getElementById('aircraft_history_report').reset();

                    // Mostrar SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'El reporte se ha generado correctamente.',
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message,
                    });
                });
        });
    </script>

    {{-- REPORTE GASEOS --}}
    <script>
        document.getElementById('fueling_pdf_button').addEventListener('click', function() {
            var aircraft_id = document.getElementById('fuel_aircraft_id').value.trim();
            var fecha_inicial = document.getElementById('fuel_fecha_inicial').value.trim();
            var fecha_final = document.getElementById('fuel_fecha_final').value.trim();
            var airport_id = document.getElementById('airport_id').value.trim();
            var despachador_id = document.getElementById('despachador_id').value.trim();

            if (fecha_inicial === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La fecha inicial es obligatoria.',
                });
                return;
            }

            Swal.fire({
                icon: 'info',
                title: 'Procesando...',
                text: 'Se está generando el reporte, por favor espera.',
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            fetch('{{ route('reports.aircraft_fuelings') }}?' + new URLSearchParams({
                    aircraft_id: aircraft_id,
                    fecha_inicial: fecha_inicial,
                    fecha_final: fecha_final,
                    airport_id: airport_id,
                    despachador_id: despachador_id
                }), {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    Swal.close();
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.error || 'Error al generar el reporte.');
                        });
                    }
                    return response.blob();
                })
                .then(blob => {
                    var url = window.URL.createObjectURL(blob);

                    // Abrir una nueva ventana para visualizar el PDF
                    var printWindow = window.open(url);
                    if (!printWindow) {
                        throw new Error('No se pudo abrir la ventana para mostrar el reporte.');
                    }

                    // Agregar evento para imprimir cuando se cargue la ventana
                    /* printWindow.addEventListener('load', function() {
                        printWindow.print();
                    }); */

                    // Limpiar los campos del formulario
                    document.getElementById('fueling_report').reset();

                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'El reporte se ha generado correctamente.',
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Hubo un error al generar el reporte.',
                    });
                });
        });
    </script>

    {{-- REPORTE MOVIMIENTOS TRIPULACION --}}
    <script>
        document.getElementById('crew_history_reportButton').addEventListener('click', function() {
            var pilotId = document.getElementById('pilot_id_report').value;
            var fechaInicial = document.getElementById('fecha_inicial_report').value;
            var fechaFinal = document.getElementById('fecha_final_report').value;

            // Validación simple para la fecha inicial
            if (fechaInicial === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor ingrese una fecha inicial.',
                });
                return;
            }

            Swal.fire({
                icon: 'info',
                title: 'Procesando...',
                text: 'Se está generando el reporte, por favor espera.',
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            fetch('{{ route('reports.crew_history') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/pdf',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        pilot_id: pilotId,
                        fecha_inicial: fechaInicial,
                        fecha_final: fechaFinal
                    })
                })
                .then(response => {
                    Swal.close(); // Cerrar el SweetAlert de procesando
                    if (!response.ok) {
                        throw new Error('No se encontraron registros para los filtros seleccionados.');
                    }
                    return response.blob();
                })
                .then(blob => {
                    var url = window.URL.createObjectURL(blob);
                    var newTab = window.open(url, '_blank');
                    if (!newTab) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo abrir la ventana de impresión. Por favor, habilite las ventanas emergentes para este sitio.',
                        });
                    } else {
                        newTab.onload = function() {
                            /* newTab.print(); */
                        };
                    }

                    // Mostrar SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'El reporte se ha generado correctamente.',
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message,
                    });
                });
        });
    </script>

    {{-- REPORTE DE HORAS ACUMULADAS --}}
    <script>
        document.getElementById('exportCrewFlightTimeButton').addEventListener('click', function() {
            var pilotId = document.getElementById('pilot_id_crew_flight').value;
            var fechaInicial = document.getElementById('fecha_inicial_crew_flight').value;
            var fechaFinal = document.getElementById('fecha_final_crew_flight').value;

            // Validación simple para el campo de piloto y fecha inicial
            if (pilotId === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor seleccione un piloto.',
                });
                return;
            }

            if (fechaInicial === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor ingrese una fecha inicial.',
                });
                return;
            }

            Swal.fire({
                icon: 'info',
                title: 'Procesando...',
                text: 'Se está generando el reporte, por favor espera.',
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            fetch('{{ route('reports.crew_flight_time') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/pdf',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        pilot_id: pilotId,
                        fecha_inicial: fechaInicial,
                        fecha_final: fechaFinal
                    })
                })
                .then(response => {
                    Swal.close(); // Cerrar el SweetAlert de procesando
                    if (!response.ok) {
                        throw new Error('No se encontraron registros para los filtros seleccionados.');
                    }
                    return response.blob();
                })
                .then(blob => {
                    var url = window.URL.createObjectURL(blob);
                    var newTab = window.open(url, '_blank');
                    if (!newTab) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo abrir la ventana de impresión. Por favor, habilite las ventanas emergentes para este sitio.',
                        });
                    } else {
                        newTab.onload = function() {
                            /* newTab.print(); */
                        };
                    }

                    // Mostrar SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'El reporte se ha generado correctamente.',
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message,
                    });
                });
        });
    </script>

    {{-- REPORTE DE TRIPULACION ASIGNADA --}}
    <script>
        document.getElementById('exportAssignedCrewsButton').addEventListener('click', function() {
            var fechaInicial = document.getElementById('fecha_inicial_assigned').value;
            var fechaFinal = document.getElementById('fecha_final_assigned').value;

            // Validación simple para el campo de fecha inicial
            if (fechaInicial === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor ingrese una fecha inicial.',
                });
                return;
            }

            Swal.fire({
                icon: 'info',
                title: 'Procesando...',
                text: 'Se está generando el reporte, por favor espera.',
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            fetch('{{ route('reports.assigned_crews') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/pdf',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        fecha_inicial: fechaInicial,
                        fecha_final: fechaFinal
                    })
                })
                .then(response => {
                    Swal.close(); // Cerrar el SweetAlert de procesando
                    if (!response.ok) {
                        throw new Error('No se encontraron registros para los filtros seleccionados.');
                    }
                    return response.blob();
                })
                .then(blob => {
                    var url = window.URL.createObjectURL(blob);
                    var newTab = window.open(url, '_blank');
                    if (!newTab) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo abrir la ventana de impresión. Por favor, habilite las ventanas emergentes para este sitio.',
                        });
                    } else {
                        newTab.onload = function() {
                            /* newTab.print(); */
                        };
                    }

                    // Mostrar SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'El reporte se ha generado correctamente.',
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message,
                    });
                });
        });
    </script>
@stop
