# Integración ERP → Facturación API SUNAT

Especificación de campos para que el ERP emita comprobantes electrónicos. Todo el JSON va en **camelCase**. Las reglas de este documento salen de la validación real de la API (`app/Http/Requests/*`). Hay ejemplos completos en `docs/ejemplos/*.json`.

---

## 1. Conexión

| Configuración del ERP | Valor |
|---|---|
| URL base | `http://<servidor>/api/v1` |
| Token | `Authorization: Bearer <token>` (lo genera `php artisan fe:client:create`) |
| Headers | `Accept: application/json`, `Content-Type: application/json` |
| RUC emisor | Va en la URL: `/companies/{ruc}/...` |
| Formatos | Fecha `YYYY-MM-DD`, hora `HH:mm:ss` (America/Lima), montos decimales con punto |

El ERP **no envía**: certificado, clave del certificado, usuario/clave SOL, URL de SUNAT, XML ni datos del emisor. La API los toma de la empresa registrada.

---

## 2. Columnas que el ERP debe guardar (respuesta de la API)

Agrega estas columnas a la cabecera del comprobante en el ERP (venta, nota, guía, resumen, etc.):

| Columna sugerida (ERP) | Tipo | Viene de | Uso |
|---|---|---|---|
| `fe_id` | varchar(26) | `data.id` | **Clave para todas las consultas posteriores** (`/documents/{id}`) |
| `fe_estado` | varchar(20) | `data.estado` | Ver la tabla de estados (sección 8) |
| `fe_hash` | varchar(100) | `data.hash` | Código hash; imprimir en el comprobante si el ERP genera su propio formato |
| `fe_sunat_codigo` | varchar(10) | `data.sunat.codigo` | `0` = aceptado |
| `fe_sunat_descripcion` | text | `data.sunat.descripcion` | Mensaje de SUNAT para mostrar al usuario |
| `fe_sunat_notas` | text / json | `data.sunat.notas` (array) | Observaciones (códigos ≥ 4000) |
| `fe_ticket` | varchar(50) | `data.ticket` | Solo resumen, baja y guía |
| `fe_qr_url` | text | `data.sunat.urlQr` | **Solo guías (09/31).** Enlace que SUNAT devuelve en el CDR al aceptar la guía (`…/descargaqr?hashqr=…`). Es lo que codifica el QR de la guía impresa y sirve para abrir o descargar la guía desde SUNAT. Llega `null` hasta que la guía es aceptada (normalmente por webhook) |
| `fe_pdf_sunat` | boolean | `data.sunat.pdfSunatDescargado` | **Solo guías.** `true` cuando la API ya descargó y guardó el PDF oficial de SUNAT (el que abre el QR). Se obtiene con `enlaces.pdfSunat` |
| `fe_intentos` | int | `data.intentos` | Informativo |
| `fe_enviado_en` | datetime | `data.enviadoEn` | ISO 8601 |
El ERP ya tiene `serie` y `correlativo` (los asigna él y los envía obligatoriamente) y los montos (los calcula él). La API **no recalcula nada**: coloca en el XML los montos que envía el ERP y solo verifica que sean coherentes (sección 3, "Validación de montos"). Así, el total del ERP, el del PDF y el que recibe SUNAT son siempre el mismo.

---

## 3. Factura (01) y boleta (03)

`POST /companies/{ruc}/invoices`

### Cabecera

