<?php

namespace App\Http\Controllers;

use App\Models\ScopTemporal;
use App\Models\Puntoubicacion;
use App\Services\ScopTemporalSincronizacion;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Carga de SCOP temporales desde otra aplicación. Rutas FUERA de auth:sanctum.
 * Un SCOP (nroScop) es un único registro: las cargas insertan o actualizan.
 *
 *   POST   /api/scop-temporal/verificar     vista previa: nuevos, cambios e iguales (no guarda)
 *   POST   /api/scop-temporal               inserta los nuevos y actualiza los que cambiaron
 *   GET    /api/scop-temporal/lotes         lotes cargados (cuántos y cuándo)
 *   DELETE /api/scop-temporal/lotes/{lote}  borra un lote completo
 *
 * Sin login, pero si en el .env hay SCOP_TEMPORAL_KEY se exige la cabecera
 * `X-Api-Key` con ese valor, o el token de la app móvil (Bearer, ability
 * `movil`). Recomendado: la URL es pública.
 */
class ScopTemporalController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $clave = (string) config('services.scop_temporal.key');

            if ($clave === '' || hash_equals($clave, (string) $request->header('X-Api-Key'))) {
                return $next($request);
            }

            // La app Android sube sus resultados con el token de su sesión
            $usuario = auth('sanctum')->user();
            if ($usuario && $usuario->tokenCan('movil')) {
                return $next($request);
            }

            return response()->json(['exito' => false, 'error' => 'Clave inválida (X-Api-Key) o sesión móvil requerida'], 401);
        });
    }

    /**
     * Cargar SCOP: inserta los nuevos y actualiza los que cambiaron (un SCOP
     * es un único registro; ver ScopTemporalSincronizacion). `lote` es
     * opcional: si no se envía se genera uno; solo se asigna a los nuevos.
     *
     * { "lote": "movil-7-20261116", "registros": [ { "nroScop": "...", "placa": "ABC-123", ... } ] }
     */
    public function store(Request $request, ScopTemporalSincronizacion $sincronizacion)
    {
        $this->validar($request, true);

        $lote = $request->input('lote') ?: (string) Str::uuid();
        $r = $sincronizacion->aplicar($request->input('registros'), $lote);

        $insertados = count($r['nuevos']);
        $actualizados = count($r['cambios']);
        $sinCambios = count($r['iguales']);

        return response()->json([
            'exito' => true,
            'message' => "$insertados nuevos · $actualizados actualizados · $sinCambios sin cambios",
            'lote' => $lote,
            'insertados' => $insertados,
            'actualizados' => $actualizados,
            'sinCambios' => $sinCambios,
            'repetidosEnPeticion' => $r['repetidos'],
            'detalle' => [
                'insertados' => array_map('strval', array_keys($r['nuevos'])),
                'actualizados' => $this->detalleCambios($r['cambios']),
            ],
        ]);
    }

    /**
     * Vista previa de una carga: NO guarda nada. Dice qué SCOP son nuevos,
     * cuáles cambian (antes → después) y cuáles ya están igual, para que la
     * app muestre el resumen antes de enviar.
     */
    public function verificar(Request $request, ScopTemporalSincronizacion $sincronizacion)
    {
        $this->validar($request, false);

        $r = $sincronizacion->analizar($request->input('registros'));

        $nuevos = count($r['nuevos']);
        $cambian = count($r['cambios']);
        $iguales = count($r['iguales']);

        $mensaje = $nuevos + $cambian === 0
            ? "Todo ya está cargado ($iguales)"
            : "$nuevos nuevos · $cambian se actualizan · $iguales ya están cargados";

        return response()->json([
            'exito' => true,
            'mensaje' => $mensaje,
            'resumen' => ['nuevos' => $nuevos, 'actualizan' => $cambian, 'iguales' => $iguales],
            'repetidosEnPeticion' => $r['repetidos'],
            'nuevos' => array_map([ScopTemporalSincronizacion::class, 'aApi'], array_values($r['nuevos'])),
            'cambios' => $this->detalleCambios($r['cambios']),
            'iguales' => $r['iguales'],
        ]);
    }

    private function validar(Request $request, $conLote)
    {
        $maximo = (int) config('services.scop_temporal.max_registros', 2000);

        $reglas = [
            'registros' => "required|array|min:1|max:$maximo",
            'registros.*.nroScop' => 'required|string|max:50',
            'registros.*.factura' => 'nullable|string|max:30',
            'registros.*.proveedor' => 'nullable|string|max:400',
            'registros.*.fechaPedido' => 'nullable|date',
            'registros.*.fechaVenta' => 'nullable|date',
            'registros.*.fechaDespacho' => 'nullable|date',
            'registros.*.estadoPedido' => 'nullable|string|max:100',
            'registros.*.producto' => 'nullable|string|max:200',
            'registros.*.placa' => 'required|string|max:20',
            'registros.*.volumen' => 'nullable|numeric',
            'registros.*.unidadMedida' => 'nullable|string|max:10',
            'registros.*.idEstablecimiento' => 'nullable|integer',
        ];

        if ($conLote) {
            $reglas['lote'] = ['nullable', 'string', 'max:64', 'regex:/^[A-Za-z0-9_.\-]+$/'];
        }

        $request->validate($reglas, [
            'lote.regex' => 'El lote solo admite letras, números, punto, guion y guion bajo.',
        ]);

        // El establecimiento debe existir. Una sola consulta para todos los ids
        // (con `exists` por registro serían hasta 2000 consultas).
        $ids = collect($request->input('registros'))->pluck('idEstablecimiento')
            ->filter(fn ($id) => $id !== null && $id !== '')->map(fn ($id) => (int) $id)->unique();

        if ($ids->isNotEmpty()) {
            $faltan = $ids->diff(Puntoubicacion::whereIn('id', $ids->all())->pluck('id'));

            if ($faltan->isNotEmpty()) {
                $errores = [];
                foreach ($request->input('registros') as $i => $r) {
                    if (isset($r['idEstablecimiento']) && $faltan->contains((int) $r['idEstablecimiento'])) {
                        $errores["registros.$i.idEstablecimiento"] = 'No existe el establecimiento ' . $r['idEstablecimiento'];
                    }
                }

                throw ValidationException::withMessages($errores);
            }
        }
    }

    /** [nroScop => [id, cambios]] → [{nroScop, cambios: {campo: {antes, despues}}}] */
    private function detalleCambios(array $cambios)
    {
        $lista = [];
        foreach ($cambios as $nro => $c) {
            $lista[] = ['nroScop' => (string) $nro, 'cambios' => ScopTemporalSincronizacion::aApi($c['cambios'])];
        }

        return $lista;
    }

    /**
     * Lotes cargados, del más reciente al más antiguo.
     */
    public function lotes()
    {
        $lotes = ScopTemporal::select('lote')
            ->selectRaw('count(*) as registros, min(created_at) as desde, max(created_at) as hasta')
            ->groupBy('lote')
            ->orderByDesc('hasta')
            ->get();

        return response()->json(['exito' => true, 'lotes' => $lotes]);
    }

    /**
     * Borrar un lote completo.
     */
    public function destroyLote($lote)
    {
        $borrados = ScopTemporal::where('lote', $lote)->delete();

        if (! $borrados) {
            return response()->json(['exito' => false, 'error' => "No existe el lote $lote"], 404);
        }

        return response()->json([
            'exito' => true,
            'message' => "Lote $lote eliminado: $borrados registro(s)",
            'borrados' => $borrados,
        ]);
    }

}
