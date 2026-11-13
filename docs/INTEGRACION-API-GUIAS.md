# Integración guiasapi → API de facturación (emisión de guías)

La API de facturación es el proyecto `G:\codeigniterprojects\FacturacionApi` (Laravel). Su contrato para clientes está en [INTEGRACION-ERP.md](INTEGRACION-ERP.md), sección 6 (guías). Este documento explica qué se necesita para que **guiasapi** emita sus guías a través de esa API.

> Estado: **implementado en guiasapi** (sección 5). Falta la puesta en marcha: inscribir la empresa, configurar el `.env`, migrar y adaptar el front (sección 6).
>
> Entorno inicial: **beta**. Webhook en desarrollo: `http://127.0.0.1:8091/api/webhooks/facturacion` (en el VPS cambia; ver sección 6).

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
| `webhookUrl` | No | Desarrollo: `http://127.0.0.1:8091/api/webhooks/facturacion`. En el VPS, la URL pública de guiasapi |
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
| `tipoDocumento` | Siempre `09` (guía de remitente). guiasapi no emite guía de transportista (31) por ahora |
| `serie`, `correlativo`, `fechaEmision`, `observacion` | `despatches` |
| `destinatario{tipoDocumento, numeroDocumento, razonSocial}` | `clientes` (`id_cliente`) + `tipo_documentos` |
| `comprador{…}` | `clientes` (`id_comprador`) |
| `proveedor{…}` | `clientes` (`id_tercero`) |
| `documentosRelacionados[]` | `adicionales` (`tipo`, `nro`, `emisor` → `rucEmisor`) |
| `envio.motivoTraslado` / `descripcionMotivo` | `motivo_traslado.codTraslado` / descripción |
| `envio.modalidad` | `modalidad_traslado.modTraslado` |
| `envio.fechaTraslado` | `shipments.fecTraslado` |
| `envio.fechaEntregaTransportista` | `shipments.fecInicioTrasladoBienes` (solo modalidad 01) |
| `envio.pesoTotal`, `unidadPeso`, `numeroBultos`, `indicadorTransbordo`, `sustentoPeso` | `shipments.pesoTotal`, `undPesoTotal`, `numBultos`, `indTransbordo`, `sustentoPeso` |
| `envio.partida` / `envio.llegada` `{ubigeo, direccion, codigoEstablecimiento}` | `shipment_puntoubicacions` con tipo P / L (`codLocal`) |
| `envio.transportista{numeroDocumento, razonSocial, registroMtc}` | `transportistas` (`numDoc`, `rznSocial`, `nroMtc`) |
| `envio.vehiculos[]{placa, numeroCirculacion, numeroAutorizacion, entidadAutorizadora}` | `vehiculos` vía `shipment_vehiculo`, el principal (P) primero. `numeroAutorizacion` y `entidadAutorizadora` (`nroAutorizacion` / `codEmisor`) solo en transporte público (01) y si están los dos; en privado (02) no se envían |
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

## 5. Lo implementado en guiasapi

| Pieza | Archivo |
|---|---|
| Configuración `FE_*` | `config/services.php` → `facturacion`, `.env.example` |
| Columnas `fe_id`, `fe_estado`, `fe_qr_url`, `fe_pdf_sunat`, `fe_intentos`, `fe_enviado_en` | `database/migrations/2026_11_12_090000_add_api_facturacion_to_estado_electronico.php` |
| Armado del JSON, envío, consulta, descarga y aplicación del resultado | `app/Services/FacturacionApiService.php` |
| Webhook (verifica HMAC, idempotente, nunca retrocede de aceptada) | `app/Http/Controllers/WebhookFacturacionController.php` |
| Endpoints de guía | `app/Http/Controllers/DespatchController.php` (`store`/`update` con `enviar`, `enviar`, `consultar`, `archivo`) |

Solo se emite la guía de remitente (`09`). El `tercero` de la guía se envía como `proveedor`.

### Configuración de la conexión (en la empresa, como en el ERP)

URL, token y secreto del webhook se guardan en la tabla `empresa`. El token y el secreto van cifrados con el `APP_KEY` de guiasapi y nunca se devuelven. Si un dato no está en la empresa, se usa el del `.env` (`FE_API_URL`, `FE_API_TOKEN`, `FE_WEBHOOK_SECRET`). Rutas solo para admin:

| Llamada | Uso |
|---|---|
| `GET /api/empresa/facturacion` | Muestra la URL, si hay token y secreto, de dónde sale cada dato (`empresa`, `env` o `falta`) y la `webhookUrl` que hay que registrar en la API |
| `PUT /api/empresa/facturacion` | `{"apiUrl": "...", "token": "...", "webhookSecret": "..."}`; se envía solo lo que cambia, y un valor vacío vuelve al `.env` |
| `POST /api/empresa/facturacion/probar` | Llama a `GET /companies/{ruc}` de la API y dice si está todo listo (token, RUC inscrito, credenciales GRE, certificado, webhook) |

El **secreto del webhook** no es un dato que entregue SUNAT ni la API: es una contraseña que se inventa (mínimo 16 caracteres). Se escribe la misma en los dos lados: como `webhookSecret` al inscribir la empresa en la API y como `webhookSecret` aquí. Para generar una: `php -r "echo bin2hex(random_bytes(24));"`.