| Campo | Oblig. | Tipo / regla | Columna ERP típica |
|---|---|---|---|
| `tipoDocumento` | Sí | `01` \| `03` | tipo de comprobante |
| `serie` | Sí | 4 caracteres; `F###` para 01, `B###` para 03 | serie |
| `correlativo` | Sí | entero 1–99999999 | número |
| `fechaEmision` | Sí | `YYYY-MM-DD` | fecha |
| `horaEmision` | No | `HH:mm:ss`; por defecto, la hora actual | hora |
| `fechaVencimiento` | No | `YYYY-MM-DD`, ≥ fechaEmision | vencimiento |
| `moneda` | No | `PEN` (defecto) \| `USD` \| `EUR` | moneda |
| `tipoOperacion` | No | 4 caracteres, cat. 51; defecto `0101`; `0200` exportación (con detracción se usa `1001`) | tipo de operación |
| `formaPago` | No | `Contado` (defecto) \| `Credito` | condición de pago |
| `cuotas[]` | Si es crédito* | `{ monto > 0, fechaPago YYYY-MM-DD }` | cronograma de cuotas |
| `montoPendiente` | No | neto pendiente de pago; por defecto `totalVenta − detraccion.monto`. **Obligatorio** con detracción en USD/EUR | saldo a crédito |
| `detraccion` | No | objeto (abajo) | |
| `ordenCompra` | No | máx. 20 | O/C |
| `observacion` | No | máx. 500 | observaciones |
| `direccionEntrega` | No | máx. 300 (solo PDF) | dirección de entrega |
| `vendedor` | No | máx. 100 (solo PDF) | vendedor |
| `guias[]` | No | `{ tipoDocumento: "09"\|"31", numeroDocumento máx. 30 }` | guías relacionadas |
| `relacionados[]` | No | `{ tipoDocumento 2 caracteres, numeroDocumento máx. 30 }` | otros documentos |
| `leyendas[]` | No | `{ codigo 4 caracteres, valor máx. 500 }`. Si el ERP no envía la 1000 (monto en letras), la API la genera a partir de `totales.totalVenta`; igual con la 1002 (todo gratuito) y la 2006 (detracción) | leyendas |
| `cliente` | Sí | objeto (abajo) | |
| `items[]` | Sí | 1 a 1000 (abajo) | detalle |
| `totales` | Sí | objeto (abajo) | totales de cabecera |

\* Con crédito se requieren `cuotas` **o** `fechaVencimiento` (en ese caso se crea una sola cuota por el neto pendiente). La suma de cuotas debe ser exactamente igual al neto pendiente; si no, la API responde 422.

### `cliente`

| Campo | Oblig. | Regla | Columna ERP típica |
|---|---|---|---|
| `tipoDocumento` | Sí | `0` sin doc. \| `1` DNI \| `4` C.E. \| `6` RUC \| `7` pasaporte \| `A` céd. diplomática | tipo doc. cliente |
| `numeroDocumento` | Sí | máx. 15 (`-` si es tipo 0) | nro. doc. cliente |
| `razonSocial` | Sí | máx. 300 | nombre / razón social |
| `direccion` | No | máx. 300 | dirección |
| `ubigeo` | No | 6 dígitos | ubigeo |
| `pais` | No | 2 letras ISO (defecto `PE`) | país |
| `email` | No | email | correo |

Regla: la factura (01) exige `cliente.tipoDocumento = "6"`, salvo con `tipoOperacion = "0200"`.

### `items[]`

Todos los montos los calcula el ERP. Se envían tal como quedan en el XML (2 decimales; los unitarios pueden llevar hasta 10).

