<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenSunat extends Model
{
    use HasFactory;

    protected $table= 'token_sunat';
    
    protected $fillable = [
        'access_token',
        'token_type',
        'expires_in',
        'id_empresa',
        'expiryTime'
    ];
}
