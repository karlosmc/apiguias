<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Preferencias de un usuario sobre un registro de catálogo: si es favorito y
 * el nombre corto que él le puso (null = usa el del catálogo).
 */
class Favorito extends Model
{
    use HasFactory;

    protected $table = 'favoritos';

    protected $fillable = [
        'id_user',
        'favoritable_type',
        'favoritable_id',
        'fav',
        'nombreCorto',
    ];

    protected $casts = [
        'fav' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function favoritable()
    {
        return $this->morphTo();
    }
}
