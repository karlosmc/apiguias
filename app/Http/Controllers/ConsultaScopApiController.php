<?php

namespace App\Http\Controllers;

use App\Exceptions\ScopApiException;
use App\Services\ScopApiService;
use Illuminate\Http\Request;

class ConsultaScopApiController extends Controller
{
    protected $scopApiService;

    public function __construct(ScopApiService $scopApiService)
    {
        $this->scopApiService = $scopApiService;
    }

    /**
     * Consultar SCOP en el API externo
     *
     * Hace de intermediario con el API de SCOP para que la API key no salga del
     * servidor. Ese API tarda 10-18 s porque entra al portal de SCOP en cada
     * consulta, y el tiempo depende de la sucursal y las fechas, no de la placa.
     *
     * Por eso se consulta una sola vez por sucursal, rango y tipos, se guarda en
     * caché y la placa se filtra aquí: otra placa de la misma sucursal y fechas
     * responde al instante (`desde_cache: true`). Un rango ya cerrado se guarda
     * más tiempo que uno que incluye hoy. Con `refrescar: true` se vuelve a
     * consultar el portal.
     *
     * `placa` es opcional: sin ella se devuelven todos los registros. La
     * comparación ignora mayúsculas, guiones y espacios.
     *
     * Errores: 504 si el API no responde a tiempo, 502 si el API o el portal
     * fallan o se rechaza la API key, 503 si una consulta igual en curso no
     * termina, y el propio código del API (p. ej. 404 sucursal sin
     * credenciales) con su mensaje en `message`.
     */
    public function getData(Request $request)
    {
        $validated = $request->validate([
            'sucursal' => ['required', 'string'],
            'fecha_inicio' => ['required', 'date_format:Y-m-d'],
            'fecha_fin' => ['required', 'date_format:Y-m-d', 'after_or_equal:fecha_inicio'],
            'para_liquido' => ['required', 'boolean'],
            'para_glp' => ['required', 'boolean'],
            'placa' => ['sometimes', 'nullable', 'string'],
            'refrescar' => ['sometimes', 'boolean'],
        ]);

        $filtros = [
            'sucursal' => $validated['sucursal'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
            'para_liquido' => (bool) $validated['para_liquido'],
            'para_glp' => (bool) $validated['para_glp'],
            'placa' => $validated['placa'] ?? null,
        ];

        try {
            $resultado = $this->scopApiService->consultar($filtros, (bool) ($validated['refrescar'] ?? false));
        } catch (ScopApiException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return response()->json([
            'success' => true,
            'data' => $resultado['data'],
            'desde_cache' => $resultado['desde_cache'],
        ], 200);
    }
}
