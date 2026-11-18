<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Usuario y contraseña del PVO de Osinergmin de un establecimiento o una placa
 * propia (uno de los dos). Cifrados en la BD con APP_KEY y ocultos en el JSON:
 * solo salen hacia el celular, cifrados para él (MovilController::credencial).
 */
class CredencialPvo extends Model
{
    protected $table = 'credenciales_pvo';

    /** Tipos que acepta la API → [modelo, columna FK]. */
    public const TIPOS = [
        'establecimiento' => [Puntoubicacion::class, 'id_puntoubicacion'],
        'vehiculo' => [Vehiculo::class, 'id_vehiculo'],
    ];

    protected $fillable = [
        'id_puntoubicacion',
        'id_vehiculo',
        'usuario',
        'clave',
        'activo',
        'id_user_actualizo',
    ];

    protected $hidden = [
        'usuario',
        'clave',
    ];

    protected $casts = [
        'usuario' => 'encrypted',
        'clave' => 'encrypted',
        'activo' => 'boolean',
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Puntoubicacion::class, 'id_puntoubicacion');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
    }

    public function accesos()
    {
        return $this->hasMany(CredencialPvoAcceso::class, 'id_credencial');
    }

    /**
     * Establecimiento PROPIO, o vehículo PROPIO y de GLP, de ese tipo e id; o
     * null. Solo las cisternas de GLP llevan credencial PVO.
     *
     * $soloValidos = false lo encuentra aunque ya no cumpla (p. ej. un vehículo
     * al que le quitaron el GLP): sirve para poder borrar su credencial.
     */
    public static function maestro($tipo, $id, $soloValidos = true)
    {
        if (! isset(self::TIPOS[$tipo])) {
            return null;
        }

        [$modelo] = self::TIPOS[$tipo];

        if (! $soloValidos) {
            return $modelo::find($id);
        }

        return static::validos($modelo::query())->find($id);
    }

    /** Filtro de maestros que pueden tener credencial: propios y, si es vehículo, de GLP. */
    public static function validos($query)
    {
        $query->where('isCompany', true);

        if ($query->getModel() instanceof Vehiculo) {
            $query->where('glp', true);
        }

        return $query;
    }

    /** Columna FK del tipo: id_puntoubicacion o id_vehiculo. */
    public static function columna($tipo)
    {
        return self::TIPOS[$tipo][1];
    }
}