| Campo | Oblig. | Regla | Columna ERP típica |
|---|---|---|---|
| `descripcion` | Sí | máx. 500 | descripción |
| `cantidad` | Sí | > 0 | cantidad |
| `tipoAfectacionIgv` | No | cat. 07; defecto `10` | afectación IGV |
| `valorUnitario` | Sí | ≥ 0, **sin** impuestos. En ítems gratuitos: el valor referencial | precio unitario sin IGV |
| `precioUnitario` | Sí, salvo gratuitos | ≥ 0, **con** impuestos (IGV + ISC) | precio unitario con IGV |
| `descuento` | No | ≥ 0, monto sin IGV de la línea | descuento de línea |
| `valorVenta` | Sí | valor de venta de la línea (`LineExtensionAmount`), sin impuestos | subtotal de línea |
| `porcentajeIgv` | No | `18` (defecto) \| `10` \| `8` \| `4` \| `0` | % IGV |
| `baseIgv` | No | base del IGV de la línea; por defecto `valorVenta + isc.monto` | base IGV |
| `igv` | Sí | IGV de la línea (`0` en exonerado, inafecto y exportación) | IGV de línea |
| `isc` | No | `{ tipo: "01"\|"02"\|"03", porcentaje, monto, base? }`; `base` por defecto = `valorVenta` | ISC |
| `icbper` | No | `{ monto, factor? }`; `factor` por defecto 0.50 | ICBPER de línea |
| `totalImpuestos` | No | por defecto `igv + isc.monto + icbper.monto` | impuestos de línea |
| `unidadMedida` | No | cat. 03, máx. 3; defecto `NIU` (`ZZ` servicio) | unidad SUNAT |
| `codigo` | No | máx. 30 | código interno |
| `codigoSunat` | No | máx. 8 | código producto SUNAT |

Afectación del IGV (cat. 07): `10` gravado · `11`–`16` gravado gratuito · `17` IVAP · `20` exonerado · `21` exonerado gratuito · `30` inafecto · `31`–`37` inafecto gratuito · `40` exportación. El código de tributo (1000, 9997, 9998, 9995, 9996) lo deduce la API del catálogo 07, porque es una tabla fija.

### `totales`

| Campo | Oblig. | Regla |
|---|---|---|
| `gravadas` | Si hay gravados | Σ `valorVenta` de líneas gravadas (no gratuitas) − `descuentoGlobal` |
| `exoneradas`, `inafectas`, `exportacion` | Si aplica | Σ `valorVenta` de sus líneas |
| `gratuitas`, `igvGratuitas` | Si aplica | Σ `valorVenta` e Σ `igv` de líneas gratuitas |
| `totalIgv` | Sí | Σ `igv` de líneas no gratuitas |
| `totalIsc`, `totalIcbper` | Si aplica | Σ de las líneas |
| `descuentoGlobal` | No | descuento que afecta la base gravada (sin IGV) |
| `otrosCargos` | No | cargos que no afectan la base |
| `valorVenta` | No | por defecto gravadas + exoneradas + inafectas + exportación |
| `totalImpuestos` | No | por defecto totalIgv + totalIsc + totalIcbper |
| `precioVenta` | No | por defecto valorVenta + totalImpuestos |
| `totalVenta` | Sí | importe total a pagar |

Los campos opcionales con "por defecto" solo se completan **sumando** montos que envió el propio ERP; la API no redondea ni aplica porcentajes.

### Validación de montos

Antes de emitir, la API comprueba estas reglas, con la misma tolerancia que aplica SUNAT (**±1.00**, configurable con `FE_TOLERANCIA`). Si una no se cumple, responde **422** con el campo y la diferencia, y no guarda ni envía nada. Si se cumple, los montos se envían **exactamente como llegaron**: no se corrigen diferencias de redondeo.

| Campo | Regla |
|---|---|
| `items.N.valorVenta` | ≈ `valorUnitario × cantidad − descuento` |
| `items.N.isc.monto` | ≈ `isc.base × isc.porcentaje` (sistema 01) |
| `items.N.igv` | ≈ `baseIgv × porcentajeIgv` en gravados; `0` en el resto |
| `items.N.icbper.monto` | ≈ `cantidad × factor` |
| `totales.gravadas`, `exoneradas`, `inafectas`, `exportacion`, `gratuitas` | ≈ suma de sus líneas (la regla 3277 de SUNAT) |
| `totales.totalIgv`, `totalIsc`, `totalIcbper`, `igvGratuitas` | ≈ suma de las líneas |
| `totales.totalVenta` | ≈ `valorVenta + totalImpuestos + otrosCargos` |

Ejemplo de respuesta 422:

