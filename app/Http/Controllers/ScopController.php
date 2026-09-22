<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScopResource;
use App\Models\Scop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * CRUD de los números de SCOP y a qué guía pertenece cada uno.
 *
 * El guardado de la guía también crea y borra filas aquí (ver
 * DespatchController); este controlador sirve para administrarlas por separado,
 * cuando los números vienen de otra API.
 *
 * Un número no puede estar en dos guías a la vez: eso lo garantiza el índice
 * único de la tabla, y aquí se comprueba antes para dar un mensaje claro.
 */
class ScopController extends Controller
{
    /**
     * Listar números de SCOP
     *
     * Filtros: `nroScop` (coincidencia parcial), `id_despatch`, `serie` y
     * `correlativo` de la guía.
     */
    public function index(Request $request)
    {
        $query = Scop::with('despatch');

        if ($request->filled('nroScop')) {
            $query->where('nroScop', 'like', '%' . $request->input('nroScop') . '%');
        }

        if ($request->filled('id_despatch')) {
            $query->where('id_despatch', $request->input('id_despatch'));
        }

        foreach (['serie', 'correlativo'] as $campo) {
            if ($request->filled($campo)) {
                $query->whereHas('despatch', function ($q) use ($campo, $request) {
                    $q->where($campo, $request->input($campo));
                });
            }
        }

        return ScopResource::collection($query->orderBy('nroScop')->get());
    }

    /**
     * Registrar números de SCOP en una guía
     *
     * Acepta uno (`nroScop`) o varios (`scops`, lista de textos o de objetos
     * con `nroScop`). Los que ya estuvieran en esa misma guía se dejan como
     * están; si alguno pertenece a otra guía no se guarda ninguno y responde 409
     * con el detalle de cuáles y en qué guía están.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_despatch' => 'required|integer|exists:despatches,id',
            'nroScop' => 'required_without:scops',
            'scops' => 'required_without:nroScop',
        ]);

        $idDespatch = $request->input('id_despatch');
        $numeros = Scop::normalizar($request->input('scops', $request->input('nroScop')));

        if (! $numeros) {
            // Mismo formato que el resto de errores de validación (422)
            throw ValidationException::withMessages([
                $request->has('scops') ? 'scops' : 'nroScop' => 'Indica al menos un número de SCOP',
            ]);
        }

        try {
            [$ocupados, $filas] = DB::transaction(function () use ($numeros, $idDespatch) {
                // El lock evita que un guardado simultáneo se lleve el mismo número
                $ocupados = Scop::ocupados($numeros, $idDespatch, true);

                if ($ocupados->isNotEmpty()) {
                    return [$ocupados, collect()];
                }

                $filas = collect($numeros)->map(function ($nroScop) use ($idDespatch) {
                    return Scop::firstOrCreate(
                        ['nroScop' => $nroScop],
                        ['id_despatch' => $idDespatch]
                    );
                });

                return [collect(), $filas];
            });
        } catch (\Illuminate\Database\QueryException $e) {
            // Última red: el índice único rechazó un número que se coló en paralelo
            if (($e->errorInfo[1] ?? null) === 1062) {
                return $this->respuestaOcupado(Scop::ocupados($numeros, $idDespatch));
            }

            throw $e;
        }

        if ($ocupados->isNotEmpty()) {
            return $this->respuestaOcupado($ocupados);
        }

        return response()->json([
            'message' => count($numeros) . ' número(s) de SCOP registrados en la guía ' . $idDespatch,
            'scops' => ScopResource::collection($filas),
            'exito' => true,
        ], 201);
    }

    /**
     * Ver un número de SCOP
     */
    public function show(Scop $scop)
    {
        return new ScopResource($scop->load('despatch'));
    }

