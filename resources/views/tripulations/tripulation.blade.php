@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1 class="m-0 text-dark">Tripulación</h1>
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-12">
                    <div class="btn-group w-100 mb-2">
                        <a class="btn btn-primary active" href="javascript:void(0)" data-filter="all"> Todos </a>
                        <a class="btn btn-primary" href="javascript:void(0)" data-filter="1"> Capitanes </a>
                        <a class="btn btn-primary" href="javascript:void(0)" data-filter="2"> Primer Oficiales </a>
                        <a class="btn btn-primary" href="javascript:void(0)" data-filter="3"> Tripulantes de Cabina </a>

                    </div>
                    <div class="mb-2">
                        {{-- <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle=""> Shuffle items </a> --}}
                        <div class="float-right">
                            <select class="custom-select" style="width: auto;" data-sortorder="">
                                <option value="index"> Ordenar por Nombre </option>
                                <option value="sortData"> Ordenar Fecha de ingreso </option>
                            </select>
                            <div class="btn-group">
                                <a class="btn btn-default" href="javascript:void(0)" data-sortasc=""> Ascendente </a>
                                <a class="btn btn-default" href="javascript:void(0)" data-sortdesc=""> Descendente </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="row">
                        @foreach ($data as $crew)
                            <div class="col-sm-3 col-md-2 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">    
                                    <div class="card-body {{-- pt-0 --}}">
                                        <div class="col-12 text-center">
                                            <img src="{{ asset('storage') . '/' . $crew->photo }}" alt="user-avatar"
                                                class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    <div class="card-header text-muted border-bottom-0 text-center pt-0">
                                        {{ $crew->name . ' ' . $crew->last_name }}
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="#" class="btn btn-xs bg-teal">
                                                <i class="fas fa-history"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-primary">
                                                <i class="fas fa-user"></i> Ver Perfil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="card-footer">
            <nav aria-label="Contacts Page Navigation">
                <ul class="pagination justify-content-center m-0">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                </ul>
            </nav>
        </div>

    </div> --}}

    @stop
