<div class="modal fade" id="modal-edit{{ $contract->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('config.contracts.update', $contract) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="col-md-8 mb-3">
                        <label for="nameBasic" class="form-label text-left">Nombre</label>
                        <input type="text" name="contract" class="form-control" placeholder="Aeropuerto"
                            value="{{ $contract->contract }}" required />
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
