# Integración guiasapi → API de facturación (emisión de guías)

La API de facturación es el proyecto `G:\codeigniterprojects\FacturacionApi` (Laravel). Su contrato para clientes está en [INTEGRACION-ERP.md](INTEGRACION-ERP.md), sección 6 (guías). Este documento explica qué se necesita para que **guiasapi** emita sus guías a través de esa API.

> Estado: **análisis y diseño**. Todavía no hay código de integración en guiasapi.

---

## 1. Qué cambia

| Hoy | Con la API |
|---|---|
| guiasapi guarda la guía en estado `P`; un proceso externo firma y envía | guiasapi envía el JSON a la API; la API arma el XML, firma, envía a SUNAT GRE, consulta el ticket y genera el PDF y el QR |
| El front recibe certificado, clave SOL y secret (`GET /api/sunat/parametros`) | Las credenciales viven solo en la API (cifradas); el front no las ve |
| El resultado llega con `PUT /api/estadoelectronico/{id}` | El resultado llega por **webhook** o consultando `GET /documents/{id}` |

---

## 2. Inscribir la empresa en la API (una sola vez)

Base: `http://<servidor-api>/api/v1`. Todo requiere `Authorization: Bearer <token>`, `Accept: application/json`. La empresa se identifica por **RUC** en la URL (`companies/{ruc}`).

### Paso 0 — token de administrador (en el servidor de la API)
```bash
php artisan fe:client:create "Admin" --admin
```
Solo un cliente `--admin` puede dar de alta empresas y cambiar `entorno` o `activo`. El token se muestra **una sola vez**.

### Paso 1 — alta de la empresa
```bash
curl -X POST $API/companies -H "Authorization: Bearer $ADMIN" -H "Accept: application/json" \
  -H "Content-Type: application/json" -d @empresa.json
```
Cuerpo (`docs/ejemplos/empresa.json`; reglas en `FacturacionApi/app/Http/Requests/CompanyRequest.php`):

| Campo | Oblig. | Origen en guiasapi |
|---|---|---|
| `ruc` (11 dígitos) | Sí | `empresa.ruc` |
| `razonSocial` | Sí | `empresa.razonSocial` |
| `nombreComercial` | No | — |
| `direccion.{ubigeo, departamento, provincia, distrito, direccion}` | Sí | `empresa.direccion` (+ ubigeo, que hoy no está en `empresa`) |
| `direccion.{telefono, email, codigoDomicilio}` | No | `empresa.email` |
| `entorno` | No | `beta` (pruebas) o `produccion` |
| `webhookUrl` | No | URL pública de guiasapi, p. ej. `https://<dominio>/api/webhooks/facturacion` |
| `webhookSecret` | No (mín. 16 caracteres) | Secreto compartido; generar uno largo y guardarlo también en el `.env` de guiasapi |

### Paso 2 — certificado digital
```bash
curl -X POST $API/companies/$RUC/certificate -H "Authorization: Bearer $ADMIN" -H "Accept: application/json" \
  -F "certificado=@certificado.pfx" -F "password=<clave>"
```
- Acepta `.pfx`, `.p12` o `.pem`, de hasta 100 KB. La API valida la vigencia y que el certificado sea de ese RUC; con `ignorarRuc=true` se omite esa comprobación.
- En guiasapi el certificado ya está en `sunat_parameters.certificado`, como PEM en base64. Se puede decodificar a un `.pem` y subir con `clavecertificado`, o subir el `.pfx` original.

### Paso 3 — credenciales SOL y GRE
```bash
curl -X PUT $API/companies/$RUC/credentials -H "Authorization: Bearer $ADMIN" -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"usuarioSol":"MODDATOS","claveSol":"...","greClientId":"...","greClientSecret":"..."}'
```

| Campo API | Origen en `sunat_parameters` | Ojo |
|---|---|---|
| `usuarioSol` (máx. 20) | `username` | **Sin el RUC adelante.** La API arma `ruc + usuarioSol` (`app/Sunat/Rest/GreClient.php`). Si `username` hoy es `20123456789MODDATOS`, enviar solo `MODDATOS` |
| `claveSol` | `password` | |
| `greClientId` | `client_id` | **Obligatorio para guías** |
| `greClientSecret` | `client_secret` | **Obligatorio para guías** |
| `apiClientId` / `apiClientSecret` | — | Opcional: API de consulta de comprobantes de SUNAT |

