<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/flights') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nameBasic" class="form-label text-left">Numero de Vuelo</label>
                            <input type="text" name="code" class="form-control" placeholder="000" required />
                        </div>
                        {{-- <div class="col-md-4 mb-3">
                            <label for="nameBasic" class="form-label text-left">Origen</label>
                            <select class="custom-select rounded-2" name="origin">
                                <option value="0">- Opción -</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nameBasic" class="form-label text-left">Destino</label>
                            <select class="custom-select rounded-2" name="destination">
                                <option value="0">- Opción -</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->code }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-md-8">
                            <label for="nameBasic" class="form-label text-left">Ruta</label>
                            <select class="custom-select rounded-2" name="flight_route_id">
                                <option value="0">- Opción -</option>
                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->route }}</option>
                                @endforeach
                            </select>   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nameBasic" class="form-label text-left">Salida</label>
                            <input type="time" name="departure" id="hora_salida" class="form-control" onchange="calcularDuracion('hora_salida', 'hora_llegada', 'duracion_vuelo')" placeholder="" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nameBasic" class="form-label text-left">Llegada</label>
                            <input type="time" name="arrival" id="hora_llegada" class="form-control" onchange="calcularDuracion('hora_salida', 'hora_llegada', 'duracion_vuelo')" placeholder="" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nameBasic" class="form-label text-left">Duración</label>
                            <input type="text" name="flight_time" class="form-control" id="duracion_vuelo" placeholder="00:00" readonly required />
                        </div>
                    </div>
                    <input type="hidden" name="user_create" value="{{ Auth::user()->id }}">
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