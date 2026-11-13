<?php

namespace App\Http\Controllers;

use App\Models\EstadoElectronico;
use App\Services\FacturacionApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Aviso de la API de facturación: "esta guía cambió de estado".
 *
 * La llama la API (no una persona), por eso la ruta va sin token. La protege
 * la firma: `X-FE-Signature = hex(HMAC-SHA256(cuerpo, webhookSecret))`. Sin
 * verificarla, cualquiera que conozca la URL podría marcar una guía como
 * aceptada.
 *
 * Eventos: `document.status` (estado final) y `document.sunatPdf` (la API ya
 * descargó el PDF oficial de SUNAT). Los dos traen en `data` lo mismo que
 * GET /documents/{id}.
 */
class WebhookFacturacionController extends Controller
{
    /**
     * Webhook de la API de facturación
     *
     * Responde 2xx siempre que la firma sea válida, aunque la guía no sea de
     * aquí: cualquier otra respuesta hace que la API reintente hasta 6 veces
     * sin que eso arregle nada. 401 si la firma no coincide.
     *
     * @unauthenticated
     */
    public function facturacion(Request $request, FacturacionApiService $service)
    {
        $secreto = (string) $service->webhookSecret();

        if ($secreto === '') {
            Log::warning('Webhook de facturación recibido sin secreto configurado.');

            return response()->json(['exito' => false, 'error' => 'Webhook no configurado: falta el secreto (PUT /api/empresa/facturacion o FE_WEBHOOK_SECRET)'], 503);
        }

        // El cuerpo CRUDO: volver a codificar el JSON cambia los bytes y la firma ya no coincide
        $cuerpo = $request->getContent();

        if (! $this->firmaValida($cuerpo, (string) $request->header('X-FE-Signature'), $secreto)) {
            Log::warning('Webhook de facturación con firma inválida.', ['ip' => $request->ip()]);

            return response()->json(['exito' => false, 'error' => 'Firma inválida'], 401);
        }

        $aviso = json_decode($cuerpo, true);
        $data = is_array($aviso) && is_array($aviso['data'] ?? null) ? $aviso['data'] : null;
        $feId = $data['id'] ?? null;

        if (! $feId) {
            return response()->json(['recibido' => true, 'aplicado' => false, 'motivo' => 'sin data.id']);
        }

        $estado = EstadoElectronico::where('fe_id', $feId)->first();

        if (! $estado) {
            Log::info('Webhook de facturación de un documento desconocido.', ['fe_id' => $feId]);

            return response()->json(['recibido' => true, 'aplicado' => false, 'motivo' => 'fe_id desconocido']);
        }

        $service->aplicar($estado, $data);

        return response()->json([
            'recibido' => true,
            'aplicado' => true,
            'evento' => $aviso['event'] ?? null,
            'estado' => $estado->estado,
            'feEstado' => $estado->fe_estado,
        ]);
    }

    /**
     * hash_equals y no ===: una comparación que corta en el primer byte
     * distinto deja adivinar la firma midiendo tiempos.
     */
    private function firmaValida($cuerpo, $firma, $secreto)
    {
        $firma = strtolower(trim($firma));

        if ($firma === '') {
            return false;
        }

        // Tolera el prefijo "sha256="
        if (str_starts_with($firma, 'sha256=')) {
            $firma = substr($firma, 7);
        }

        return hash_equals(hash_hmac('sha256', $cuerpo, $secreto), $firma);
    }
}
