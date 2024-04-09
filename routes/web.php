<?php

use App\Http\Controllers\AircraftController;
use App\Http\Controllers\AircraftTypeController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\TripulationController;
use App\Http\Controllers\UserController;
use App\Models\Aircraft;
use App\Models\AircraftType;
use App\Models\Airport;
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
Route::get('de partments/{id}/update-status', [DepartmentController::class, 'updateStatus']);

Route::resource('stations', StationController::class);
Route::get('stations/{id}/update-status', [StationController::class, 'updateStatus']);

Route::resource('offices', OfficeController::class);
Route::get('offices/{id}/update-status', [OfficeController::class, 'updateStatus']);

Route::resource('positions', PositionController::class);
Route::get('positions/{id}/update-status', [PositionController::class, 'updateStatus']);

Route::resource('aircraft_types', AircraftTypeController::class);
Route::get('aircraft_types/{id}/update-status', [AircraftTypeController::class, 'updateStatus']);




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
Route::get('aircrafts/{id}/update-status', [AircraftController::class, 'updateStatus']);



/* ------------------------------------------------------------------------------------ */
/* TRIPULATIONS */
Route::resource('tripulation', TripulationController::class);

/* ------------------------------------------------------------------------------------ */
/* MONITORING */
Route::resource('monitoring', MonitoringController::class);