<?php

use App\Http\Controllers\AircraftController;
use App\Http\Controllers\AircraftTypeController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\AirTrafficController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FlightRouteController;
use App\Http\Controllers\FlightRouteDetailController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\UserController;
use App\Models\Aircraft;
use App\Models\AircraftType;
use App\Models\Airport;
use App\Models\AirTraffic;
use App\Models\FlightRouteDetail;
use App\Models\Position;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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


/* Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    /* ----------------------------------------------------------------------------------- */

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /* MODULO CONFIG - TABLAS DE MANTENIMIENTO */
    Route::resource('airports', AirportController::class)->names('config.airports');
    Route::get('airports/{id}/update-status', [AirportController::class, 'updateStatus'])->middleware('can:config.airports.updateStatus')->name('config.airports.updateStatus');

    Route::resource('cities', CityController::class)->names('config.cities');
    Route::get('cities/{id}/update-status', [CityController::class, 'updateStatus'])->middleware('can:config.cities.updateStatus')->name('config.cities.updateStatus');

    Route::resource('contracts', ContractController::class)->names('config.contracts');
    Route::get('contracts/{id}/update-status', [ContractController::class, 'updateStatus'])->middleware('can:config.contracts.updateStatus')->name('config.contracts.updateStatus');

    Route::resource('departments', DepartmentController::class)->names('config.departments');
    Route::get('departments/{id}/update-status', [DepartmentController::class, 'updateStatus'])->middleware('can:config.departments.updateStatus')->name('config.departments.updateStatus');

    Route::resource('stations', StationController::class)->names('config.stations');
    Route::get('stations/{id}/update-status', [StationController::class, 'updateStatus'])->middleware('can:config.stations.updateStatus')->name('config.stations.updateStatus');

    Route::resource('offices', OfficeController::class)->names('config.offices');
    Route::get('offices/{id}/update-status', [OfficeController::class, 'updateStatus'])->middleware('can:config.offices.updateStatus')->name('config.offices.updateStatus');

    Route::resource('positions', PositionController::class)->names('config.positions');
    Route::get('positions/{id}/update-status', [PositionController::class, 'updateStatus'])->middleware('can:config.positions.updateStatus')->name('config.positions.updateStatus');

    Route::resource('aircraft_types', AircraftTypeController::class)->names('config.aircraft_types');
    Route::get('aircraft_types/{id}/update-status', [AircraftTypeController::class, 'updateStatus'])->middleware('can:config.aircraft_types.updateStatus')->name('config.aircraft_types.updateStatus');

    Route::resource('flights', FlightController::class)->names('config.flights');
    Route::get('flights/{id}/update-status', [FlightController::class, 'updateStatus'])->middleware('can:config.flights.updateStatus')->name('config.flights.updateStatus');

    Route::resource('flight_routes', FlightRouteController::class)->names('config.flight_routes');
    Route::get('flight_routes/{id}/update-status', [FlightRouteController::class, 'updateStatus'])->middleware('can:config.flight_routes.updateStatus')->name('config.flight_routes.updateStatus');

    Route::resource('flight_route_details', FlightRouteDetailController::class)->names('config.flight_route_details');
    Route::get('flight_route_details/{id}/update-status', [FlightRouteDetailController::class, 'updateStatus'])->middleware('can:config.flight_route_details.updateStatus')->name('config.flight_route_details.updateStatus');

    /* ------------------------------------------------------------------------------------ */
    /* RECURSOS HUMANOS */
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/{id}/update-status', [EmployeeController::class, 'updateStatus'])->middleware('can:employees.updateStatus')->name('employees.updateStatus');
    Route::get('employees/{id}/profile', [EmployeeController::class, 'viewProfile'])->middleware('can:employees.profile')->name('employees.profile');
    Route::get('/search-employees', [EmployeeController::class, 'search'])->middleware('can:employees.search')->name('employees.search');
    Route::post('employees/{employee}/update-photo', [EmployeeController::class, 'updatePhoto'])->name('employees.update-photo');

    /* ------------------------------------------------------------------------------------ */
    /* USUARIOS */
    Route::resource('users', UserController::class)->names('admin.users');
    Route::get('users/{id}/update-status', [UserController::class, 'updateStatus'])->middleware('can:admin.users.updateStatus')->name('admin.users.updateStatus');
    Route::post('/check-username', [UserController::class, 'checkUsername'])->name('admin.username.check');

    /* ------------------------------------------------------------------------------------ */
    /* AIRCRAFTS */
    Route::resource('aircrafts', AircraftController::class);
    Route::get('aircrafts/{id}/update-status', [AircraftController::class, 'updateStatus'])->middleware('can:aircrafts.updateStatus')->name('aircrafts.updateStatus');


    /* ------------------------------------------------------------------------------------ */
    /* CREWS */
    /* Route::resource('pilots', CrewController::class);
    Route::resource('flight-assistants', CrewController::class); */
    Route::get('/pilots', [CrewController::class, 'getPilots'])->name('crews.pilots'); //crews.addLicense
    Route::get('/pilots-add-license', [CrewController::class, 'addLicense'])->name('crews.addLicense');
    /* Route::get('/pilots-add-type-ratings', [CrewController::class, 'addTypeRating'])->name('crews.addTypeRating'); */
    Route::get('/flight-assistants', [CrewController::class, 'getFlightAssistants'])->name('crews.flightAssistants');
    /* ------------------------------------------------------------------------------------ */
    /* MONITORING */
    Route::resource('air_traffic', AirTrafficController::class);
    Route::get('/consumo-combustible', [AirTrafficController::class, 'getFuelConsumption'])->name('consumo.combustible');
    Route::get('/remanente-combustible', [AirTrafficController::class, 'getResidualFuel'])->name('remanente.combustible');
    Route::get('/refueling-combustible', [AirTrafficController::class, 'getInitialFuel'])->name('refueling.combustible');
    Route::post('/air_traffic/filter', [AirTrafficController::class, 'filter'])->name('air_traffic.filter');

    /* ------------------------------------------------------------------------------------ */


    Route::get('/datos', [DatosController::class, 'obtenerDatos'])->name('datos.obtener');
    Route::get('/ruta-vuelo/{id}', [FlightController::class, 'getFlightRoute'])->name('ruta.obtener');
    Route::get('/obtener-estado-vuelo/{id}', [FlightController::class, 'getFlightStatus'])->name('estado.obtener');
    Route::get('/calcular-llegada/{departure_time}', [FlightController::class, 'calculateArrivalTime']);

    /* ----------------------------------------------------------------------------------- */

    /* REPORTS */

    /* ---------------------------------------------------------------------------------------- */

    /* INDEX */
    Route::get('/daily-report', [ReportController::class, 'dailyReport'])->name('reports.daily'); //pendiente crear permiso

    /* PDFS */
    /* --------------------------------------------------------------------------------------- */

    /* EXPORTS */
    Route::get('/export-air-traffic', [ExportController::class, 'export'])->middleware('can:export.daily')->name('export.daily');
    Route::get('/reporte/pdf', [ExportController::class, 'generatePDF'])->middleware('can:report.flight')->name('reports.flight');
    Route::get('/reporte/aircraft-history/pdf', [ExportController::class, 'aircraftHistoryPDF'])->middleware('can:reports.aircraft_history')->name('reports.aircraft_history');
    Route::get('/reporte/aircraft-fuelings/pdf', [ExportController::class, 'fuelingsPDF'])->middleware('can:reports.aircraft_fuelings')->name('reports.aircraft_fuelings');
    Route::get('/reporte/crew-history/pdf', [ExportController::class, 'crewHistoryPDF'])->middleware('can:reports.crew_history')->name('reports.crew_history');
    Route::post('/reporte/crew-flight-time/pdf', [ExportController::class, 'crewFlightTimePDF'])->middleware('can:reports.crew_flight_time')->name('reports.crew_flight_time');
    Route::post('/reporte/assigned-crews/pdf', [ExportController::class, 'assignedCrewPDF'])->middleware('can:reports.assigned_crews')->name('reports.assigned_crews');

    /* DASHBOARD GRAFICOS */
    Route::get('/flights-chart-data', [ChartController::class, 'flightsChartData'])->name('charts.flights');
    Route::get('/fuelings-chart-data', [ChartController::class, 'fuelingsChartData'])->name('charts.fuelings');
});

require __DIR__ . '/auth.php';
