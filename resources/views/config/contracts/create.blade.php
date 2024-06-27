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
                <form action="{{ url('/contracts') }}" method="post">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label for="nameBasic" class="form-label text-left">Tipo de Contrato</label>
                        <input type="text" name="contract" class="form-control" placeholder="Contrato" required />
                    </div>
                    <input type="hidden" name="user_create" value="{{ Auth::user()->id }}"> {{-- cambiar cuando se haga el módulo de usuario --}}
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
