<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Auditoría: una entrega de credencial PVO a un celular. */
class CredencialPvoAcceso extends Model
{
    protected $table = 'credenciales_pvo_accesos';

    // Solo created_at (lo pone la BD)
    public const UPDATED_AT = null;

    protected $fillable = [
        'id_credencial',
        'id_user',
        'id_dispositivo',
        'ip',
    ];

    public function credencial()
    {
        return $this->belongsTo(CredencialPvo::class, 'id_credencial');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function dispositivo()
    {
        return $this->belongsTo(DispositivoMovil::class, 'id_dispositivo');
    }
}
