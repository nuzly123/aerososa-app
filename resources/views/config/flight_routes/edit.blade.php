 <div class="modal fade" id="modal-edit{{ $flight_route->id }}">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Nuevo</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('config.flight_routes.update', $flight_route) }}" method="post">
                     @csrf
                     @method('PUT')
                     <div class="row">
                         <div class="col-md-4 mb-6">
                             <label for="nameBasic" class="form-label text-left">Origen</label>
                             <select class="custom-select rounded-2" id="originEdit" name="origin_city_id"
                                 onchange="editarRuta()">
                                 <option value="0">- Opción -</option>
                                 @foreach ($cities as $city)
                                     <option value="{{ $city->id }}"
                                         {{ $flight_route->originCity->id == $city->id ? 'selected' : '' }}>
                                         {{ $city->code }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="col-md-4 mb-6">
                             <label for="nameBasic" class="form-label text-left">Destino</label>
                             <select class="custom-select rounded-2" id="destinationEdit" name="destination_city_id"
                                 onchange="editarRuta()">
                                 <option value="0">- Opción -</option>
                                 @foreach ($cities as $city)
                                     <option value="{{ $city->id }}"
                                         {{ $flight_route->destinationCity->id == $city->id ? 'selected' : '' }}>
                                         {{ $city->code }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-4 mb-12">
                             <label for="nameBasic" class="form-label text-left">Nombre Ruta</label>
                             <input type="text" name="route" class="form-control" id="routeEdit" placeholder="-"
                                 value="{{ $flight_route->route }}" required readonly />
                         </div>
                     </div>
                     <div class="alert alert-warning" role="alert" id="warning-messageEdit" style="display: none;">
                     </div>
                     <input type="hidden" name="user_update" value="{{ Auth::user()->id }}">
             </div>
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                 <button type="submit" class="btn btn-primary" id="addButton">Añadir</button>
                 </form>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->
