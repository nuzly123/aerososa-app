<div class="modal fade" id="modal-edit{{ $office->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('config.offices.update', $office) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="nameBasic" class="form-label text-left">Nombre</label>
                                    <input type="text" name="office" class="form-control" placeholder="Oficina"
                                        value="{{ $office->office }}" required />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="nameBasic" class="form-label text-left">Código</label>
                                    <input type="text" name="code" class="form-control" placeholder="Código"
                                        value="{{ $office->code }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="nameBasic" class="form-label text-left">Extensión</label>
                                    <input type="text" name="extension" class="form-control" placeholder="Extensión"
                                        value="{{ $office->extension }}" required />
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="nameBasic" class="form-label text-left">Teléfono</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Teléfono"
                                        value="{{ $office->phone }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="nameBasic" class="form-label text-left">Dirección</label>
                                    <textarea class="form-control" name="address" id="address">{{ $office->address }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <label for="nameBasic" class="form-label text-left">Coordenadas</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="latitude" class="form-control" placeholder="Latitud"
                                        value="{{ $office->latitude }}" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="longitude" class="form-control" placeholder="Longitud"
                                        value="{{ $office->longitude }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nameBasic" class="form-label text-left">Estación</label>
                                    <select class="custom-select rounded-2" name="station_id">
                                        <option value="0">- Opción -</option>
                                        @foreach ($stations as $station)
                                            <option value="{{ $station->id }}"
                                                {{ $office->station_id == $station->id ? 'selected' : '' }}>
                                                {{ $station->station }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nameBasic" class="form-label text-left">Ciudad</label>
                                    <select class="custom-select rounded-2" name="city_id">
                                        <option value="0">- Opción -</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $office->city_id == $city->id ? 'selected' : '' }}>
                                                {{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_update" value="{{ Auth::user()->id }}"> {{-- cambiar segun el usuario de la sesion cuando se haga el modulo de users --}}
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
