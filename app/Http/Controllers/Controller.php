<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function toggleStatus($tableName, $id)
    {
        // Obtiene el nombre del modelo basado en el nombre de la tabla
        $modelClassName = 'App\\Models\\' . Str::studly(Str::singular($tableName));

        // Verifica si el modelo existe
        if (class_exists($modelClassName)) {
            // Encuentra el registro en la tabla correspondiente
            $record = $modelClassName::find($id);
            if ($record) {
                // Cambia el estado
                $record->status = !$record->status;

                // Guarda el registro actualizado
                $record->save();

                // Redirecciona de nuevo con un mensaje de éxito
                return true;
            }
        }
        // Redirecciona de nuevo con un mensaje de error si no se encuentra el registro o el modelo
        return false;
    }
}
