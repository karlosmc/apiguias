<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Services\FacturacionApiService;
use Illuminate\Http\Request;

/**
 * Conexión de guiasapi con la API de facturación, guardada en la empresa
 * (como en el ERP). Solo admin.
 *
 * El token y el secreto del webhook se guardan cifrados y nunca se devuelven:
 * solo se informa si están cargados. Lo que no esté en la empresa se toma del
 * .env (FE_API_URL, FE_API_TOKEN, FE_WEBHOOK_SECRET).
 */
class ConfiguracionFacturacionController extends Controller
{
    /**
     * Ver la configuración de la API de facturación
     *
     * @response array{ruc: string|null, apiUrl: string|null, tieneToken: bool, tieneWebhookSecret: bool, origen: array{apiUrl: string, token: string, webhookSecret: string}, webhookUrl: string, exito: bool}
     */
    public function show(FacturacionApiService $service)
    {
        $empresa = Empresa::first();

        if (! $empresa) {
            return $this->sinEmpresa();
        }

        return response()->json($this->estado($empresa, $service) + ['exito' => true]);
    }

    /**
     * Guardar la configuración de la API de facturación
     *
     * Se envía solo lo que cambia. Un valor vacío ("" o null) borra el dato de
     * la empresa y se vuelve a usar el del .env.
     *
     * - `apiUrl`: URL base de la API con /api/v1, p. ej. http://127.0.0.1:8090/api/v1
     * - `token`: el de `php artisan fe:client:create "guiasapi" --ruc=<RUC>`
     * - `webhookSecret`: el mismo texto que se puso como `webhookSecret` al
     *   inscribir la empresa en la API (mínimo 16 caracteres)
     */
    public function update(Request $request, FacturacionApiService $service)
    {
        $request->validate([
            'apiUrl' => 'sometimes|nullable|url|max:300',
            'token' => 'sometimes|nullable|string|max:500',
            'webhookSecret' => 'sometimes|nullable|string|min:16|max:200',
        ], [
            'webhookSecret.min' => 'El secreto del webhook debe tener al menos 16 caracteres (la API exige lo mismo).',
        ]);

        $empresa = Empresa::first();

        if (! $empresa) {
            return $this->sinEmpresa();
        }

        $campos = ['apiUrl' => 'fe_api_url', 'token' => 'fe_api_token', 'webhookSecret' => 'fe_webhook_secret'];

        foreach ($campos as $entrada => $columna) {
            if ($request->has($entrada)) {
                $valor = trim((string) $request->input($entrada));
                $empresa->{$columna} = $valor === '' ? null : ($entrada === 'apiUrl' ? rtrim($valor, '/') : $valor);
            }
        }

        $empresa->save();

        // Servicio nuevo: el anterior ya tenía la empresa leída
        $service = app(FacturacionApiService::class);

        return response()->json(['message' => 'Configuración guardada'] + $this->estado($empresa->fresh(), $service) + ['exito' => true]);
    }

    /**
     * Probar la conexión con la API de facturación
     *
     * Llama a GET /companies/{ruc} de la API con el token configurado y dice si
     * la empresa está lista para emitir guías (credenciales GRE, certificado,
     * webhook).
     */
    public function probar(FacturacionApiService $service)
    {
        $resultado = $service->probar();
        $http = $resultado['http'];
        unset($resultado['http']);

        return response()->json($resultado, $http);
    }

    private function estado(Empresa $empresa, FacturacionApiService $service)
    {
        $origen = fn ($enEmpresa, $enEnv) => $enEmpresa ? 'empresa' : ($enEnv ? 'env' : 'falta');

        $tokenEmpresa = $this->cargado($empresa, 'fe_api_token');
        $secretoEmpresa = $this->cargado($empresa, 'fe_webhook_secret');

        return [
            'ruc' => $service->ruc(),
            'apiUrl' => $service->apiUrl(),
            'tieneToken' => $tokenEmpresa || (bool) config('services.facturacion.token'),
            'tieneWebhookSecret' => (bool) $service->webhookSecret(),
            'origen' => [
                'apiUrl' => $origen($empresa->fe_api_url, config('services.facturacion.url')),
                'token' => $origen($tokenEmpresa, config('services.facturacion.token')),
                'webhookSecret' => $origen($secretoEmpresa, config('services.facturacion.webhook_secret')),
            ],
            // La URL que hay que registrar como webhookUrl en la API
            'webhookUrl' => url('/api/webhooks/facturacion'),
        ];
    }

    private function cargado(Empresa $empresa, $columna)
    {
        try {
            return (bool) $empresa->{$columna};
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return false;
        }
    }

    private function sinEmpresa()
    {
        return response()->json(['error' => 'No hay empresa registrada', 'exito' => false], 404);
    }
}