En `beta`, la API usa el servicio GRE de pruebas (`gre-test.nubefact.com`, configurable en `FacturacionApi/config/fe.php`). Las credenciales GRE de producción solo sirven en `produccion`.

### Paso 4 — logo (opcional)
`POST /companies/{ruc}/logo` (multipart `logo`: png o jpg de hasta 1 MB). Se usa en el PDF.

### Paso 5 — token para guiasapi
```bash
php artisan fe:client:create "guiasapi" --ruc=20123456789
```
Este token **no** es de administrador: solo puede emitir y consultar con ese RUC. Va en el `.env` de guiasapi.

### Paso 6 — comprobar
`GET /companies/{ruc}` debe mostrar `tieneCredencialesGre: true` y el certificado vigente.

---

## 3. El webhook

Es la **API la que llama a guiasapi** cuando una guía cambia de estado. No es algo que guiasapi tenga que llamar.

- **Cuándo**:
  - `document.status`: estado final (accepted, observed o rejected).
  - `document.sunatPdf`: la API ya descargó el PDF oficial de SUNAT de la guía.
- **Cómo**: `POST` a `webhookUrl` con el cuerpo `{"event": "...", "data": { ...igual que GET /documents/{id}... }}` y el header `X-FE-Signature: hex(HMAC-SHA256(cuerpo, webhookSecret))`. Ver `FacturacionApi/app/Jobs/DispatchWebhookJob.php`.
- **Respuesta**: guiasapi debe responder 2xx. Si no, la API reintenta hasta 6 veces, con esperas de 30 s, 2 min, 10 min, 30 min y 2 h.
- **Requisitos**:
  - La URL debe ser **pública**: el servidor de la API tiene que poder alcanzarla. Va **sin** `auth:sanctum`, porque la seguridad la da la firma.
  - En el servidor de la API debe correr el worker de colas (`php artisan queue:work`). Si no, el webhook no sale.
- **Alternativa sin webhook**: consultar `GET /documents/{fe_id}`, o `POST /documents/{fe_id}/ticket` para forzar la consulta del ticket.

Verificación de la firma en guiasapi:
```php
$cuerpo = $request->getContent();                          // cuerpo CRUDO, no $request->all()
$esperada = hash_hmac('sha256', $cuerpo, config('services.facturacion.webhook_secret'));
if (! hash_equals($esperada, (string) $request->header('X-FE-Signature'))) {
    return response()->json(['exito' => false, 'error' => 'Firma inválida'], 401);
}
$evento = json_decode($cuerpo, true);   // $evento['data']['id'] = fe_id
```

Hay una implementación de referencia en `G:\fullprojects\topsoft\backend-erp-total`: `app/Http/Controllers/Api/WebhookFacturacionController.php` (receptor) y `app/Services/Ventas/Electronico/EmisorApiFacturacion.php` (cliente).

---

## 4. Mapeo de tablas de guiasapi → JSON de `POST /companies/{ruc}/despatches`

| JSON | Origen |
|---|---|
| `tipoDocumento` (`09` o `31`) | **Falta columna.** Hoy solo se puede deducir de la serie (`T###` → 09, `V###` → 31) |
| `serie`, `correlativo`, `fechaEmision`, `observacion` | `despatches` |
| `destinatario{tipoDocumento, numeroDocumento, razonSocial}` | `clientes` (`id_cliente`) + `tipo_documentos` |
| `comprador{…}` | `clientes` (`id_comprador`) |
| `proveedor{…}` / `remitente{…}` | `clientes` (`id_tercero`). Hay que definir cuál corresponde según el motivo |
| `documentosRelacionados[]` | `adicionales` (`tipo`, `nro`, `emisor` → `rucEmisor`) |
| `envio.motivoTraslado` / `descripcionMotivo` | `motivo_traslado.codTraslado` / descripción |
| `envio.modalidad` | `modalidad_traslado.modTraslado` |
| `envio.fechaTraslado` | `shipments.fecTraslado` |
| `envio.fechaEntregaTransportista` | `shipments.fecInicioTrasladoBienes` (solo modalidad 01) |
| `envio.pesoTotal`, `unidadPeso`, `numeroBultos`, `indicadorTransbordo`, `sustentoPeso` | `shipments.pesoTotal`, `undPesoTotal`, `numBultos`, `indTransbordo`, `sustentoPeso` |
| `envio.partida` / `envio.llegada` `{ubigeo, direccion, codigoEstablecimiento}` | `shipment_puntoubicacions` con tipo P / L (`codLocal`) |
| `envio.transportista{numeroDocumento, razonSocial, registroMtc}` | `transportistas` (`numDoc`, `rznSocial`, `nroMtc`) |
| `envio.vehiculos[]{placa, numeroCirculacion, numeroAutorizacion, entidadAutorizadora}` | `vehiculos` vía `shipment_vehiculo`, el principal (P) primero |
| `envio.conductores[]{tipoDocumento, numeroDocumento, nombres, apellidos, licencia}` | `conductores` vía `shipment_conductor`, el principal (P) primero |
| `envio.puerto` / `envio.aeropuerto` | `puerto` (`id_puerto` / `id_aeropuerto`) |
| `envio.vehiculoMenor` | `indicadores` (indicador M1/L), por mapear |
| `items[]{descripcion, cantidad, unidadMedida, codigo, codigoSunat}` | `despatch_productos` |

