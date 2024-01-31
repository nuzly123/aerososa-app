<div class="modal fade" id="modal-info-{{ $office->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-fw fa-info-circle"></i>{{ $office->office }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- contenido --}}
                <div class="ml-3">
                    <p>
                <h6><i class="fas fa-fw fa-phone-alt"></i><strong> Teléfono: </strong>{{ $office->phone }}</h6>
                <h6><i class="fas fa-fw fa-map-marker-alt"></i><strong> Dirección: </strong>{{ $office->address }}</h6>
                <h6><i class="fas fa-fw fa-globe"></i><strong> Coordenadas:
                    </strong>{{ $office->latitude . ' , ' . $office->latitude }}</h6>
                </p>
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
