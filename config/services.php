<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // API externo de SCOP (ConsultaScopApiController / ScopApiService)
    'scop' => [
        'url' => env('API_SCOP'),
        'key' => env('API_KEY_SCOP'),
        // segundos para conectar y para esperar la respuesta completa
        'connect_timeout' => env('API_SCOP_CONNECT_TIMEOUT', 5),
        'timeout' => env('API_SCOP_TIMEOUT', 60),
        // minutos en caché: rango que incluye hoy / rango ya cerrado
        'cache_minutos' => env('API_SCOP_CACHE_MINUTOS', 5),
        'cache_minutos_historico' => env('API_SCOP_CACHE_MINUTOS_HISTORICO', 720),
        // consultas que tarden al menos esto (segundos) quedan en el log
        'log_lento' => env('API_SCOP_LOG_LENTO', 5),
    ],

    // Carga de SCOP temporales desde otra app (ScopTemporalController, sin login).
    // Con key definida se exige la cabecera X-Api-Key; vacía = abierto.
    'scop_temporal' => [
        'key' => env('SCOP_TEMPORAL_KEY'),
        'max_registros' => env('SCOP_TEMPORAL_MAX_REGISTROS', 2000),
    ],

    // App Android (MovilController): login, maestros y credenciales PVO.
    // Ver docs/API-MOVIL.md
    'movil' => [
        // false solo en pruebas: la contraseña y el token viajarían en claro
        'exigir_https' => env('MOVIL_EXIGIR_HTTPS', true),
        // Vida del token móvil; la expiración global de Sanctum (720 min) también aplica
        'token_horas' => env('MOVIL_TOKEN_HORAS', 12),
    ],

    // API de facturación propia (FacturacionApi): emite las guías a SUNAT.
    // Ver docs/INTEGRACION-API-GUIAS.md
    'facturacion' => [
        // Base con /api/v1, p. ej. http://127.0.0.1:8000/api/v1
        'url' => env('FE_API_URL'),
        // Token de `php artisan fe:client:create "guiasapi" --ruc=<RUC>` (en la API)
        'token' => env('FE_API_TOKEN'),
        // Mismo valor que `webhookSecret` de la empresa en la API
        'webhook_secret' => env('FE_WEBHOOK_SECRET'),
        // RUC emisor; si no se configura se usa el de la tabla empresa
        'ruc' => env('FE_RUC'),
        'timeout' => env('FE_API_TIMEOUT', 30),
    ],

];
