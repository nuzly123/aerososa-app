<div class="modal fade" id="modal-edit{{$aircraft->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('aircrafts.update', $aircraft) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Tipo de Aeronave</label>
                            <div class="mb-3">
                                <select class="custom-select rounded-2" name="aircraft_type_id" required>
                                    <option value="">- Opción -</option>s
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" 
                                            {{ $aircraft->aircraft_type_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nameBasic" class="form-label text-left">Matricula</label>
                            <input type="text" name="registration" class="form-control" placeholder="Matricula"
                                value="{{$aircraft->registration}}" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Fotografía</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="img" id="imgEdit"
                                            onchange="updateFileNameEdit()">
                                        <label class="custom-file-label" for="photo"
                                            id="photoNameEdit">Seleccionar</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_create" value="{{ 1 }}">
                    <input type="hidden" name="user_update" value="{{ 1 }}">
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

@section('js')
    <script src="../resources/js/aircraft.js"></script>
@stop
