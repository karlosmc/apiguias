<?php

namespace App\Models\Concerns;

use App\Models\Favorito;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Preferencias por usuario sobre un catálogo: favorito y nombre corto propio.
 *
 * Ambas viven en la tabla `favoritos`, una fila por usuario y registro:
 *   - fav:         si el usuario lo tiene marcado como favorito.
 *   - nombreCorto: el nombre corto que ve ese usuario. Al crear la fila se
 *                  copia el del catálogo y cambia solo si el usuario pone otro.
 *                  Si estuviera vacío se usa el del catálogo.
 *
 * `$modelo->fav` y `$modelo->nombreCorto` devuelven el valor del usuario
 * autenticado. Para que los listados no hagan una consulta por fila hay que
 * aplicar el scope conPreferencias() en el query.
 *
 * Las columnas `fav` y `nombreCorto` del catálogo siguen existiendo: `fav`
 * como respaldo del estado anterior y `nombreCorto` como valor por defecto
 * (el que se puso al crear el registro), accesible con nombreCortoGlobal().
 *
 * SWITCH: todo lo anterior aplica solo con `config('favoritos.por_usuario')`
 * en true (FAVORITOS_POR_USUARIO=true). En false (por defecto) se trabaja como
 * antes: `fav` y `nombreCorto` se leen y guardan en las columnas del catálogo,
 * compartidas por todos, y la tabla `favoritos` no se toca. Los métodos y
 * scopes son los mismos en ambos modos, así que los controladores no cambian.
 */
trait TieneFavoritos
{
    /**
     * Fila de favoritos del usuario autenticado, una vez consultada.
     */
    protected $preferencia = null;

    protected $preferenciaCargada = false;

    /**
     * Eloquent la ejecuta al instanciar el modelo (initialize{NombreDelTrait}).
     */
    public function initializeTieneFavoritos()
    {
        $this->hidden[] = 'es_favorito';
        $this->hidden[] = 'nombre_corto_usuario';
    }

    public function favoritos()
    {
        return $this->morphMany(Favorito::class, 'favoritable');
    }

    /**
     * ¿Los favoritos y nombres cortos son por usuario (tabla favoritos) o
     * compartidos en las columnas del catálogo, como antes?
     */
    public static function favoritosPorUsuario()
    {
        return (bool) config('favoritos.por_usuario', false);
    }

    protected static function idUsuarioFavorito($idUser = null)
    {
        return $idUser ?: (Auth::check() ? Auth::id() : null);
    }

    /**
     * Agrega al query las columnas calculadas `es_favorito` y
     * `nombre_corto_usuario` del usuario. Aplicarlo en todos los listados
     * evita una consulta por registro al leer `fav` y `nombreCorto`.
     */
    public function scopeConPreferencias(Builder $query, $idUser = null)
    {
        // Modo compartido: fav y nombreCorto ya vienen en las columnas
        if (! static::favoritosPorUsuario()) {
            return $query;
        }

        $idUser = static::idUsuarioFavorito($idUser);
        $modelo = $query->getModel();

        return $query
            ->withExists(['favoritos as es_favorito' => function ($q) use ($idUser) {
                $q->where('id_user', $idUser)->where('fav', true);
            }])
            ->addSelect(['nombre_corto_usuario' => Favorito::select('nombreCorto')
                ->whereColumn('favoritable_id', $modelo->getQualifiedKeyName())
                ->where('favoritable_type', $modelo->getMorphClass())
                ->where('id_user', $idUser)
                ->limit(1),
            ]);
    }

