<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatosController extends Controller 
{
    public function obtenerDatos()
    {
        // Aquí puedes obtener los datos que deseas enviar de vuelta
        $datos = [
            'nombre' => 'Ejemplo',
            'edad' => 25
        ];

        // Retornar los datos en formato JSON
        return response()->json($datos);
    }
}
