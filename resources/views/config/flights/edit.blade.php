<div class="modal fade" id="modal-edit{{ $flight->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('config.flights.update', $flight) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nameBasic" class="form-label text-left">Numero de Vuelo</label>
                            <input type="text" name="code" class="form-control" placeholder="000"
                                value="{{ $flight->code }}" required />
                        </div>
                        <div class="col-md-8">
                            <label for="nameBasic" class="form-label text-left">Ruta</label>
                            <select class="custom-select rounded-2" name="flight_route_id">
                                <option value="0">- Opción -</option>
                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}" 
                                       {{--  {{ $route->flightRoute->id == $route->id ? 'selected' : ''}} --}}>
                                        {{ $route->route }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nameBasic" class="form-label text-left">Salida</label>
                            <input type="time" name="departure" id="hora_salidaE" class="form-control"
                                onchange="calcularDuracion('hora_salidaE', 'hora_llegadaE', 'duracion_vueloE')"
                                value="{{ $flight->departure }}" placeholder="" required />
                        </div>
                        <div class="col-md-6">
                            <label for="nameBasic" class="form-label text-left">Llegada</label>
                            <input type="time" name="arrival" id="hora_llegadaE" class="form-control"
                                onchange="calcularDuracion('hora_salidaE', 'hora_llegadaE', 'duracion_vueloE')"
                                value="{{ $flight->arrival }}" placeholder="" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nameBasic" class="form-label text-left">Duración</label>
                            <input type="text" name="flight_time" class="form-control" id="duracion_vueloE"
                                value="{{ $flight->flight_time }}" readonly required />
                        </div>
                    </div>
                    <input type="hidden" name="user_update" value="{{ Auth::user()->id }}">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Añadir</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