    /**
     * Filtra por favoritos del usuario. Reemplaza al antiguo where('fav', ...).
     */
    public function scopeFiltrarFavorito(Builder $query, $valor, $idUser = null)
    {
        $favorito = filter_var($valor, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($favorito === null) {
            return $query;
        }

        if (! static::favoritosPorUsuario()) {
            return $query->where($query->getModel()->qualifyColumn('fav'), $favorito);
        }

        $idUser = static::idUsuarioFavorito($idUser);
        $esFavorito = function ($q) use ($idUser) {
            $q->where('id_user', $idUser)->where('fav', true);
        };

        return $favorito
            ? $query->whereHas('favoritos', $esFavorito)
            : $query->whereDoesntHave('favoritos', $esFavorito);
    }

    /**
     * Busca por nombre corto: coincide con el del catálogo o con el que el
     * usuario le puso. Reemplaza al antiguo where('nombreCorto', 'like', ...).
     */
    public function scopeFiltrarNombreCorto(Builder $query, $texto, $idUser = null)
    {
        if ($texto === null || $texto === '') {
            return $query;
        }

        $patron = '%' . $texto . '%';
        $columna = $query->getModel()->qualifyColumn('nombreCorto');

        if (! static::favoritosPorUsuario()) {
            return $query->where($columna, 'like', $patron);
        }

        $idUser = static::idUsuarioFavorito($idUser);

        return $query->where(function ($q) use ($columna, $patron, $idUser) {
            $q->where($columna, 'like', $patron)
                ->orWhereHas('favoritos', function ($f) use ($patron, $idUser) {
                    $f->where('id_user', $idUser)->where('nombreCorto', 'like', $patron);
                });
        });
    }

    /**
     * Fila de preferencias de un usuario (por defecto el autenticado), o null.
     */
    public function preferenciaDe($idUser = null)
    {
        if (! static::favoritosPorUsuario()) {
            return null;
        }

        $actual = static::idUsuarioFavorito();
        $idUser = $idUser ?: $actual;

        if (! $idUser || ! $this->exists) {
            return null;
        }

        $usarCache = $idUser == $actual;

        if ($usarCache && $this->preferenciaCargada) {
            return $this->preferencia;
        }

        $fila = $this->relationLoaded('favoritos')
            ? $this->favoritos->firstWhere('id_user', $idUser)
            : $this->favoritos()->where('id_user', $idUser)->first();

        if ($usarCache) {
            $this->preferencia = $fila;
            $this->preferenciaCargada = true;
        }

        return $fila;
    }

    public function esFavoritoDe($idUser = null)
    {
        if (! static::favoritosPorUsuario()) {
            return (bool) ($this->attributes['fav'] ?? false);
        }

        return (bool) optional($this->preferenciaDe($idUser))->fav;
    }

    public function marcarFavorito($idUser = null)
    {
        return $this->guardarPreferencia(['fav' => true], $idUser);
    }

    /**
     * Quita el favorito pero conserva el nombre corto propio, si lo hay.
     */
    public function desmarcarFavorito($idUser = null)
    {
        return $this->guardarPreferencia(['fav' => false], $idUser);
    }

    /**
     * Marca o desmarca según el valor recibido del formulario.
     */
    public function aplicarFavorito($valor, $idUser = null)
    {
        // null = el campo no vino en la petición: no se toca. Ojo, filter_var()
        // convierte null en false, y sin esta guarda un PUT que no mandaba `fav`
        // desmarcaba el favorito.
        if ($valor === null || $valor === '') {
            return $this;
        }

        $favorito = filter_var($valor, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($favorito === null) {
            return $this;
        }

        return $favorito ? $this->marcarFavorito($idUser) : $this->desmarcarFavorito($idUser);
    }

    /**
     * Guarda el nombre corto que verá el usuario. Vacío vuelve al del catálogo.
     */
    public function aplicarNombreCorto($valor, $idUser = null)
    {
        $valor = trim((string) $valor);

        // Modo compartido: vacío no borra el nombre del catálogo, lo deja igual
        if (! static::favoritosPorUsuario()) {
            return $valor === '' ? $this : $this->guardarPreferencia(['nombreCorto' => $valor], $idUser);
        }

        $nombre = $valor === '' ? $this->nombreCortoGlobal() : $valor;

        return $this->guardarPreferencia(['nombreCorto' => $nombre], $idUser);
    }

    /**
     * El nombre corto del catálogo, sin la preferencia del usuario. Es el que
     * hay que usar para integraciones (p. ej. la migración a FAFIO).
     */
    public function nombreCortoGlobal()
    {
        return $this->attributes['nombreCorto'] ?? null;
    }

    /**
     * ¿El nombre difiere del del catálogo? (o sea, lo personalizó el usuario)
     */
    protected function esNombrePropio($nombre)
    {
        return $nombre !== null && $nombre !== '' && $nombre !== (string) $this->nombreCortoGlobal();
    }

    /**
     * Crea, actualiza o borra la fila de preferencias del usuario.
     */
    protected function guardarPreferencia(array $cambios, $idUser = null)
    {
        if (! static::favoritosPorUsuario()) {
            return $this->guardarEnCatalogo($cambios);
        }

        $idUser = static::idUsuarioFavorito($idUser);

        if (! $idUser || ! $this->exists) {
            return $this;
        }

        $fila = Favorito::firstOrNew([
            'id_user' => $idUser,
            'favoritable_type' => $this->getMorphClass(),
            'favoritable_id' => $this->getKey(),
        ]);

        if (! $fila->exists) {
            $fila->fav = false;
            // La fila guarda el nombre que ve el usuario: arranca con el del catálogo
            $fila->nombreCorto = $this->nombreCortoGlobal();
        }

        $fila->fill($cambios);

        // Sin favorito y con el mismo nombre que el catálogo, la fila no aporta nada
        if (! $fila->fav && ! $this->esNombrePropio($fila->nombreCorto)) {
            if ($fila->exists) {
                $fila->delete();
            }
            $fila = null;
        } else {
            $fila->save();
        }

        if ($idUser == static::idUsuarioFavorito()) {
            $this->preferencia = $fila;
            $this->preferenciaCargada = true;
            // Los valores calculados por conPreferencias() ya no son válidos
            unset($this->attributes['es_favorito'], $this->attributes['nombre_corto_usuario']);
        }

        $this->unsetRelation('favoritos');

        return $this;
    }

    /**
     * Modo compartido: guarda `fav` / `nombreCorto` en las columnas del
     * catálogo, como se hacía antes. Afecta a todos los usuarios.
     */
    protected function guardarEnCatalogo(array $cambios)
    {
        if (! $this->exists) {
            return $this;
        }

        $this->forceFill($cambios);

        if ($this->isDirty(array_keys($cambios))) {
            $this->save();
        }

        return $this;
    }

    /**
     * `fav` ya no devuelve la columna compartida sino el favorito del usuario.
     */
    public function getFavAttribute($value)
    {
        if (! static::favoritosPorUsuario()) {
            return (bool) $value;
        }

        if (array_key_exists('es_favorito', $this->attributes)) {
            return (bool) $this->attributes['es_favorito'];
        }

        return $this->esFavoritoDe();
    }

    /**
     * `nombreCorto` devuelve el que ve el usuario, o el del catálogo si no hay.
     */
    public function getNombreCortoAttribute($value)
    {
        if (! static::favoritosPorUsuario()) {
            return $value;
        }

        $propio = array_key_exists('nombre_corto_usuario', $this->attributes)
            ? $this->attributes['nombre_corto_usuario']
            : optional($this->preferenciaDe())->nombreCorto;

        return ($propio !== null && $propio !== '') ? $propio : $value;
    }

    /**
     * Eloquent solo aplica en toArray() los accesores cuyo atributo está en
     * snake_case; `nombreCorto` va en camelCase, así que se aplica a mano.
     * Sin esto, las respuestas que serializan el modelo entero (ProductoResource
     * con parent::toArray, los store que devuelven el modelo) mostrarían el
     * nombre global.
     */
    public function attributesToArray()
    {
        $atributos = parent::attributesToArray();

        if (array_key_exists('nombreCorto', $atributos)) {
            $atributos['nombreCorto'] = $this->getAttribute('nombreCorto');
        }

        return $atributos;
    }
}
