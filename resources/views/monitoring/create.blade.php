@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1 class="m-0 text-dark">Tráfico Aéreo</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Nuevo Registro Tráfico Aéreo</h5>
                <form action="{{ url('/monitoring') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3 ml-6">
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="txtCargo" class="form-label">Aeronave</label>
                                        <select class="select2" style="width: 100%;" name="registration" required>
                                            <option value="">- Opción -</option>
                                            @foreach ($aircrafts as $aircraft)
                                                <option value="{{ $aircraft->id }}">{{ $aircraft->registration }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="txtCargo" class="form-label">No. Vuelo</label>
                                        <select class="select2" style="width: 100%;" name="flight" id="flight_selected"
                                            onchange="mostrarDatosVuelo('flight')" required>
                                            <option value="">- Opción -</option>
                                            @foreach ($flights as $flight)
                                                <option value="{{ $flight->id }}">{{ $flight->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6s mb-3">
                                        <label class="form-label">Ruta de Vuelo</label>
                                        <input type="text" class="form-control" name="flight_route"
                                            id="flight_route" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_create" value="{{ 1 }}">
                    <input type="hidden" name="user_update" value="{{ 1 }}">
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="../../resources/js/employee.js"></script>

    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2').select2({
                placeholder: "- Opción -",
                allowClear: false,

            });
        });
    </script>
@stop
