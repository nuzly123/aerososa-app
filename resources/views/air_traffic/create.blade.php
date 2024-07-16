@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1 class="m-0 text-dark">Tráfico Aéreo</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary mb-4">
                <h5 class="card-header">Nuevo Registro Tráfico Aéreo</h5>
                <form action="{{ url('/air_traffic') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-success card-outline">{{-- <div class="flight-info section"> --}}
                                            <div class="card-header">
                                                <h5>Información del Vuelo <i class="fas fa-plane"></i></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="fecha_actual" class="form-label">Fecha del
                                                            Vuelo <code>*</code></label>
                                                        <input type="date" class="form-control" name="flight_date"
                                                            id="fecha_actual" value="">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="txtCargo" class="form-label">Aeronave
                                                            <code>*</code></label>
                                                        <select class="select2 form-control" style="width: 100%;"
                                                            name="aircraft_id" id="aircraft_id" required>
                                                            <option value="">- Opción -</option>
                                                            @foreach ($aircrafts as $aircraft)
                                                                <option value="{{ $aircraft->id }}">
                                                                    {{ $aircraft->registration }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="txtCargo" class="form-label">No. Vuelo
                                                            <code>*</code></label>
                                                        <select class="select2 form-control" style="width: 100%;"
                                                            name="flight_id" id="flight_selected" required>
                                                            <option value="">- Opción -</option>
                                                            @foreach ($flights as $flight)
                                                                <option value="{{ $flight->id }}">{{ $flight->code }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Ruta de Vuelo</label>
                                                        <input type="text" class="form-control" name="flight_route"
                                                            id="flight_route" readonly>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <label class="form-label">Salida: <code>*</code></label>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <p class="text-primary" id="departure_time" align="right">
                                                                    00:00</p>
                                                            </div>
                                                        </div>
                                                        <input type="time" class="form-control" name="departure"
                                                            id="departure">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Llegada:</label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <p class="text-primary" id="arrival_time" align="right">
                                                                    00:00</p>
                                                            </div>
                                                        </div>
                                                        <input type="time" class="form-control" name="arrival"
                                                            id="arrival">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        {{-- <div class="row">
                                                        <div class="col-md-5">
                                                            <label class="form-label">Estado de Vuelo:</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                                                        </div>
                                                    </div>      --}}
                                                        <label class="form-label mb-3">Estado de Vuelo</label>
                                                        <input type="text" class="form-control" id="flight_status"
                                                            readonly placeholder="-">
                                                        <input type="hidden" name="flight_status" id="flight_status_index">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>{{-- </div> --}}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-success card-outline">
                                            <div class="card-header">
                                                <h5>Tripulación <i class="fas fa-users"></i></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Capitán <code>*</code></label>
                                                        <select class="select2 form-control" style="width: 100%;"
                                                            name="captain_id" required>
                                                            <option value="">- Opción -</option>
                                                            @foreach ($crew_members['capitan'] as $crew_member)
                                                                <option value="{{ $crew_member->id }}">
                                                                    {{ $crew_member->name . ' ' . $crew_member->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Primer Oficial <code>*</code></label>
                                                        <select class="select2 form-control" style="width: 100%;"
                                                            name="first_official_id" required>
                                                            <option value="">- Opción -</option>
                                                            @foreach ($crew_members['primer_oficial'] as $crew_member)
                                                                <option value="{{ $crew_member->id }}">
                                                                    {{ $crew_member->name . ' ' . $crew_member->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Tripulante(s)</label>
                                                        <select class="select2 form-control" style="width: 100%;"
                                                            name="flight_assistant_id[]" multiple>
                                                            <option value="">- Opción -</option>
                                                            @foreach ($crew_members['tripulante_cabina'] as $crew_member)
                                                                <option value="{{ $crew_member->id }}">
                                                                    {{ $crew_member->name . ' ' . $crew_member->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Observador</label>
                                                        <textarea class="form-control" name="obsservant" id="obsservant" cols="30" rows="2"></textarea>
                                                        {{-- <input type="text" class="form-control" name="obsservant"
                                                        id="obsservant"> --}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                <h5>Pasajeros <i class="fas fa-user-friends"></i></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">PAX</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="px"
                                                            id="px" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">DH</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="dh"
                                                            id="dh" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">INFANTES</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="inf"
                                                            id="inf" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">TOTAL</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="total_passengers"
                                                            id="total" readonly value="0">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                <h5>Cálculo de Libras <i class="fas fa-weight"></i></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">PAX</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="px_lbs"
                                                            id="px_lbs" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">CARGA</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="freight"
                                                            id="freight" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">TRANSITO</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="trans_weight"
                                                            id="trans_weight" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">TOTAL</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="total_lbs"
                                                            id="total_lbs" readonly value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                <h5>Tránsitos <i class="fas fa-plane-arrival"></i></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">TGU</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="trans_tgu"
                                                            id="trans_tgu" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">SAP</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="trans_sap"
                                                            id="trans_sap" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">RTB</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="trans_rtb"
                                                            id="trans_rtb" value="0">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">LCE</label>
                                                        <input type="number" min="0"
                                                            class="form-control text-center" name="trans_lce"
                                                            id="trans_lce" value="0">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-secondary card-outline">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="card-header">
                                                        <h5>Combustible <i class="fas fa-gas-pump"></i></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-3 mb-3">
                                                                <label class="form-label">Inicial</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="initial_fuel" id="initial_fuel" value="0"
                                                                    readonly>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label class="form-label">Gaseo</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="refueling_amount" id="refueling"
                                                                    value="0">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label class="form-label">Consumo</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="fuel_consumption" id="fuel_consumption"
                                                                    value="0" readonly>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label class="form-label">Remanente</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    name="residual_fuel" id="residual_fuel" readonly
                                                                    value="0">
                                                                <input type="hidden" name="residual" id="residual">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label text-primary">Gaseo autorizado
                                                                    por:</label>
                                                                <select class="select2 form-control" style="width: 100%;"
                                                                    name="approved_by" id="approved_by" required>
                                                                    <option value="">- Opción -</option>
                                                                    @foreach ($crew_members['despachador_vuelo'] as $crew_member)
                                                                        <option value="{{ $crew_member->id }}">
                                                                            {{ $crew_member->name . ' ' . $crew_member->last_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label text-primary">Aeropuerto de
                                                                    Gaseo:</label>
                                                                <select class="select2 form-control" style="width: 100%;"
                                                                    name="airport_id" id="airport_id" required>
                                                                    <option value="">- Opción -</option>
                                                                    @foreach ($airports as $airport)
                                                                        <option value="{{ $airport->id }}">
                                                                            {{ $airport->code }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-secondary card-outline">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="card-header">
                                                        <h5>Comentarios <i class="fas fa-comment-dots"></i></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <textarea name="remark" id="remark" cols="10" rows="6" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_create" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="user_update" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="flight_time">
                    <div class="card-footer">
                        <a href="{{ url('/air_traffic') }}" class="btn btn-default btn-lg float-left"><i
                                class="fas fa-fw fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-success btn-lg float-right"
                            name="nuevoRegistro"><i class="fas fa-fw fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="../../resources/css/air_traffic.css"> --}}
@stop

@section('js')
    <script src="../../resources/js/employee.js"></script>
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="../../resources/js/air_traffic.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2').select2({
                placeholder: "- Opción -",
                allowClear: true,
            });
        });
    </script>
    <script>
        var inputFecha = document.getElementById("fecha_actual");
        var fechaActual = new Date();
        var formattedFecha = fechaActual.getFullYear() + "-" + ((fechaActual.getMonth() + 1) < 10 ? '0' : '') + (fechaActual
            .getMonth() + 1) + "-" + (fechaActual.getDate() < 10 ? '0' : '') + fechaActual.getDate();
        inputFecha.value = formattedFecha;
    </script>

    <script>
        $(document).ready(function() {
            $('#flight_selected').change(function() {
                var flightId = $(this).val();
                /* console.log(flightId); */
                if (flightId !== '') {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('ruta.obtener', ':id') }}'.replace(':id', flightId),
                        /* data: {
                            id: flightId
                        }, // Ruta de la solicitud AJAX para obtener la ruta del vuelo */
                        success: function(response) {
                            //console.log('Correcto');
                            $('#flight_route').val(
                                response.flight_route
                            );
                            // Actualiza el campo de entrada de texto con la ruta obtenida
                            // Actualizar el horario de salida
                            $('#departure_time').text(response.departure_time);

                            // Actualizar el horario de llegada
                            $('#arrival_time').text(response.arrival_time);

                            $('#flight_route').trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error(error); //Maneja errores en la solicitud AJAX
                        }
                    });
                } else {
                    $('#flight_route').val(
                        ''); // Borra el campo de entrada de texto si no se selecciona ningún vuelo
                    $('#departure').text('');
                    $('#arrival').text('');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#departure').change(function() {
                var flightId = $('#flight_selected').val(); // Obtener el ID del vuelo seleccionado
                var aircraft_id = $('#aircraft_id').val();
                var realDepartureTime = $(this)
                    .val(); // Obtener la hora real de salida del vuelo desde el input

                if (flightId !== '') {
                    $.ajax({
                        url: '{{ route('estado.obtener', ':id') }}'.replace(':id', flightId),
                        type: 'GET',
                        data: {
                            real_departure_time: realDepartureTime, // Enviar la hora real de salida del vuelo al backend
                            aircraft_id: aircraft_id
                        },
                        success: function(response) {
                            /* var indiceVuelo = response[0];
                            var estadoVuelo = response[1];

                            $('#flight_status').val(estadoVuelo);
                            $('#flight_status_index').val(indiceVuelo); */
                            var indiceVuelo = response.index;
                            var estadoVuelo = response.status;
                            var llegadaVuelo = response.arrival;

                            $('#flight_status').val(estadoVuelo);
                            $('#flight_status_index').val(indiceVuelo);
                            $('#arrival').val(llegadaVuelo);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#flight_status').val('');
                    $('#flight_status_index').val('');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#flight_route').change(function() {
                var flightRoute = $(this).val();
                var aircraftId = $('#aircraft_id').val();
                if (flightRoute !== '' && aircraftId !== '') {
                    fetchFuelConsumption(flightRoute, aircraftId);
                } else {
                    $('#fuel_consumption').val('0');
                    $('#fuel_consumption').trigger('change');
                }
            });

            function fetchFuelConsumption(flightRoute, aircraftId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('consumo.combustible') }}',
                    data: {
                        flight_route: flightRoute,
                        aircraft_id: aircraftId
                    },
                    success: function(response) {
                        $('#fuel_consumption').val(response.fuel_consumption);
                        $('#fuel_consumption').trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Function to calculate Initial Fuel and Residual Fuel
            function calcularInitialFuel() {
                var residualValue = parseInt($('#residual').val()) || 0;
                var refuelingValue = parseInt($('#refueling').val()) || 0;
                var fuelConsumptionValue = parseInt($('#fuel_consumption').val()) || 0;
                var residual = parseInt($('#residual_fuel').val()) || 0;

                var sumInitial = residualValue + refuelingValue;
                $('#initial_fuel').val(sumInitial);

                if (sumInitial > fuelConsumptionValue) {
                    var newResidual = sumInitial - fuelConsumptionValue;
                    $('#residual_fuel').val(newResidual);
                } else {
                    /* alert('El remanente debe ser mayor que el consumo. Por favor, ingrese más combustible.'); */
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El combustible inicial debe ser mayor que el consumo. Por favor, ingrese gaseo.',
                    });
                }
            }

            // Event listeners for changes in refueling and fuel consumption
            $('#refueling').on('change', calcularInitialFuel);
            $('#fuel_consumption').on('change', calcularInitialFuel);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#aircraft_id').change(function() {
                var aircraftId = $(this).val();
                if (aircraftId !== '') {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('remanente.combustible') }}',
                        data: {
                            aircraft_id: aircraftId
                        },
                        success: function(response) {
                            $('#residual_fuel').val(response.residual_fuel);
                            $('#residual').val(response.residual_fuel)
                            $('#initial_fuel').val(response.residual_fuel);
                            $('#refueling').val('0');
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#residual_fuel').val('0');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var gaseoInput = document.getElementById('refueling');
            var approved_bySelect = document.getElementById('approved_by');
            var airportSelect = document.getElementById('airport_id');

            function toggleSelect() {
                var gaseoValue = parseInt(gaseoInput.value);

                if (isNaN(gaseoValue) || gaseoValue <= 0) {
                    // Deshabilita los select2 y limpia la selección
                    $('#approved_by').val(null).trigger('change');
                    $('#airport_id').val(null).trigger('change');

                    approved_bySelect.disabled = true;
                    airportSelect.disabled = true;
                } else {
                    approved_bySelect.disabled = false;
                    airportSelect.disabled = false;
                }
            }


            gaseoInput.addEventListener('input', toggleSelect);

            // Inicializar el estado del select al cargar la página
            toggleSelect();
        });
    </script>

@stop