Lo que la API devuelve y hay que guardar:

| Respuesta | Dónde guardarlo |
|---|---|
| `data.id` (fe_id) | **Falta columna** (`estado_electronico.fe_id`) |
| `data.estado` | `estado_electronico.estadoSunat`, y mapear a `estado` (ver abajo) |
| `data.ticket`, `data.hash` | `ticket`, `hash` |
| `data.sunat.codigo` / `descripcion` | `codigoSunat` / `descripcion` |
| `data.sunat.urlQr` | `hashQr` (o una nueva columna `fe_qr_url`) |
| `data.enlaces.pdf/xml/cdr` | `rutaPdf/rutaXml/rutaCdr`, o descargarlos con el token cuando se pidan |

Estados de la API → `estado_electronico.estado`:

| Estado en la API | Estado local | Qué significa |
|---|---|---|
| `pendingTicket`, `error` | `P` | Pendiente |
| `accepted`, `observed` | `F` | Final |
| `rejected` | `R` (nuevo) | Corregir y reenviar con la misma serie y correlativo; la API reemite sobre el mismo fe_id |

---

## 5. Diseño propuesto (fase siguiente)

1. **Configuración**: en `config/services.php` agregar `facturacion => [url, token, webhook_secret, timeout]`, con `FE_API_URL`, `FE_API_TOKEN` y `FE_WEBHOOK_SECRET` en `.env`.
2. **Migración**:
   - En `estado_electronico`: `fe_id` (único), `fe_qr_url`, `fe_pdf_sunat` y `intentos`.
   - En `despatches`: `tipoDocumento` (por defecto `09`).
3. **`app/Services/FacturacionApiService.php`**: cliente HTTP con el patrón de `ScopApiService` (timeouts, log de llamadas lentas, mensajes amigables). Métodos:
   - `emitirGuia(Despatch)`, que arma el JSON de la sección 4.
   - `consultar(feId)`, `pdf(feId, formato)` y `reenviar(feId)`.
4. **Emisión**: un endpoint `POST /api/despatches/{id}/emitir`, o emitir al final de `store`. Si la respuesta es 409 (ya existe), se trata como éxito y se guarda `data`. Si es 422, se devuelven los errores al front.
5. **Webhook**: `POST /api/webhooks/facturacion`, fuera de `auth:sanctum`. Verifica la firma (sección 3), busca por `fe_id` y actualiza `EstadoElectronico`. Debe ser idempotente.
6. **PDF**: `GET /api/despatches/pdf/{id}` pasa a hacer de proxy de `GET /documents/{fe_id}/pdf?formato=a4`.
7. **Después**, cuando el front ya no firme: retirar los secretos de `GET /api/sunat/parametros` y proteger `/api/convert`.

---

## 6. Pendientes por confirmar

- URL pública de guiasapi para `webhookUrl`, y si el servidor de la API puede alcanzarla.
- Entorno inicial: `beta` (credenciales GRE de prueba) o `produccion`.
- Que el worker de colas y el scheduler corran en el servidor de la API (webhooks, consulta de tickets, descarga del PDF de SUNAT).
- Formato de `sunat_parameters.username`: si incluye el RUC, quitarlo al inscribir.
- Qué rol cumple `id_tercero` (remitente o proveedor) según el motivo de traslado.
- Si la emisión será automática al guardar o con un botón "Emitir".
