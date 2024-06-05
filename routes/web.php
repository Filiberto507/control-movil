<?php

use App\Http\Controllers\ExportController;
use App\Http\Livewire\AccesoriostallerController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\ConductorController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\TallerController;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\VehiculosController;
use App\Http\Livewire\DiagnosticoController;
use App\Http\Livewire\DiagnosticoAreaTransporteController;
use App\Http\Livewire\DependenciasController;
use App\Http\Livewire\AccesoriosController;
use App\Http\Livewire\ControlmovilController;
use App\Http\Livewire\DiagnosticoAreaTransportentController;
use App\Http\Livewire\DiagnosticontController;
use App\Http\Livewire\ReporteTallerController;
use App\Http\Livewire\ReporteDiagnosticosController;
use App\Http\Livewire\ReporteNTController;
use App\Http\Livewire\ReporteNTResponsableController;
use App\Http\Livewire\ReporteResponsableController;
use App\Http\Livewire\TrabajoRealizadontController;
use App\Http\Livewire\TrabajoRealizadoTallerController;
use App\Models\DiagnosticoAreaTransportent;
use App\Models\Diagnosticont;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::user()=='')
    {
        return view('auth/login');
    }
    else{
        return view('home');
    }

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('users', UsersController::class)->middleware('role:Admin');
Route::get('roles', RolesController::class)->middleware('role:Admin');
Route::get('permisos', PermisosController::class)->middleware('role:Admin');
Route::get('asignar', AsignarController::class)->middleware('role:Admin');

Route::get('vehiculos', VehiculosController::class);
Route::get('conductor', ConductorController::class);
Route::get('dependencias', DependenciasController::class);
Route::get('acctaller', AccesoriostallerController::class);
Route::get('taller', TallerController::class);
Route::get('trabajorealizadotaller', TrabajoRealizadoTallerController::class);
Route::get('trabajorealizant', TrabajoRealizadontController::class);
Auth::routes();
Route::get('diagnostico/pdf/{id}', [DiagnosticoController::class, 'pdf']);
Route::get('diagnosticont/pdf/{id}', [DiagnosticontController::class, 'pdf']);
Route::get('diagnostico_area_transporte/pdf/{id}', [DiagnosticoAreaTransporteController::class, 'pdf']);
Route::get('diagnostico_transportent/pdf/{id}', [DiagnosticoAreaTransportentController::class, 'pdft']);
Route::get('diagnostico',DiagnosticoController::class);
Route::get('diagnosticont',DiagnosticontController::class);
Route::get('diagnostico_area_transporte',DiagnosticoAreatransporteController::class);
Route::get('diagnostico_area_transportent',DiagnosticoAreaTransportentController::class);
Route::get('control_movil',ControlmovilController::class);

Route::get('reportemaestranza', ReporteTallerController::class);
Route::get('reporte_diagnosticos', ReporteDiagnosticosController::class);
Route::get('reporte_responsable', ReporteResponsableController::class);
Route::get('reportetallernt', ReporteNTController::class);
Route::get('reporteresponsablent', ReporteNTResponsableController::class);
//reporten PDF
Route::get('report/pdf/{id}', [ExportController::class, 'reportPDF']);
Route::get('reportrabajo/pdf/{id}', [ExportController::class, 'reportTrabajo']);

//reporte responsable pdf
Route::get('report_responsable/pdf/{user}/{type}/{fi}/{f2}', [ExportController::class, 'reportResponsable']);
Route::get('report_responsable/pdf/{user}/{type}', [ExportController::class, 'reportResponsable']);
//redirect de taller cuando este habilitado salida
Route::get('/trabajotaller', TrabajoRealizadoTallerController::class);
//trabajo realizado sin taller pdf
Route::get('reportrabajont/pdf/{id}', [ExportController::class, 'reportTrabajoNT']);
//control pdf
Route::get('controlmovil/pdf/{id}/{mes}', [ExportController::class, 'Controlpdf']);


