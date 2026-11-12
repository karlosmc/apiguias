<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\User;
use App\Providers\AppServiceProvider;
use App\Services\FavoritosService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Preferencias del usuario autenticado sobre cualquiera de los catálogos
 * (productos, clientes, puntos, conductores, transportistas, vehículos):
 * si es favorito y el nombre corto que él le puso.
 *
 * Los admin además pueden ver los favoritos de otro usuario y clonarlos.
 *
 * Con FAVORITOS_POR_USUARIO=false (por defecto, ver config/favoritos.php) las
 * mismas rutas trabajan sobre las columnas compartidas `fav` y `nombreCorto`
 * de cada catálogo, como antes; clonar no copia nada porque todos ven lo mismo.
 */
class FavoritoController extends Controller
{
    /**
     * Nombres alternativos aceptados en el parámetro `tipo`, para que el
     * frontend pueda mandar el mismo nombre que usa en sus rutas.
     */
    private const SINONIMOS = [
        'productos' => 'producto',
        'clientes' => 'cliente',
        'puntos' => 'punto',
        'puntoubicacion' => 'punto',
        'conductores' => 'conductor',
        'transportistas' => 'transportista',
        'vehiculos' => 'vehiculo',
    ];

    protected $favoritosService;

    public function __construct(FavoritosService $favoritosService)
    {
        $this->favoritosService = $favoritosService;
    }

    /**
     * Listar preferencias
     *
     * `favoritos` trae los ids marcados como favorito, agrupados por tipo.
     * `nombresCortos` trae, por tipo, `{id: nombre}` con el nombre corto que ve
     * el usuario en cada registro donde tiene preferencias guardadas (una copia
     * del catálogo salvo que él le haya puesto otro). Con `?tipo=producto` se
     * limita a un solo catálogo.
     */
    public function index(Request $request)
    {
        $tipo = null;

        if ($request->filled('tipo')) {
            $tipo = $this->normalizarTipo($request->input('tipo'));

            if (! $tipo) {
                return $this->tipoInvalido($request->input('tipo'));
            }
        }

        if (! FavoritosService::porUsuario()) {
            return response()->json($this->indexCompartido($tipo));
        }

        $query = Favorito::where('id_user', Auth::id());

        if ($tipo) {
            $query->where('favoritable_type', $tipo);
        }

        $filas = $query->get(['favoritable_type', 'favoritable_id', 'fav', 'nombreCorto']);

        $favoritos = $filas->where('fav', true)
            ->groupBy('favoritable_type')
            ->map(function ($grupo) {
                return $grupo->pluck('favoritable_id')->values();
            });

        $nombresCortos = $filas->filter(function ($fila) {
            return $fila->nombreCorto !== null && $fila->nombreCorto !== '';
        })
            ->groupBy('favoritable_type')
            ->map(function ($grupo) {
                return $grupo->pluck('nombreCorto', 'favoritable_id');
            });

        return response()->json([
            'favoritos' => $favoritos,
            'nombresCortos' => $nombresCortos,
        ]);
    }

    /**
     * Marcar o desmarcar un favorito
     *
     * Afecta solo al usuario autenticado. Si no se envía `fav` alterna el estado
     * actual; si se envía, lo fuerza a ese valor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'id' => 'required|integer',
        ]);

        $modelo = $this->buscarModelo($request->input('tipo'), $request->input('id'));

        if (! $modelo instanceof Model) {
            return $modelo;
        }

        if ($request->has('fav')) {
            $modelo->aplicarFavorito($request->input('fav'));
        } elseif ($modelo->esFavoritoDe()) {
            $modelo->desmarcarFavorito();
        } else {
            $modelo->marcarFavorito();
        }

        return response()->json([
            'message' => $modelo->fav ? 'Agregado a favoritos' : 'Quitado de favoritos',
            'exito' => true,
        ] + $this->estado($request->input('tipo'), $modelo));
    }

    /**
     * Actualizar preferencias
     *
     * Guarda para el usuario autenticado lo que se envíe: `fav` y/o
     * `nombreCorto`. Un `nombreCorto` vacío vuelve al nombre del catálogo. No
     * alterna nada: lo que no se envía no cambia.
     */
    public function update(Request $request, $tipo, $id)
    {
        $request->validate([
            'fav' => 'sometimes|nullable|boolean',
            'nombreCorto' => 'sometimes|nullable|string|max:255',
        ]);

        $modelo = $this->buscarModelo($tipo, $id);

        if (! $modelo instanceof Model) {
            return $modelo;
        }

        if ($request->has('fav')) {
            $modelo->aplicarFavorito($request->input('fav'));
        }

        if ($request->has('nombreCorto')) {
            $modelo->aplicarNombreCorto($request->input('nombreCorto'));
        }

        return response()->json([
            'message' => 'Preferencias actualizadas',
            'exito' => true,
        ] + $this->estado($tipo, $modelo));
    }

