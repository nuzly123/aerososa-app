@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total_vuelos}}</h3>
                    <p>Vuelos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-plane"></i>
                </div>
                {{-- <a href="{{url("/air_traffic")}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$total_pasajeros}}</h3>
                    <p>Pasajeros</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$total_lbs}}<sup style="font-size: 20px">Lbs</sup></h3>
                    <p>Peso</p>
                </div>
                <div class="icon">
                    <i class="fas fa-weight"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$total_gaseos}}<sup style="font-size: 20px">Lbs</sup></h3>
                    <p>Gaseos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-gas-pump"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