```json
{ "message": "Enviado 20.5, esperado 18 (base IGV 100 × 18%); diferencia 2.5 supera la tolerancia de SUNAT (1).",
  "errors": { "items.0.igv": ["Enviado 20.5, esperado 18 (base IGV 100 × 18%); diferencia 2.5 supera la tolerancia de SUNAT (1)."] } }
```

La tasa de IGV de 10% (Ley 31556) solo la acepta SUNAT si el RUC emisor está inscrito en ese régimen (error 3462).

### `detraccion`

| Campo | Oblig. | Regla |
|---|---|---|
| `codigo` | Sí | 3 caracteres, cat. 54 (p. ej. `037`) |
| `porcentaje` | Sí | > 0 y ≤ 100 |
| `cuentaBancaria` | Sí | cuenta del Banco de la Nación, máx. 30 |
| `medioPago` | No | 3 caracteres, cat. 59; defecto `001` |
| `monto` | Sí | monto de la detracción **en soles**, calculado por el ERP |

---

## 4. Nota de crédito (07) y débito (08)

`POST /companies/{ruc}/notes` acepta **todos los campos de la sección 3**, más estos:

| Campo | Oblig. | Regla | Columna ERP típica |
|---|---|---|---|
| `tipoDocumento` | Sí | `07` \| `08` | |
| `serie` | Sí | empieza con `F` si modifica una factura y con `B` si modifica una boleta (p. ej. `FC01`, `BC01`) | |
| `documentoAfectado.tipoDocumento` | Sí | `01` \| `03` | tipo doc. referencia |
| `documentoAfectado.idDocumento` | Sí | `SERIE-NUMERO`, p. ej. `F001-125` | doc. referencia |
| `motivo.codigo` | Sí | 2 caracteres; NC cat. 09, ND cat. 10 | motivo |
| `motivo.descripcion` | Sí | máx. 250 | sustento |

Los `items` son lo que se acredita o debita. Con NC tipo `13`, `formaPago`/`cuotas` informan el nuevo cronograma.

---

## 5. Resumen diario (RC) y comunicación de baja (RA)

Ambos devuelven `estado: pendingTicket` y luego cambian solos a `accepted`/`rejected` (por webhook o consultando).

### `POST /companies/{ruc}/summaries` (boletas y sus notas)

| Campo | Oblig. | Regla |
|---|---|---|
| `fechaReferencia` | Sí | fecha de las boletas |
| `fechaGeneracion` | No | ≥ fechaReferencia; defecto hoy |
| `correlativo` | No | 1–99999; defecto, el siguiente del día |
| `detalles[]` | Sí | 1 a 500 |
| `detalles[].tipoDocumento` | Sí | `03` \| `07` \| `08` |
| `detalles[].idDocumento` | Sí | `B###-NUMERO` |
| `detalles[].estado` | Sí | `1` adicionar \| `2` modificar \| `3` anular |
| `detalles[].moneda`, `cliente{tipoDocumento, numeroDocumento}`, `documentoReferencia{tipoDocumento:"03", idDocumento}`, `total`, `gravadas`, `exoneradas`, `inafectas`, `exportacion`, `gratuitas`, `otrosCargos`, `igv`, `ivap`, `isc`, `otrosTributos`, `icbper` | No | **Solo si la boleta no está en la API**; si está, basta con `tipoDocumento` + `idDocumento` + `estado` |

### `POST /companies/{ruc}/voided` (facturas, sus notas, retenciones y percepciones)

| Campo | Oblig. | Regla |
|---|---|---|
| `fechaReferencia` | Sí | fecha de los comprobantes |
| `fechaGeneracion` | No | ≥ fechaReferencia |
| `correlativo` | No | 1–99999 |
| `detalles[].tipoDocumento` | Sí | `01` \| `07` \| `08` \| `20` \| `40` |
| `detalles[].serie` | Sí | `F###`, `R###` o `P###` (**no** boletas: se anulan con el resumen, estado 3) |
| `detalles[].correlativo` | Sí | entero |
| `detalles[].motivo` | Sí | máx. 100 |