    /**
     * Quitar un favorito
     *
     * Desmarca el registro para el usuario autenticado; conserva su nombre
     * corto propio si lo tiene. Los demás usuarios no se ven afectados.
     */
    public function destroy($tipo, $id)
    {
        $modelo = $this->buscarModelo($tipo, $id);

        if (! $modelo instanceof Model) {
            return $modelo;
        }

        $modelo->desmarcarFavorito();

        return response()->json([
            'message' => 'Quitado de favoritos',
            'exito' => true,
        ] + $this->estado($tipo, $modelo));
    }

    /**
     * Ver los favoritos de un usuario (solo admin)
     *
     * Para armar el selector de "clonar favoritos": trae los favoritos del
     * usuario agrupados por tipo (siempre los 6: `cliente`, `conductor`,
     * `transportista`, `producto`, `punto`, `vehiculo`), cada uno con su `id`,
     * el `nombreCorto` que ve ese usuario y una `descripcion` para reconocerlo
     * (documento y razón social, nombre del conductor, código y descripción del
     * producto, dirección del punto o placa). Ordenados por nombre corto.
     *
     * @response array{usuario: array{id: int, name: string, perfil: string}, favoritos: array<string, array<int, array{id: int, nombreCorto: string|null, descripcion: string}>>, exito: bool}
     */
    public function deUsuario($id)
    {
        $usuario = User::find($id);

        if (! $usuario) {
            return response()->json([
                'error' => "No existe el usuario con id $id",
                'exito' => false,
            ], 404);
        }

        return response()->json([
            'usuario' => [
                'id' => $usuario->id,
                'name' => $usuario->name,
                'perfil' => $usuario->perfil,
            ],
            'favoritos' => $this->favoritosService->deUsuario($usuario->id),
            'exito' => true,
        ]);
    }

    /**
     * Clonar favoritos a otro usuario (solo admin)
     *
     * Copia a `id_user_destino` los favoritos elegidos de `id_user_origen`.
     * En `favoritos` va, por tipo, la lista de ids a copiar; se puede mandar uno
     * o varios tipos y uno o varios ids en cada uno:
     *
     * `{"cliente": [12, 15], "conductor": [3], "vehiculo": [7, 8]}`
     *
     * Solo se copia lo que el destino no tiene. El detalle por tipo dice qué
     * pasó con cada id:
     * - `creados`: se agregó como favorito, con el nombre corto del origen.
     * - `marcados`: el destino ya lo tenía con nombre propio pero sin favorito;
     *   se marcó como favorito conservando su nombre.
     * - `omitidos`: el destino ya lo tenía como favorito; no se tocó.
     * - `no_encontrados`: ese id no es favorito del usuario origen.
     *
     * @response array{message: string, id_user_origen: int, id_user_destino: int, resumen: array{creados: int, marcados: int, omitidos: int, no_encontrados: int}, detalle: array<string, array{creados: array<int, int>, marcados: array<int, int>, omitidos: array<int, int>, no_encontrados: array<int, int>}>, exito: bool}
     */
    public function clonar(Request $request)
    {
        $request->validate([
            'id_user_origen' => 'required|integer|exists:users,id',
            'id_user_destino' => 'required|integer|exists:users,id|different:id_user_origen',
            'favoritos' => 'required|array|min:1',
            'favoritos.*' => 'array',
            'favoritos.*.*' => 'integer',
        ], [
            'id_user_origen.exists' => 'El usuario origen no existe',
            'id_user_destino.exists' => 'El usuario destino no existe',
            'id_user_destino.different' => 'El usuario destino debe ser distinto del origen',
            'favoritos.required' => 'Elige al menos un favorito para clonar',
            'favoritos.*.array' => 'Cada tipo debe traer una lista de ids',
            'favoritos.*.*.integer' => 'Los ids de favoritos deben ser números',
        ]);

        $seleccion = [];

        foreach ($request->input('favoritos') as $tipo => $ids) {
            $alias = $this->normalizarTipo($tipo);

            if (! $alias) {
                throw ValidationException::withMessages([
                    "favoritos.$tipo" => "Tipo de favorito no válido: '$tipo'. Válidos: "
                        . implode(', ', array_keys(AppServiceProvider::TIPOS_FAVORITOS)),
                ]);
            }

            // "clientes" y "cliente" pueden venir a la vez: se juntan
            $seleccion[$alias] = array_merge($seleccion[$alias] ?? [], (array) $ids);
        }

        if (! collect($seleccion)->flatten()->count()) {
            throw ValidationException::withMessages([
                'favoritos' => 'Elige al menos un favorito para clonar',
            ]);
        }

        $origen = (int) $request->input('id_user_origen');
        $destino = (int) $request->input('id_user_destino');

        $detalle = $this->favoritosService->clonar($origen, $destino, $seleccion);

        $resumen = [];
        foreach (['creados', 'marcados', 'omitidos', 'no_encontrados'] as $clave) {
            $resumen[$clave] = collect($detalle)->sum(fn ($tipo) => count($tipo[$clave]));
        }

        $nombreDestino = User::whereKey($destino)->value('name');
        $copiados = $resumen['creados'] + $resumen['marcados'];

        if (! FavoritosService::porUsuario()) {
            $mensaje = "Los favoritos son compartidos por todos los usuarios: $nombreDestino ya ve los mismos";
        } elseif ($copiados) {
            $mensaje = "Se copiaron $copiados favorito(s) a $nombreDestino";
        } else {
            $mensaje = "$nombreDestino ya tenía todos los favoritos elegidos";
        }

        return response()->json([
            'message' => $mensaje,
            'id_user_origen' => $origen,
            'id_user_destino' => $destino,
            'resumen' => $resumen,
            'detalle' => $detalle,
            'exito' => true,
        ]);
    }

