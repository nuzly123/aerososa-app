<div class="modal fade" id="modal-edit{{ $station->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stations.update', $station) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="nameBasic" class="form-label text-left">Nombre</label>
                            <input type="text" name="station" class="form-control" placeholder="Estacion"
                                value="{{ $station->station }}" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nameBasic" class="form-label text-left">Código</label>
                            <input type="text" name="code" class="form-control" placeholder="Código"
                                value="{{ $station->code }}" required />
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