---

## 6. Guía de remisión (09 remitente / 31 transportista)

> **QR de la guía:** cuando SUNAT acepta la guía devuelve un enlace (`hashqr`) que va en el QR del PDF. La API lo guarda y lo devuelve en `data.sunat.urlQr` (también en el webhook). El ERP debe guardarlo en `fe_qr_url` para abrir o descargar la guía desde SUNAT. El PDF de la API ya incluye ese QR; si la guía aún no está aceptada, el PDF muestra un recuadro que dice que el QR se genera al aceptarse, así que conviene imprimir la guía después de la aceptación.

> **PDF oficial de SUNAT:** el enlace `hashqr` devuelve un PDF generado por SUNAT. La API lo descarga sola al aceptarse la guía y lo guarda (`GET /documents/{fe_id}/pdf?formato=sunat`). Ese servicio de SUNAT **se satura con frecuencia**: puede tardar o no responder (en pruebas reales hubo intentos colgados 30–60 s seguidos de descargas en menos de 1 s). Por eso:
>
> - La descarga se reintenta en segundo plano a 1 min, 5 min, 15 min, 30 min y 1 h, y una tarea cada hora retoma las guías de los últimos 7 días que sigan sin PDF.
> - Cuando queda descargado, la API envía el webhook `document.sunatPdf` (mismo cuerpo que `document.status`) con `sunat.pdfSunatDescargado: true`.
> - Si el ERP pide `?formato=sunat` antes de eso, la API intenta en el momento (hasta 15 s). Si SUNAT no responde, contesta **503** con `Retry-After: 300` y `urlQr`, y deja la descarga en cola. El ERP debe mostrar "SUNAT aún no entrega el PDF, intente en unos minutos" o abrir `fe_qr_url` directamente.
> - El PDF de la API (`formato=a4`) siempre está disponible y es válido como representación impresa. El de SUNAT es un respaldo oficial.

`POST /companies/{ruc}/despatches` devuelve un ticket. La empresa debe tener registradas sus credenciales API de SUNAT.