    /**
     * Modo compartido (config favoritos.por_usuario = false): mismo formato que
     * el modo por usuario, pero leído de las columnas `fav` y `nombreCorto` de
     * cada catálogo. `nombresCortos` trae solo los de los favoritos.
     */
    private function indexCompartido($soloTipo = null)
    {
        $favoritos = [];
        $nombresCortos = [];

        foreach (AppServiceProvider::TIPOS_FAVORITOS as $tipo => $clase) {
            if ($soloTipo && $tipo !== $soloTipo) {
                continue;
            }

            $filas = $clase::where('fav', true)->get(['id', 'nombreCorto']);

            if ($filas->isEmpty()) {
                continue;
            }

            $favoritos[$tipo] = $filas->pluck('id')->values();

            $nombres = $filas->filter(fn ($fila) => $fila->nombreCorto !== null && $fila->nombreCorto !== '')
                ->pluck('nombreCorto', 'id');

            if ($nombres->isNotEmpty()) {
                $nombresCortos[$tipo] = $nombres;
            }
        }

        return [
            'favoritos' => collect($favoritos),
            'nombresCortos' => collect($nombresCortos),
        ];
    }

    /**
     * Estado de las preferencias del usuario sobre un registro.
     */
    private function estado($tipo, Model $modelo)
    {
        return [
            'tipo' => $this->normalizarTipo($tipo),
            'id' => $modelo->getKey(),
            'fav' => $modelo->fav,
            'nombreCorto' => $modelo->nombreCorto,
            'nombreCortoGlobal' => $modelo->nombreCortoGlobal(),
        ];
    }

    private function normalizarTipo($tipo)
    {
        $tipo = strtolower(trim((string) $tipo));
        $tipo = self::SINONIMOS[$tipo] ?? $tipo;

        return array_key_exists($tipo, AppServiceProvider::TIPOS_FAVORITOS) ? $tipo : null;
    }

    /**
     * Devuelve el modelo, o una respuesta de error si el tipo/id no existen.
     */
    private function buscarModelo($tipo, $id)
    {
        $alias = $this->normalizarTipo($tipo);

        if (! $alias) {
            return $this->tipoInvalido($tipo);
        }

        $clase = AppServiceProvider::TIPOS_FAVORITOS[$alias];
        $modelo = $clase::find($id);

        if (! $modelo) {
            return response()->json([
                'error' => "No existe un registro de tipo '$alias' con id $id",
                'exito' => false,
            ], 404);
        }

        return $modelo;
    }

    private function tipoInvalido($tipo)
    {
        return response()->json([
            'error' => "Tipo de favorito no válido: '$tipo'",
            'tipos' => array_keys(AppServiceProvider::TIPOS_FAVORITOS),
            'exito' => false,
        ], 422);
    }
}
