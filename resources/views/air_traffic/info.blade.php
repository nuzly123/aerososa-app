{{-- <div class="modal fade" id="modal-info-{{ $air_traffic->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detalles del Tráfico Aéreo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h4>Información del Vuelo</h4>
                        <p><strong>Fecha de Vuelo:</strong> {{ $air_traffic->flight_date }}</p>
                        <p><strong>No. Vuelo:</strong> {{ $air_traffic->flight->code }}</p>
                        <p><strong>Aeronave:</strong> {{ $air_traffic->aircraft->registration }}</p>
                        <p><strong>Ruta:</strong> {{ $air_traffic->flight_route }}</p>
                        <p><strong>Total de Pasajeros:</strong> {{ $air_traffic->total_passengers }}</p>
                        <ul>
                            <li>PX: {{ $air_traffic->px }}</li>
                            <li>DH: {{ $air_traffic->dh }}</li>
                            <li>INF: {{ $air_traffic->inf }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Tripulación Asignada</h6>
                        <p><strong>Capitán:</strong>
                            {{ $air_traffic->captain->name . ' ' . $air_traffic->captain->last_name }}</p>
                        <p><strong>Primer Oficial:</strong>
                            {{ $air_traffic->first_official->name . ' ' . $air_traffic->first_official->last_name }}
                        </p>
                        <p><strong>Tripulante de Cabina:</strong>
                        <ul>
                            @foreach ($air_traffic->flightAssistants as $assistantDetail)
                                <li>{{ $assistantDetail->name }} {{ $assistantDetail->last_name }}
                                </li>
                            @endforeach
                        </ul>
                        </p>
                        <p><strong>Observador:</strong>
                            {{ $air_traffic->obsservant }}</p>
                        <h6>Total de Libras</h6>
                        <p><strong>PX:</strong> {{ $air_traffic->px_lbs }}</p>
                        <p><strong>Carga:</strong> {{ $air_traffic->freight }}</p>
                        <p><strong>Trans:</strong> {{ $air_traffic->trans_weight }}</p>
                        <h6>Tránsitos</h6>
                        <p><strong>TGU:</strong> {{ $air_traffic->trans_tgu }}</p>
                        <p><strong>SAP:</strong> {{ $air_traffic->trans_sap }}</p>
                        <p><strong>RTB:</strong> {{ $air_traffic->trans_rtb }}</p>
                        <p><strong>LCE:</strong> {{ $air_traffic->trans_lce }}</p>
                        <h6>Observaciones</h6>
                        <p>{{ $air_traffic->observations }}</p>
                    </div>
                </div>
                @if ($air_traffic->fueling_id)
                    <h6>Gaseo</h6>
                    <p><strong>Referencia de Gaseo:</strong> {{ $air_traffic->fueling_id }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
 --}}

{{--  <div class="modal fade" id="modal-info-{{ $air_traffic->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plane"></i> Detalles Registro Tráfico Aéreo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="report-container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="report-section">
                                <h6><i class="fas fa-info-circle"></i> Información del Vuelo</h6>
                                <div class="info-section">
                                    <p><strong><i class="far fa-calendar-alt"></i> Fecha de Vuelo:</strong><br>{{ $air_traffic->flight_date }}</p>
                                    <p><strong><i class="fas fa-plane"></i> No. Vuelo:</strong><br>{{ $air_traffic->flight->code }}</p>
                                    <p><strong><i class="fas fa-plane"></i> Aeronave:</strong><br>{{ $air_traffic->aircraft->registration }}</p>
                                    <p><strong><i class="fas fa-route"></i> Ruta:</strong><br>{{ $air_traffic->flight_route }}</p>
                                    <p><strong><i class="fas fa-users"></i> Total de Pasajeros:</strong><br>{{ $air_traffic->total_passengers }}</p>
                                    <ul>
                                        <li><i class="fas fa-user"></i> PX: {{ $air_traffic->px }}</li>
                                        <li><i class="fas fa-user"></i> DH: {{ $air_traffic->dh }}</li>
                                        <li><i class="fas fa-user"></i> INF: {{ $air_traffic->inf }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6><i class="fas fa-weight-hanging"></i> Total de Libras</h6>
                                <div class="info-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong><i class="fas fa-user"></i> PX:</strong><br>{{ $air_traffic->px_lbs }}</p>
                                            <p><strong><i class="fas fa-box"></i> Carga:</strong><br>{{ $air_traffic->freight }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong><i class="fas fa-truck"></i> Trans:</strong><br>{{ $air_traffic->trans_weight }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="report-section">
                                <h6><i class="fas fa-user-friends"></i> Tripulación Asignada</h6>
                                <div class="info-section">
                                    <p><strong><i class="fas fa-user-captain"></i> Capitán:</strong><br>{{ $air_traffic->captain->name . ' ' . $air_traffic->captain->last_name }}</p>
                                    <p><strong><i class="fas fa-user-tie"></i> Primer Oficial:</strong><br>{{ $air_traffic->first_official->name . ' ' . $air_traffic->first_official->last_name }}</p>
                                    <p><strong><i class="fas fa-user-nurse"></i> Tripulante de Cabina:</strong><br>
                                        <ul>
                                            @foreach ($air_traffic->flightAssistants as $assistantDetail)
                                                <li><i class="fas fa-user-nurse"></i> {{ $assistantDetail->name }} {{ $assistantDetail->last_name }}</li>
                                            @endforeach
                                        </ul>
                                    </p>
                                    <p><strong><i class="fas fa-eye"></i> Observador:</strong><br>{{ $air_traffic->obsservant }}</p>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6><i class="fas fa-exchange-alt"></i> Tránsitos</h6>
                                <div class="info-section">
                                    <p><strong><i class="fas fa-plane-departure"></i> TGU:</strong><br>{{ $air_traffic->trans_tgu }}</p>
                                    <p><strong><i class="fas fa-plane-departure"></i> SAP:</strong><br>{{ $air_traffic->trans_sap }}</p>
                                    <p><strong><i class="fas fa-plane-departure"></i> RTB:</strong><br>{{ $air_traffic->trans_rtb }}</p>
                                    <p><strong><i class="fas fa-plane-departure"></i> LCE:</strong><br>{{ $air_traffic->trans_lce }}</p>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6><i class="fas fa-comment-alt"></i> Observaciones</h6>
                                <p>{{ $air_traffic->observations }}</p>
                            </div>
                            @if ($air_traffic->fueling_id)
                                <div class="report-section">
                                    <h6><i class="fas fa-gas-pump"></i> Gaseo</h6>
                                    <p><strong><i class="fas fa-barcode"></i> Referencia de Gaseo:</strong><br>{{ $air_traffic->fueling_id }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div> --}}

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
                                        <div class="col-md-4 mt-4">
                                            <p><strong>PX: </strong>{{ $air_traffic->px }}</p>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <p><strong>DH: </strong>{{ $air_traffic->dh }}</p>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <p><strong>INF:</strong> {{ $air_traffic->inf }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <p><strong>Total: </strong>{{ $air_traffic->total_passengers }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-weight-hanging"></i> Libras</h6>
                                <div class="info-section">
                                    <div class="row">
                                        <div class="col-md-4 mt-4">
                                            <p><strong><i class="fas fa-user"></i>
                                                    PX:</strong><br>{{ $air_traffic->px_lbs }}</p>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <p><strong><i class="fas fa-box"></i>
                                                    Carga:</strong><br>{{ $air_traffic->freight }}</p>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <p><strong><i class="fas fa-truck"></i>
                                                    Trans:</strong><br>{{ $air_traffic->trans_weight }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <p><strong>Total: </strong>{{ $air_traffic->total_lbs }}</p>
                                        </div>
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
                                        @foreach ($air_traffic->flightAssistants as $assistantDetail)
                                            <div class="col-md-6">
                                                <i class="fas fa-user-nurse"></i> {{ $assistantDetail->name }}
                                                {{ $assistantDetail->last_name }}
                                            </div>
                                        @endforeach
                                    </div>
                                    </p>
                                    <p><strong><i class="fas fa-eye"></i>
                                            Observador:</strong><br>{{ $air_traffic->obsservant }}</p>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-exchange-alt"></i> Tránsitos</h6>
                                <div class="info-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>TGU:</strong><br>{{ $air_traffic->trans_tgu }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>SAP:</strong><br>{{ $air_traffic->trans_sap }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>RTB:</strong><br>{{ $air_traffic->trans_rtb }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>LCE:</strong><br>{{ $air_traffic->trans_lce }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="report-section">
                                <h6 class="section-title"><i class="fas fa-comment-alt"></i> Observaciones</h6>
                                <p>{{ $air_traffic->remark }}</p>
                            </div>
                            @if ($air_traffic->fueling_id)
                                <div class="report-section">
                                    <h6 class="section-title"><i class="fas fa-gas-pump"></i> Gaseo</h6>
                                    <p><strong><i class="fas fa-barcode"></i> Referencia de
                                            Gaseo:</strong><br>{{ $air_traffic->fueling->reference }}</p>
                                </div>
                            @endif
                        </div>
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
