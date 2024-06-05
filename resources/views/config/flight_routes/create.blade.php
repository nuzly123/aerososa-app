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
                <form action="{{ url('/flight_routes') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-6">
                            <label for="nameBasic" class="form-label text-left">Origen</label>
                            <select class="custom-select rounded-2" id="origin" name="origin_city_id" onchange="actualizarRuta()">
                                <option value="0">- Opción -</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-6">
                            <label for="nameBasic" class="form-label text-left">Destino</label>
                            <select class="custom-select rounded-2" id="destination" name="destination_city_id" onchange="actualizarRuta()">
                                <option value="0">- Opción -</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-12">
                            <label for="nameBasic" class="form-label text-left">Nombre Ruta</label>
                            <input type="text" name="route" class="form-control" id="route" placeholder="-" required readonly/>
                        </div>
                    </div>
                    <div class="alert alert-warning" role="alert" id="warning-message" style="display: none;"></div>
                    <input type="hidden" name="user_create" value="{{ 1 }}">
                    <input type="hidden" name="user_update" value="{{ 1 }}">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="addButton" disabled>Añadir</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
