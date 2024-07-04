<div class="modal fade" id="modal-licencia{{ $crew->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Licencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('crews.addLicense') }}" method="post">
                    @csrf
                    @method('GET')
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="nameBasic" class="form-label text-left">Licencia:</label>
                            <input type="text" name="license" class="form-control"
                                placeholder="Ingrese número de licencia"
                                @foreach ($licenses as $license)
                                    @if ($crew->id == $license->employee_id)
                                        value={{ $license->license }}                     
                                    @endif 
                                @endforeach
                                required />
                        </div>
                    </div>
                    <input type="hidden" name="user_create" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="user_update" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="employee_id" value="{{$crew->id}}">
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
