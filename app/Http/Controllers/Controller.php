<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\App;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;


use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function toggleStatus($tableName, $id)
    {
        // Obtiene el nombre del modelo basado en el nombre de la tabla
        $modelClassName = 'App\\Models\\' . Str::studly(Str::singular($tableName));
        //preguntar si es una peticion ajax
        // Verifica si el modelo existe
        if (class_exists($modelClassName) /* or Schema::hasTable($tableName) */) {
            // Encuentra el registro en la tabla correspondiente
            $record = $modelClassName::find($id);
            if ($record) {
                // Cambia el estado
                $record->status = !$record->status;
                $record->user_update = Auth::user()->id; //Auth::user()->id; //id del user de la sesion, cambiar cuando se trabaje en el modelo
                // Guarda el registro actualizado
                $record->save();


                return true; //tiene que retornar una respuesta json (return response()->json(parametros)
                //return dd($record);
                //$record=null;
            }
        }

        return false;
    }
}
