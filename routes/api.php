<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ConfiguracionFacturacionController;
use App\Http\Controllers\ConsultaScopApiController;
use App\Http\Controllers\DespatchController;

use App\Http\Controllers\EstadoElectronicoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\FactilizaCommonController;
use App\Http\Controllers\MigracionGuiasController;
use App\Http\Controllers\NumeracionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PuntoEmisionController;
use App\Http\Controllers\PuntoUbicacionController;
use App\Http\Controllers\ScopController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SunatParameterController;
use App\Http\Controllers\TokenSunatController;
use App\Http\Controllers\TransportistaController;
use App\Http\Controllers\UbigeoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\WebhookFacturacionController;
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

    // Route::put('/numeracion/gestion/{id}', [NumeracionController::class, 'actualizar']);
    Route::get('/numeracion/actualbypunto', [NumeracionController::class, 'actualbypunto']);
    Route::get('/numeracion/userid', [NumeracionController::class, 'getSeriesByUser']);
    Route::get('/usuario/{id}', [UserController::class, 'getpuntos']);
    Route::put('/despatches/baja/{id}', [DespatchController::class, 'baja']);
    Route::get('/user/buscar', [UserController::class, 'buscar']);

    Route::get('/despatches/buscar', [DespatchController::class, 'buscar']);
    Route::get('/despatches/pdf/{id}', [DespatchController::class, 'showpdf']);

    // Emisión por la API de facturación (ver docs/INTEGRACION-API-GUIAS.md)
    Route::post('/despatches/{id}/enviar', [DespatchController::class, 'enviar']);
    Route::post('/despatches/{id}/consultar', [DespatchController::class, 'consultar']);
    Route::get('/despatches/{id}/archivo', [DespatchController::class, 'archivo']);

    Route::get('/estadoelectronico/buscar', [EstadoElectronicoController::class, 'buscar']);
    Route::get('/estadoelectronico/descargar', [EstadoElectronicoController::class, 'descargar']);
    
    // Consulta al API externo de SCOP: gasta la API key de la empresa, solo con sesión
    Route::post('/scop/consulta', [ConsultaScopApiController::class, 'getData']);
    Route::get('/scop/disponible', [ScopController::class, 'disponible']);
    Route::apiResource('/scop', ScopController::class);

    // Solo perfil admin: ver los favoritos de otro usuario y clonarlos a otro
    Route::middleware('admin')->group(function () {
        Route::get('/favoritos/usuario/{id}', [FavoritoController::class, 'deUsuario']);
        Route::post('/favoritos/clonar', [FavoritoController::class, 'clonar']);

        // Conexión con la API de facturación (URL, token y secreto del webhook)
        Route::get('/empresa/facturacion', [ConfiguracionFacturacionController::class, 'show']);
        Route::put('/empresa/facturacion', [ConfiguracionFacturacionController::class, 'update']);
        Route::post('/empresa/facturacion/probar', [ConfiguracionFacturacionController::class, 'probar']);
    });

    Route::get('/favoritos', [FavoritoController::class, 'index']);
    Route::post('/favoritos', [FavoritoController::class, 'store']);
    Route::put('/favoritos/{tipo}/{id}', [FavoritoController::class, 'update']);
    Route::delete('/favoritos/{tipo}/{id}', [FavoritoController::class, 'destroy']);

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
    Route::get('/migracion/buscar', [MigracionGuiasController::class, 'buscar']);
    Route::get('/migracion/almacenes', [MigracionGuiasController::class, 'almacenes']);
    Route::post('/migracion/migrar', [MigracionGuiasController::class, 'migrar']);
});

// Route::post('/sunat/actualizar', [SunatParameterController::class, 'actualizar']);

Route::post('/convert',[CertificateController::class,'convertPfxToPem'])->name('pfxtopem');
Route::post('/registro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

// Webhook de la API de facturación. Va FUERA de auth:sanctum a propósito: lo
// llama la API, no un usuario. Lo protege la firma X-FE-Signature (HMAC con
// FE_WEBHOOK_SECRET), y el throttle evita que se abuse de la URL pública.
Route::post('/webhooks/facturacion', [WebhookFacturacionController::class, 'facturacion'])
    ->middleware('throttle:120,1');



Route::get('/factiliza/consulta', [FactilizaCommonController::class, 'PersonalDataFactiliza']);
Route::post('/factiliza/masivo', [FactilizaCommonController::class, 'CrearCANT']);


