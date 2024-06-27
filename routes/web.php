<?php

use App\Http\Controllers\AircraftController;
use App\Http\Controllers\AircraftTypeController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\AirTrafficController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FlightRouteController;
use App\Http\Controllers\FlightRouteDetailController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\TripulationController;
use App\Http\Controllers\UserController;
use App\Models\Aircraft;
use App\Models\AircraftType;
use App\Models\Airport;
use App\Models\AirTraffic;
use App\Models\FlightRouteDetail;
use App\Models\Position;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ----------------------------------------------------------------------------------- */

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

Route::resource('flight_routes', FlightRouteController::class);
Route::get('flight_routes/{id}/update-status', [FlightRouteController::class, 'updateStatus']);

Route::resource('flight_route_details', FlightRouteDetailController::class);
Route::get('flight_route_details/{id}/update-status', [FlightRouteDetailController::class, 'updateStatus']);

/* ------------------------------------------------------------------------------------ */
/* RECURSOS HUMANOS */
Route::resource('employees', EmployeeController::class);
Route::get('employees/{id}/update-status', [EmployeeController::class, 'updateStatus']);
Route::get('employees/{id}/profile', [EmployeeController::class, 'viewProfile']);
Route::get('/search-employees', [EmployeeController::class, 'search'])->name('employees.search');




/* ------------------------------------------------------------------------------------ */
/* USUARIOS */
Route::resource('users', UserController::class);
Route::get('users/{id}/update-status', [UserController::class, 'updateStatus']);



/* ------------------------------------------------------------------------------------ */
/* AIRCRAFTS */
Route::resource('aircrafts', AircraftController::class);
Route::get('aircrafts/{id}/update-status', [AircraftController::class, 'updateStatus']);



/* ------------------------------------------------------------------------------------ */
/* TRIPULATIONS */
Route::resource('tripulation', TripulationController::class);

/* ------------------------------------------------------------------------------------ */
/* MONITORING */
Route::resource('air_traffic', AirTrafficController::class);
Route::get('/consumo-combustible', [AirTrafficController::class, 'getFuelConsumption'])->name('consumo.combustible');
Route::get('/remanente-combustible', [AirTrafficController::class, 'getResidualFuel'])->name('remanente.combustible');
Route::get('/refueling-combustible', [AirTrafficController::class, 'getInitialFuel'])->name('refueling.combustible');
Route::get('air_traffic', [AirTrafficController::class, 'index'])->name('air_traffic.index');
Route::post('/air-traffic/filter', [AirTrafficController::class, 'filter'])->name('air-traffic.filter');




/* ------------------------------------------------------------------------------------ */

//Route::get('/datos', 'DatosController@obtenerDatos')->name('datos.obtener');
Route::get('/datos', [DatosController::class, 'obtenerDatos'])->name('datos.obtener');
//Route::get('/ruta-vuelo/{id}', [FlightController::class, 'getFlightRoute']);
Route::get('/ruta-vuelo/{id}', [FlightController::class, 'getFlightRoute'])->name('ruta.obtener');
Route::get('/obtener-estado-vuelo/{id}', [FlightController::class, 'getFlightStatus'])->name('estado.obtener');

Route::get('/calcular-llegada/{departure_time}', [FlightController::class, 'calculateArrivalTime']);

});

require __DIR__.'/auth.php';
