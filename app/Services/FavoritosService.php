<?php

namespace App\Services;

use App\Models\Favorito;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\DB;

/**
 * Operaciones sobre favoritos de OTROS usuarios (las usa un admin).
 *
 * Ojo: aquí no se puede leer `$modelo->nombreCorto` ni `$modelo->fav`, porque
 * esos accesores responden por el usuario autenticado (el admin), no por el
 * usuario del que se habla. Se lee directo de la fila de favoritos.
 */
class FavoritosService
{
    /**
     * Favoritos de un usuario agrupados por tipo, con lo necesario para
     * mostrarlos en un selector. Siempre trae los 6 tipos, aunque estén vacíos.
     *
     * @return array<string, array<int, array{id: int, nombreCorto: string|null, descripcion: string}>>
     */
    public function deUsuario(int $idUser)
    {
        $filas = Favorito::where('id_user', $idUser)
            ->where('fav', true)
            ->get()
            ->groupBy('favoritable_type');

        $resultado = [];

        foreach (AppServiceProvider::TIPOS_FAVORITOS as $tipo => $clase) {
            $grupo = $filas->get($tipo, collect());

            $modelos = $grupo->isEmpty()
                ? collect()
                : $clase::whereIn('id', $grupo->pluck('favoritable_id'))->get()->keyBy('id');

            $resultado[$tipo] = $grupo
                ->map(function ($fila) use ($modelos, $tipo) {
                    $modelo = $modelos->get($fila->favoritable_id);

                    // El registro ya no existe en el catálogo
                    if (! $modelo) {
                        return null;
                    }

                    return [
                        'id' => $modelo->id,
                        'nombreCorto' => ($fila->nombreCorto !== null && $fila->nombreCorto !== '')
                            ? $fila->nombreCorto
                            : $modelo->nombreCortoGlobal(),
                        'descripcion' => $this->descripcion($tipo, $modelo),
                    ];
                })
                ->filter()
                ->sortBy('nombreCorto', SORT_NATURAL | SORT_FLAG_CASE)
                ->values()
                ->all();
        }

        return $resultado;
    }

    /**
     * Copia a `$destino` los favoritos elegidos de `$origen`.
     *
     * Solo se clona lo que el destino no tiene:
     *   - creados:       el destino no tenía nada de ese registro. Se crea como
     *                    favorito con el nombre corto que tenía el origen.
     *   - marcados:      el destino tenía la fila (solo un nombre propio) pero no
     *                    como favorito. Se marca, sin tocar su nombre.
     *   - omitidos:      el destino ya lo tenía de favorito. No se toca.
     *   - no_encontrados: el id no es favorito del origen.
     *
     * @param  array<string, array<int, int>>  $seleccion  tipo => ids
     * @return array<string, array{creados: array<int, int>, marcados: array<int, int>, omitidos: array<int, int>, no_encontrados: array<int, int>}>
     */
    public function clonar(int $origen, int $destino, array $seleccion)
    {
        return DB::transaction(function () use ($origen, $destino, $seleccion) {
            $ahora = now();
            $detalle = [];

            foreach ($seleccion as $tipo => $ids) {
                $ids = array_values(array_unique(array_map('intval', $ids)));
                $resultado = ['creados' => [], 'marcados' => [], 'omitidos' => [], 'no_encontrados' => []];

                if (! $ids) {
                    $detalle[$tipo] = $resultado;
                    continue;
                }

                $deOrigen = Favorito::where('id_user', $origen)
                    ->where('favoritable_type', $tipo)
                    ->where('fav', true)
                    ->whereIn('favoritable_id', $ids)
                    ->get()
                    ->keyBy('favoritable_id');

                $resultado['no_encontrados'] = array_values(array_diff($ids, $deOrigen->keys()->all()));

                // El lock evita duplicar si dos admins clonan lo mismo a la vez
                $enDestino = Favorito::where('id_user', $destino)
                    ->where('favoritable_type', $tipo)
                    ->whereIn('favoritable_id', $deOrigen->keys()->all())
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('favoritable_id');

                $nuevos = [];
                $porMarcar = [];

                foreach ($deOrigen as $id => $fila) {
                    $existente = $enDestino->get($id);

                    if (! $existente) {
                        $nuevos[] = [
                            'id_user' => $destino,
                            'favoritable_type' => $tipo,
                            'favoritable_id' => $id,
                            'fav' => true,
                            'nombreCorto' => $fila->nombreCorto,
                            'created_at' => $ahora,
                            'updated_at' => $ahora,
                        ];
                        $resultado['creados'][] = (int) $id;
                    } elseif ($existente->fav) {
                        $resultado['omitidos'][] = (int) $id;
                    } else {
                        $porMarcar[] = $existente->id;
                        $resultado['marcados'][] = (int) $id;
                    }
                }

                foreach (array_chunk($nuevos, 500) as $lote) {
                    Favorito::insert($lote);
                }

                if ($porMarcar) {
                    Favorito::whereIn('id', $porMarcar)->update(['fav' => true, 'updated_at' => $ahora]);
                }

                $detalle[$tipo] = $resultado;
            }

            return $detalle;
        });
    }

    /**
     * Texto para reconocer el registro en la lista, según el tipo.
     */
    private function descripcion(string $tipo, $modelo)
    {
        $partes = match ($tipo) {
            'cliente', 'transportista' => [$modelo->numDoc, $modelo->rznSocial],
            'conductor' => [$modelo->nroDoc, trim($modelo->nombres . ' ' . $modelo->apellidos)],
            'producto' => [$modelo->codigo, $modelo->descripcion],
            'punto' => [$modelo->ruc, $modelo->rznSocial, $modelo->direccion],
            'vehiculo' => [$modelo->placa],
            default => [],
        };

        $partes = array_filter(array_map(fn ($p) => trim((string) $p), $partes), fn ($p) => $p !== '');

        return implode(' - ', $partes);
    }
}