| Campo | Oblig. | Regla |
|---|---|---|
| `tipoDocumento` | Sí | `09` (serie `T###`) \| `31` (serie `V###`) |
| `serie`, `correlativo`, `fechaEmision` | Sí | |
| `horaEmision`, `observacion` (máx. 250) | No | |
| `registroMtc` | No | MTC del emisor (para 31) |
| `destinatario{tipoDocumento, numeroDocumento, razonSocial}` | Sí | |
| `remitente{…}` | Si es 31 | mismo formato |
| `comprador{…}` | No | mismo formato. Comprador cuando es distinto del destinatario (p. ej. motivo 03, venta con entrega a terceros) → `BuyerCustomerParty` |
| `proveedor{…}` | No | mismo formato. Proveedor/vendedor cuando el remitente no lo es (p. ej. motivo 02, compra) → `SellerSupplierParty` |
| `documentosRelacionados[]{tipoDocumento 2 caracteres, numeroDocumento, rucEmisor?}` | No | cat. 61 |
| `envio.motivoTraslado` | Si es 09 | 2 caracteres, cat. 20 |
| `envio.descripcionMotivo` | No | máx. 100 |
| `envio.modalidad` | Si es 09 | `01` público \| `02` privado |
| `envio.fechaTraslado` | Sí (en público basta una de las dos fechas) | Fecha de inicio de traslado → `TransitPeriod/StartDate` |
| `envio.fechaEntregaTransportista` | Solo público (01) | Fecha de entrega de bienes al transportista → `LoadingTransportEvent/OccurrenceDate`. Si en público llega solo una de las dos fechas, se usa para ambos tags. En privado no se acepta |
| `envio.pesoTotal` | Sí | > 0; `envio.unidadPeso` `KGM` (defecto) \| `TNE` |
| `envio.pesoNeto` | No | → `NetWeightMeasure`, misma unidad |
| `envio.sustentoPeso` | No | máx. 250, → `Shipment/Information` (sustento de la diferencia de peso, p. ej. importación) |
| `envio.numeroBultos`, `envio.indicadorTransbordo` | No | |
| `envio.partida{ubigeo 6 dígitos, direccion, codigoEstablecimiento? 4 caracteres}` | Sí | |
| `envio.llegada{…}` | Sí | mismo formato |
| `envio.transportista{numeroDocumento RUC, razonSocial, registroMtc?}` | Si es 09 con modalidad 01 | |
| `envio.vehiculos[]{placa, numeroCirculacion?, numeroAutorizacion?, entidadAutorizadora? (2, cat. D-37)}` (máx. 3) | Si es privado o 31 | placa 6–8 caracteres; el primero es el principal, los demás secundarios. `numeroCirculacion` = TUCE o certificado de habilitación |
| `envio.conductores[]{tipoDocumento, numeroDocumento, nombres, apellidos, licencia 9–10}` (máx. 3) | Si es privado o 31 | el primero es el principal |
| Público (01) con vehículo/conductor | No | Opcionales, pero si manda uno debe mandar ambos; la API agrega `SUNAT_Envio_IndicadorVehiculoConductoresTransp` |
| `envio.contenedores[]` (máx. 2) | No | números de contenedor (importación/exportación) |
| `envio.puerto{codigo, nombre}` o `envio.aeropuerto{codigo, nombre}` | No | cat. 63 / 64 → `FirstArrivalPortLocation` |
| `envio.vehiculoMenor` (bool) | No | Solo guía 09. `true` = traslado en vehículo M1/L: vehículo y conductor pasan a ser opcionales, pero si envía uno debe enviar ambos. Agrega `SUNAT_Envio_IndicadorTrasladoVehiculoM1L` al XML |
| `items[]{descripcion, cantidad, unidadMedida?, codigo?, codigoSunat?, atributos?[]{nombre, codigo, valor?}}` | Sí | `atributos` → `AdditionalItemProperty` (p. ej. partida arancelaria, código 7020) |

---

## 7. Retención (20) y percepción (40)

`POST /companies/{ruc}/retentions` · `POST /companies/{ruc}/perceptions`

| Campo | Oblig. | Retención | Percepción |
|---|---|---|---|
| `tipoDocumento` | Sí | `20` | `40` |
| `serie` | Sí | `R###` | `P###` |
| `correlativo`, `fechaEmision` | Sí | | |
| `regimen` | Sí | `01` (3%) | `01` 2% \| `02` 1% \| `03` 0.5% |
| Contraparte | Sí | `proveedor{tipoDocumento, numeroDocumento, razonSocial, direccion?, ubigeo?}` | `cliente{…}` |
| `documentos[].tipoDocumento` | Sí | `01` \| `03` \| `07` \| `08` \| `12` | igual |
| `documentos[].idDocumento`, `fechaEmision`, `total`, `montoPago`, `fechaPago` | Sí | | |
| `documentos[].moneda` | No | defecto `PEN` | |
| `documentos[].tipoCambio` | Si es USD/EUR | > 0 | |
| `documentos[].numeroPago`, `fechaTipoCambio` | No | | |
| `documentos[].monto` | Sí | monto retenido, en soles | monto percibido, en soles |
| `documentos[].neto` | Sí | pago en soles − monto | pago en soles + monto |
| `totales.total`, `totales.totalNeto` | No | por defecto, suma de `monto` y de `neto` | igual |

El ERP calcula los montos. La API valida, con tolerancia ±1.00, que `monto ≈ montoPago × tipoCambio × tasa del régimen` y que `neto` cuadre; si los `totales` se envían, deben ser la suma exacta de los documentos.

---

## 8. Respuesta, códigos HTTP y estados