    /**
     * Actualizar un número de SCOP
     *
     * Permite corregir el número o moverlo a otra guía. Si el número nuevo ya
     * está en otra fila, responde 409.
     */
    public function update(Request $request, Scop $scop)
    {
        $request->validate([
            'nroScop' => 'sometimes|required|string|max:50',
            'id_despatch' => 'sometimes|required|integer|exists:despatches,id',
        ]);

        if ($request->has('nroScop')) {
            $numero = trim((string) $request->input('nroScop'));
            $ocupados = Scop::ocupados([$numero], null, false, $scop->id);

            if ($ocupados->isNotEmpty()) {
                return $this->respuestaOcupado($ocupados);
            }

            $scop->nroScop = $numero;
        }

        if ($request->has('id_despatch')) {
            $scop->id_despatch = $request->input('id_despatch');
        }

        $scop->save();

        return response()->json([
            'message' => 'Número de SCOP actualizado',
            'scop' => new ScopResource($scop->fresh('despatch')),
            'exito' => true,
        ]);
    }

    /**
     * Borrar un número de SCOP
     *
     * El número queda libre para otra guía.
     */
    public function destroy(Scop $scop)
    {
        $numero = $scop->nroScop;
        $scop->delete();

        return response()->json([
            'message' => "El número de SCOP $numero quedó libre",
            'exito' => true,
        ]);
    }

    /**
     * Comprobar si números de SCOP están libres
     *
     * Pensado para marcar en la lista, antes de guardar la guía, los números
     * que ya están usados en otra guía.
     *
     * `nroScop` acepta uno (`?nroScop=SC-1`) o varios
     * (`?nroScop[]=SC-1&nroScop[]=SC-2`). Al editar una guía, manda también su
     * `id_despatch` para que sus propios números no salgan como ocupados.
     *
     * Respuesta:
     * - `disponible`: true solo si TODOS los números enviados están libres.
     * - `scops`: un elemento por número, en el mismo orden en que se enviaron
     *   (sin vacíos ni repetidos). Si está ocupado, `id_despatch` y `guia`
     *   (serie-correlativo) dicen en qué guía está; si está libre, ambos son null.
     *
     * @response array{disponible: bool, scops: array<int, array{nroScop: string, disponible: bool, id_despatch: int|null, guia: string|null}>, exito: bool}
     */
    public function disponible(Request $request)
    {
        // `nullable` en cada elemento: el middleware convierte "" y "  " en null
        // antes de validar; normalizar() los descarta y, si no queda ninguno,
        // responde el mensaje de abajo.
        $request->validate([
            'nroScop' => 'required',
            'nroScop.*' => 'nullable|string',
            'id_despatch' => 'sometimes|nullable|integer',
        ], [
            'nroScop.required' => 'Indica al menos un número de SCOP',
            'nroScop.*.string' => 'Cada número de SCOP debe ser texto',
            'id_despatch.integer' => 'id_despatch debe ser un número',
        ]);

        $numeros = Scop::normalizar($request->input('nroScop'));

        if (! $numeros) {
            // Mismo formato que el resto de errores de validación (422)
            throw ValidationException::withMessages([
                'nroScop' => 'Indica al menos un número de SCOP',
            ]);
        }

        $ocupados = Scop::ocupados($numeros, $request->input('id_despatch'))
            ->keyBy('nroScop');

        $detalle = [];

        foreach ($numeros as $numero) {
            $fila = $ocupados->get($numero);

            $detalle[] = [
                'nroScop' => $numero,
                'disponible' => $fila === null,
                'id_despatch' => $fila?->id_despatch,
                'guia' => $fila && $fila->despatch
                    ? $fila->despatch->serie . '-' . $fila->despatch->correlativo
                    : null,
            ];
        }

        return response()->json([
            'disponible' => $ocupados->isEmpty(),
            'scops' => $detalle,
            'exito' => true,
        ]);
    }

    /**
     * Respuesta cuando uno o más números ya están en otra guía.
     */
    private function respuestaOcupado($ocupados)
    {
        $detalle = Scop::detalle($ocupados);

        /**
         * Algún número ya está en otra guía: no se guardó nada.
         * `scops` lista cuáles y en qué guía (serie-correlativo) están.
         *
         * @status 409
         * @body array{error: string, message: string, scops: array<int, array{nroScop: string, id_despatch: int, guia: string|null}>, exito: bool}
         */
        return response()->json([
            'error' => 'Número de SCOP ya usado en otra guía.',
            'message' => 'Ya están registrados: ' . $detalle->pluck('nroScop')->implode(', '),
            'scops' => $detalle,
            'exito' => false,
        ], 409);
    }
}
