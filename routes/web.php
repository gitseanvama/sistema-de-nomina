<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\LoginController;


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

Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('validar',[LoginController::class,'validar'])->name('validar');
Route::get('principal',[LoginController::class,'principal'])->name('principal');
Route::get('cerrarsesion',[LoginController::class,'cerrarsesion'])->name('cerrarsesion');


Route::get('mensaje',[EmpleadosController::class,'mensaje']);
Route::get('controlpago',[EmpleadosController::class,'pago']);
Route::get('nomina/{diast}/{pago}',[EmpleadosController::class,'nomina']);

Route::get('muestrasaludo/{nombre}/{dias}',[EmpleadosController::class,'saludo']);
Route::get('salir',[EmpleadosController::class,'salir'])->name('salirnomina');

Route::get('vb',[EmpleadosController::class,'vb'])->name('vb');
Route::get('altaempleado',[EmpleadosController::class,'altaempleado'])->name('altaempleado');
Route::post('guardarempleado',[EmpleadosController::class,'guardarempleado'])->name('guardarempleado');
Route::get('Eloquent',[EmpleadosController::class,'Eloquent'])->name('Eloquent');
Route::get('reporteempleados',[EmpleadosController::class,'reporteempleados'])->name('reporteempleados');

Route::get('desactivaempleado/{ide}',[EmpleadosController::class,'desactivaempleado'])->name('desactivaempleado');
Route::get('activarempleado/{ide}',[EmpleadosController::class,'activarempleado'])->name('activarempleado');
Route::get('borraempleado/{ide}',[EmpleadosController::class,'borraempleado'])->name('borraempleado');

Route::get('modificaempleado/{ide}',[EmpleadosController::class,'modificaempleado'])->name('modificaempleado');
Route::post('guardacambios',[EmpleadosController::class,'guardacambios'])->name('guardacambios');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/ruta1', function () {
    return "Hola mundo";
});

Route::get('/area', function () {
    $base = 4;
    $altura = 10;
    $area= $base * $altura;
    return $area;
});

Route::get('/area1/{base}/{altura}', 
    function ($base, $altura) {
    $area = $base * $altura;
    return "El area del rectangulo es: " . $area . " con base $base y altura: $altura";
});

/*Route::get('/nomina/{diast}/{pagodiario?}', 
    function ($diast, $pagodiario=null) {
    if($pagodiario==null)
    {
        $pagodiario = 100;
        $nomina = $diast * $pagodiario;
    }else{
        $nomina = $diast * $pagodiario;
    }
    echo "Dias trabajados $diast";
    echo "<br> Pago nomina $pagodiario";
    echo "<br> Total pago $nomina";
});
*/
Route::get('/redic', function () {
    return redirect ('ruta1');
});

Route::redirect('redic2', 'ruta1');

Route::redirect('redic3', 'area1/4/7');

Route::get('/redic4/{base}/{altura}', function ($base,$altura) {
    return redirect ("area1/$base/$altura");
});

Route::redirect('redic5', 'https://www.google.com');