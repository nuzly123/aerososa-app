<div class="modal fade" id="modal-info-{{ $air_traffic->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plane"></i> Detalles del Tráfico Aéreo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="report-container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-info-circle"></i> Información del Vuelo</h6>
                                <div class="info-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong><i class="far fa-calendar-alt"></i> Fecha de
                                                    Vuelo:</strong><br>{{ $air_traffic->flight_date }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>No. Vuelo:</strong><br>{{ $air_traffic->flight->code }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong><i class="fas fa-plane"></i>
                                                    Aeronave:</strong><br>{{ $air_traffic->aircraft->registration }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong><i class="fas fa-route"></i>
                                                    Ruta:</strong><br>{{ $air_traffic->flight_route }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <p><strong>Estado de
                                                    Vuelo:</strong><br>{{ $flight_status_array[$air_traffic->flight_status] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-users"></i> Pasajeros</h6>
                                <div class="info-section">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p><strong>PX: </strong><br>{{ $air_traffic->px }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>DH: </strong><br>{{ $air_traffic->dh }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>INF:</strong><br>{{ $air_traffic->inf }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>Total: </strong><br>{{ $air_traffic->total_passengers }}</p>
                                        </div>
                                    </div>

                                    <div class="row">

                                    </div>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-weight-hanging"></i> Libras</h6>
                                <div class="info-section">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p><strong>
                                                    PX:</strong><br>{{ $air_traffic->px_lbs }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>
                                                    Carga:</strong><br>{{ $air_traffic->freight }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>
                                                    Trans:</strong><br>{{ $air_traffic->trans_weight }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>Total: </strong><br>{{ $air_traffic->total_lbs }}</p>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-user-friends"></i> Tripulación Asignada</h6>
                                <div class="info-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong><i class="fas fa-user-captain"></i>
                                                    Capitán:</strong><br>{{ $air_traffic->captain->name . ' ' . $air_traffic->captain->last_name }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong><i class="fas fa-user-tie"></i> Primer
                                                    Oficial:</strong><br>{{ $air_traffic->first_official->name . ' ' . $air_traffic->first_official->last_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <p><strong></i> Tripulante de Cabina:</strong>
                                    <div class="row">
                                        @if ($air_traffic->flightAssistants && !$air_traffic->flightAssistants->isEmpty())
                                            @foreach ($air_traffic->flightAssistants as $assistantDetail)
                                                <div class="col-md-6">
                                                    <i class="fas fa-user-nurse"></i>
                                                    {{ $assistantDetail->name . ' ' . $assistantDetail->last_name }}
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12">{{ 'N/A' }}</div>
                                        @endif
                                    </div>
                                    </p>
                                    <p><strong><i class="fas fa-eye"></i>
                                            Observador:</strong><br>{{ $air_traffic->obsservant ? $air_traffic->obsservant : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-exchange-alt"></i> Tránsitos</h6>
                                <div class="info-section">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p><strong>TGU:</strong><br>{{ $air_traffic->trans_tgu }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>SAP:</strong><br>{{ $air_traffic->trans_sap }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>RTB:</strong><br>{{ $air_traffic->trans_rtb }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><strong>LCE:</strong><br>{{ $air_traffic->trans_lce }}</p>
                                        </div>
                                    </div>
                                    {{-- <div class="row">

                                    </div> --}}
                                </div>
                            </div>
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-gas-pump"></i> Combustible (LBS)</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Inicial:</strong><br>{{ $air_traffic->initial_fuel }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Consumo:</strong><br>{{ $air_traffic->fuel_consumption }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Remanente:</strong><br>{{ $air_traffic->residual_fuel }}</p>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <p><strong><i class="fas fa-barcode"></i> Referencia de
                                                Gaseo:</strong><br>
                                            {{ $air_traffic->fueling_id ? $air_traffic->fueling->reference : 'N/A' }}
                                        </p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="report-section">
                        <h6 class="section-title"><i class="fas fa-comment-alt"></i> Observaciones</h6>
                        <p>{{ $air_traffic->remark }}</p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>
                    Cerrar</button>
            </div>
        </div>
    </div>
</div>
