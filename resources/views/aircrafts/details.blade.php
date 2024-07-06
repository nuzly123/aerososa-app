<div class="modal fade" id="modal-info-{{ $aircraft->id }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-fw fa-info-circle"></i>{{ $aircraft->registration }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- contenido --}}
                <div class="ml-3">
                    <p>
                    <h6><i class="fas fa-fw fa-plane"></i><strong> Tipo de Aeronave:
                        </strong>{{ $aircraft->types->type }}</h6>
                    <h6><i class="fas fa-fw fa-history"></i><strong> Último Vuelo: </strong>
                        @if ($aircraft->lastFlight)
                            <a href="">{{ $aircraft->lastFlight->flight_date }}</a>
                        @else
                            Sin registros
                        @endif
                    </h6>
                    <h6><i class="fas fa-fw fa-gas-pump"></i><strong> Remanente:
                        </strong>{{ $aircraft->residual_fuel ? $aircraft->residual_fuel->residual_fuel_amount : ''}}</h6>
                    <h6><i class="fas fa-fw fa-question-circle"></i><strong> Estado:
                        </strong>{{ $aircraft->status ? 'Activo' : 'Inactivo' }}</h6>
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
