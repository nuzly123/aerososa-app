@extends('adminlte::page')

@section('title', 'AeroSosa | Monitoreo')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p>

    <h1>Ejemplo de AJAX en Laravel</h1>
    <div id="resultado"></div>
    <button id="obtenerDatos">Obtener Datos</button> --}}
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}

    {{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // Realizar la petición AJAX al hacer clic en un botón (puedes cambiar el evento según tus necesidades)
            $('#obtenerDatos').click(function() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('datos.obtener') }}",
                    success: function(response) {
                        // Mostrar los datos obtenidos en el div con id 'resultado'
                        $('#resultado').html('<p>Nombre: ' + response.nombre + '</p><p>Edad: ' +
                            response.edad + '</p>');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }); 
        });
    </script>
@stop
