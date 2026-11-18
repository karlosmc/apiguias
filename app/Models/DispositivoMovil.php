<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Celular con sesión en la app Android: su llave pública y el token de esa
 * sesión. Revocarlo borra el token (la app tiene que volver a iniciar sesión).
 */
class DispositivoMovil extends Model
{
    protected $table = 'dispositivos_moviles';

    protected $fillable = [
        'id_user',
        'nombre',
        'llavePublica',
        'id_token',
        'ultimoAcceso',
        'revocadoEn',
    ];

    protected $hidden = [
        'llavePublica',
    ];

    protected $casts = [
        'ultimoAcceso' => 'datetime',
        'revocadoEn' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function token()
    {
        return $this->belongsTo(PersonalAccessToken::class, 'id_token');
    }

    /** Borra el token de la sesión y lo marca como revocado. */
    public function revocar()
    {
        if ($this->id_token) {
            PersonalAccessToken::whereKey($this->id_token)->delete();
        }

        $this->revocadoEn = $this->revocadoEn ?? now();
        $this->save();
    }
}