### Contrato para el front

| Acción en pantalla | Llamada | Notas |
|---|---|---|
| **Guardar** (borrador) | `POST /api/despatches` (o `PUT /api/despatches/{id}`) | Igual que hoy. Estado `P`, `descripcion` = `PENDIENTE DE ENVIO` |
| **Guardar y enviar** | La misma llamada con `"enviar": true` en el cuerpo | La respuesta trae además `envio: {exito, message, errors, electronico}`. Si `envio.exito` es false, la guía **sí se guardó**: se muestra `envio.message` / `envio.errors` y se puede corregir y reenviar |
| **Enviar** un borrador | `POST /api/despatches/{id}/enviar` | 200 enviado; 422 la API rechazó los datos (`errors`); 409 ya aceptada o de baja; 502 la API no responde; 503 falta configuración |
| **Actualizar estado** | `POST /api/despatches/{id}/consultar` | Por si el webhook no llegó |
| **PDF / XML / CDR** | `GET /api/despatches/{id}/archivo?tipo=pdf&formato=a4` | `formato`: `a4` (el "Ver PDF") o `sunat` (el PDF del enlace QR de SUNAT; si la API no lo tiene, guiasapi lo baja directo de `fe_qr_url`/`hashQr`, solo enlaces https de sunat.gob.pe). `&descargar=1` para descargar. 404/503 con `urlQr` si aún no hay |
| Listados | `estadoelectronico` | Además de lo de siempre: `feId`, `feEstado`, `feQrUrl`, `fePdfSunat` |

Estados que verá el front:

| `feEstado` | `estado` | `estadoSunat` | Qué hacer |
|---|---|---|---|
| null | `P` | (vacío) | Borrador: se puede editar y enviar |
| `pendingTicket` | `P` | `PENDIENTE` | Esperar; la guía no se puede editar (409) |
| `accepted` / `observed` | `F` | `ACEPTADO` / `OBSERVADO` | Terminada. Imprimir el PDF con QR |
| `rejected` | `P` | `RECHAZADO` | Corregir (PUT) y volver a enviar con el mismo número |
| `error` | `P` | `ERROR` | Volver a enviar (reintenta el mismo documento) |

---

## 6. Qué falta (checklist de puesta en marcha)

**En la API de facturación** (`FacturacionApi`). Para levantarla en desarrollo se usan tres procesos, cada uno en su propia terminal:
```bash
php artisan serve --port=8090   # la API: http://127.0.0.1:8090/api/v1 (docs en /docs/api)
php artisan queue:work          # envía los webhooks y los envíos asíncronos
php artisan schedule:work       # consulta tickets cada 5 min y descarga el PDF de SUNAT
```
Sin `queue:work` la guía se emite, pero el webhook nunca sale. En el VPS se dejan como servicios (Supervisor o systemd).

- [ ] Tener la API corriendo y anotar su URL base (p. ej. `http://127.0.0.1:8000/api/v1`).
- [ ] Correr el worker de colas (`php artisan queue:work`) y el scheduler. Sin ellos no salen los webhooks ni se consulta el ticket en segundo plano.
- [ ] Crear el token de administrador e inscribir la empresa (sección 2) con `entorno: "beta"`, `webhookUrl: "http://127.0.0.1:8091/api/webhooks/facturacion"` y un `webhookSecret` de al menos 16 caracteres.
- [ ] Subir el certificado y las credenciales SOL y GRE. `usuarioSol` va **sin** el RUC; en beta, las credenciales GRE son las de prueba.
- [ ] Crear el token de guiasapi: `php artisan fe:client:create "guiasapi" --ruc=<RUC>`.

**En guiasapi**:
- [ ] `php artisan migrate`: agrega las columnas `fe_*` a `estado_electronico` y a `empresa`.
- [ ] `PUT /api/empresa/facturacion` con `apiUrl` (`http://127.0.0.1:8090/api/v1`), `token` y `webhookSecret`. Después, `POST /api/empresa/facturacion/probar`.
- [ ] Servir guiasapi en el puerto 8091, como dice el `webhookUrl`.

**En el front**:
- [ ] Botón "Guardar y enviar", que manda `enviar: true`, y botón "Enviar" en los borradores, que llama a `/despatches/{id}/enviar`.
- [ ] Mostrar `envio.message` y `envio.errors` cuando el envío falle.
- [ ] Mostrar `estadoSunat` y `descripcion`, y el PDF desde `/despatches/{id}/archivo`.

**Al pasar al VPS / producción**:
- [ ] Cambiar `webhookUrl` con `PATCH /companies/{ruc}` (`{"webhookUrl": "https://<dominio>/api/webhooks/facturacion"}`). El dominio debe ser alcanzable desde el servidor de la API.
- [ ] Cambiar a `entorno: "produccion"` (lo hace el token de administrador) y subir las credenciales GRE de producción.
- [ ] Actualizar `apiUrl` con `PUT /api/empresa/facturacion` en el VPS.

**Pendiente de decidir**:
- `baja` sigue siendo solo local. Una GRE aceptada no se anula por comunicación de baja: se da de baja en SUNAT (SOL).
- Cuando el front ya no firme por su cuenta, retirar los secretos de `GET /api/sunat/parametros`.
