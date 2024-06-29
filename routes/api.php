<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\DespatchController;

use App\Http\Controllers\EstadoElectronicoController;
use App\Http\Controllers\FactilizaCommonController;
use App\Http\Controllers\NumeracionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PuntoEmisionController;
use App\Http\Controllers\PuntoUbicacionController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SunatParameterController;
use App\Http\Controllers\TokenSunatController;
use App\Http\Controllers\TransportistaController;
use App\Http\Controllers\UbigeoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use App\Http\Resources\EstadoElectronicoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Route::post('/logout',[AuthController::class,'logout']);

    // //almacenar ordenes

    // Route::apiResource('/pedidos',PedidoController::class);
    // Route::apiResource('/productos',ProductoController::class);
    // Route::apiResource('/categorias',CategoriaController::class);
    Route::get('/productos/buscar', [ProductoController::class, 'buscar']);
    
    Route::get('/puntos/buscar', [PuntoUbicacionController::class, 'buscar']);
    
    Route::get('/clientes/buscar', [ClienteController::class, 'buscar']);
    Route::get('/conductor/buscar', [ConductorController::class, 'buscar']);
    Route::get('/transportistas/buscar', [TransportistaController::class, 'buscar']);
    Route::get('/sunat/parametros', [SunatParameterController::class, 'parametros']);
    Route::get('/vehiculos/buscar', [VehiculoController::class, 'buscar']);

    Route::put('/numeracion/{id}', [NumeracionController::class, 'actualizar']);
    Route::get('/numeracion/actualbypunto', [NumeracionController::class, 'actualbypunto']);
    Route::get('/usuario/{id}', [UserController::class, 'getpuntos']);
    
    Route::apiResource('/productos',ProductoController::class);
    Route::apiResource('/puntos',PuntoUbicacionController::class);
    Route::apiResource('/despatches',DespatchController::class);
    Route::apiResource('/shipments',ShipmentController::class);
    Route::apiResource('/clientes',ClienteController::class);
    Route::apiResource('/conductor',ConductorController::class);
    Route::apiResource('/transportistas',TransportistaController::class);
    Route::apiResource('/sunat',SunatParameterController::class);
    Route::apiResource('/tokensunat',TokenSunatController::class);
    Route::apiResource('/ubigeos',UbigeoController::class);
    Route::apiResource('/vehiculos',VehiculoController::class);
    Route::apiResource('/puntoemision',PuntoEmisionController::class);
    Route::apiResource('/numeracion',NumeracionController::class);
    Route::apiResource('/estadoelectronico',EstadoElectronicoController::class);
    Route::post('/logout',[AuthController::class,'logout']);
});

// Route::post('/sunat/actualizar', [SunatParameterController::class, 'actualizar']);

Route::post('/convert',[CertificateController::class,'convertPfxToPem'])->name('pfxtopem');
Route::post('/registro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);




Route::get('/factiliza/consulta', [FactilizaCommonController::class, 'PersonalDataFactiliza']);


