<?php

use App\Http\Controllers\AircraftController;
use App\Http\Controllers\AircraftTypeController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\AirTrafficController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\TripulationController;
use App\Http\Controllers\UserController;
use App\Models\Aircraft;
use App\Models\AircraftType;
use App\Models\Airport;
use App\Models\AirTraffic;
use App\Models\Position;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

/* Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 */
/* MODULO CONFIG - TABLAS DE MANTENIMIENTO */
Route::resource('airports', AirportController::class);
Route::get('airports/{id}/update-status', [AirportController::class, 'updateStatus']);

Route::resource('cities', CityController::class);
Route::get('cities/{id}/update-status', [CityController::class, 'updateStatus']);

Route::resource('contracts', ContractController::class);
Route::get('contracts/{id}/update-status', [ContractController::class, 'updateStatus']);

Route::resource('departments', DepartmentController::class);
Route::get('departments/{id}/update-status', [DepartmentController::class, 'updateStatus']);

Route::resource('stations', StationController::class);
Route::get('stations/{id}/update-status', [StationController::class, 'updateStatus']);

Route::resource('offices', OfficeController::class);
Route::get('offices/{id}/update-status', [OfficeController::class, 'updateStatus']);

Route::resource('positions', PositionController::class);
Route::get('positions/{id}/update-status', [PositionController::class, 'updateStatus']);

Route::resource('aircraft_types', AircraftTypeController::class);
Route::get('aircraft_types/{id}/update-status', [AircraftTypeController::class, 'updateStatus']);

Route::resource('flights', FlightController::class);
Route::get('flights/{id}/update-status', [FlightController::class, 'updateStatus']);
 //'FlightController@getFlightRoute' http://localhost/ruta-vuelo/1



/* ------------------------------------------------------------------------------------ */
/* RECURSOS HUMANOS */
Route::resource('employees', EmployeeController::class);
Route::get('employees/{id}/update-status', [EmployeeController::class, 'updateStatus']);
Route::get('employees/{id}/profile', [EmployeeController::class, 'viewProfile']);



/* ------------------------------------------------------------------------------------ */
/* USUARIOS */
Route::resource('users', UserController::class);
Route::get('users/{id}/update-status', [UserController::class, 'updateStatus']);



/* ------------------------------------------------------------------------------------ */
/* AIRCRAFTS */
Route::resource('aircrafts', AircraftController::class);



/* ------------------------------------------------------------------------------------ */
/* TRIPULATIONS */
Route::resource('tripulation', TripulationController::class);

/* ------------------------------------------------------------------------------------ */
/* MONITORING */
Route::resource('air_traffic', AirTrafficController::class);



/* ------------------------------------------------------------------------------------ */

//Route::get('/datos', 'DatosController@obtenerDatos')->name('datos.obtener');
Route::get('/datos', [DatosController::class, 'obtenerDatos'])->name('datos.obtener');
//Route::get('/ruta-vuelo/{id}', [FlightController::class, 'getFlightRoute']);
Route::get('/ruta-vuelo/{id}', [FlightController::class, 'getFlightRoute'])->name('ruta.obtener');
Route::get('/obtener-estado-vuelo/{id}', [FlightController::class, 'getFlightStatus'])->name('estado.obtener');

Route::get('/calcular-llegada/{departure_time}', [FlightController::class, 'calculateArrivalTime']);