<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Detalle de Ruta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('config.flight_route_details.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="route_id">Ruta</label>
                            <div class="form-group">
                                <select class="custom-select" name="route_id" id="route_id" required>
                                    <option value="">Seleccionar Ruta</option>
                                    @foreach ($routes as $route)
                                        <option value="{{ $route->id }}">{{ $route->route }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aircraft_type_id">Tipo de Avión</label>
                                <select class="custom-select" name="aircraft_type_id" required>
                                    <option value="">Seleccionar Tipo de Avión</option>
                                    @foreach ($aircraftTypes as $aircraftType)
                                        <option value="{{ $aircraftType->id }}">{{ $aircraftType->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time">Tiempo</label>
                                <input type="text" name="time" class="form-control" placeholder="00:00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fuel">Combustible</label>
                                <input type="number" name="fuel" class="form-control" required>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