```json
{ "data": { "id": "01JA2M7T3K8Y6V0P9QX4N5R2WB", "idDocumento": "F001-125", "estado": "accepted",
  "hash": "R38vJ8gnOoga1i30y0PFWPU0gXo=", "ticket": null, "total": 148.62,
  "sunat": { "codigo": "0", "descripcion": "La Factura numero F001-125, ha sido aceptada", "notas": [],
             "urlQr": null, "pdfSunatDescargado": false },
  "intentos": 1, "enviadoEn": "2026-10-07T12:19:05-05:00",
  "enlaces": { "self": "…", "xml": "…", "cdr": "…", "pdf": "…", "pdfSunat": null } } }
```

| HTTP | Significado | Acción del ERP |
|---|---|---|
| 201 | Registrado (y enviado) | Guardar las columnas de la sección 2 |
| 202 | Encolado (`?async=true`) | Esperar el webhook o consultar |
| 409 | Ese tipo + serie + correlativo ya existe y no está rechazado; `data` trae el existente | Tratarlo como éxito y guardar `data` |
| 422 | Validación o regla de negocio; `errors` trae los campos en camelCase | Corregir y reenviar con el **mismo** correlativo (no se guardó nada) |
| 401 / 403 | Token inválido / sin acceso al RUC | Configuración |

| `estado` | ¿Válido? | Acción del ERP |
|---|---|---|
| `accepted` | Sí | Cerrar |
| `observed` | Sí | Cerrar y registrar `sunat.notas` |
| `rejected` | No | SUNAT no lo registró: corregir los datos y reenviar el **mismo** `POST` con la misma serie y correlativo (la API lo reemite sobre el mismo `fe_id`) |
| `error` | Pendiente | Reintentar `POST /documents/{fe_id}/send` (mismo número) |
| `pendingTicket` | Pendiente | Esperar el webhook o hacer `GET /documents/{fe_id}` |
| `signed` | No enviado | Enviado con `enviar=false`: falta enviarlo o incluirlo en un resumen |
| `voided` | Anulado | Marcar la venta como anulada |

Query params de emisión: `?enviar=false` (solo firma) · `?async=true` (responde 202 y envía en cola).

---

## 9. Otras llamadas que usa el ERP

| Uso | Llamada |
|---|---|
| PDF A4 / ticket | `GET /documents/{fe_id}/pdf?formato=a4\|ticket80\|ticket58` (`&descargar=1`) |
| XML firmado / CDR | `GET /documents/{fe_id}/xml` · `GET /documents/{fe_id}/cdr` |
| Estado actual | `GET /documents/{fe_id}` |
| Reenviar | `POST /documents/{fe_id}/send` |
| Consultar ticket ahora | `POST /documents/{fe_id}/ticket` |
| Guía en SUNAT (QR) | abrir `fe_qr_url` (no pasa por esta API; es el enlace oficial de SUNAT) |
| PDF de SUNAT de la guía | `GET /documents/{fe_id}/pdf?formato=sunat` (`&descargar=1`). Responde 404 si la guía aún no está aceptada y 503 si SUNAT no responde (reintentar luego) |
| Último correlativo por serie | `GET /companies/{ruc}/series` → `[{tipoDocumento, serie, ultimoCorrelativo, comprobantes}]` |
| Vista previa (no guarda) | `POST /companies/{ruc}/preview/invoices/pdf` (o `/xml`, `/preview/notes/...`) |
| RUC / DNI | `GET /lookups/ruc/{ruc}` · `GET /lookups/dni/{dni}` |

Webhook (opcional): `POST` a la `webhookUrl` de la empresa con `{ "event": "document.status" | "document.sunatPdf", "data": { …igual que GET /documents/{id}… } }` y el header `X-FE-Signature = hex(HMAC-SHA256(cuerpo, webhookSecret))`. Se debe responder 2xx; hay hasta 6 reintentos. Actualizar las columnas de la sección 2 buscando por `data.id`.
