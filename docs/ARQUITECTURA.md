# Arquitectura de guiasapi

## Rutas (`routes/api.php`)

| Grupo | Rutas |
|---|---|
| Públicas | `POST /login`, `POST /registro`, `POST /convert` (PFX → PEM), `GET /factiliza/consulta`, `POST /factiliza/masivo` |
| `auth:sanctum`, CRUD (`apiResource`) | `productos`, `puntos`, `despatches`, `shipments`, `clientes`, `conductor`, `transportistas`, `sunat`, `tokensunat`, `ubigeos`, `vehiculos`, `puntoemision`, `numeracion`, `estadoelectronico`, `scop` |
| `auth:sanctum`, búsquedas | `/{recurso}/buscar` para productos, puntos, clientes, conductor, transportistas, vehiculos, user, despatches, estadoelectronico |
| `auth:sanctum`, guías | `PUT /despatches/baja/{id}`, `GET /despatches/pdf/{id}` (devuelve JSON, no un PDF), `POST /despatches/{id}/enviar`, `POST /despatches/{id}/consultar`, `GET /despatches/{id}/archivo` |
| Pública, con firma | `POST /webhooks/facturacion` (webhook de la API de facturación; throttle 120/min) |
| `auth:sanctum`, otras | `/sunat/parametros`, `/numeracion/actualbypunto`, `/numeracion/userid`, `/usuario/{id}`, `/estadoelectronico/descargar`, `POST /scop/consulta`, `GET /scop/disponible`, `/migracion/{buscar,almacenes,migrar}`, `POST /logout` |
| Favoritos | `GET/POST /favoritos`, `PUT/DELETE /favoritos/{tipo}/{id}` |
| `admin` | `GET /favoritos/usuario/{id}`, `POST /favoritos/clonar` |

## Modelos

| Modelo | Tabla / propósito | Relaciones clave |
|---|---|---|
| `Empresa` | Emisor (ruc, razonSocial, dirección, logo) | hasMany `SunatParameters` |
| `SunatParameters` | Credenciales SUNAT: client_id/secret, username/password SOL, certificado, clavecertificado, endpoints, `activo` | belongsTo Empresa; `getSunatParams()` |
| `TokenSunat` | Token OAuth GRE guardado en caché | — |
| `User` | Usuarios; `perfil` (`admin`, …) | belongsToMany PuntoEmision; hasMany Favorito |
| `PuntoEmision` / `Numeracion` | Puntos de emisión y series (`serie`, `numeroActual`) | Numeración ↔ Vehículo (`numeracion_vehiculos`) |
| `Despatch` | Guía (serie, correlativo, fechaEmision, observacion, migrado) | Cliente ×3 (`id_cliente`, `id_tercero`, `id_comprador`), hasOne Shipment y EstadoElectronico, hasMany DespatchProducto, Adicionales y Scop |
| `Shipment` | Traslado: pesos, bultos, fechas, transbordo | Motivo, Modalidad, Transportista, Puerto/Aeropuerto; Vehículos y Conductores (pivot `tipo` P/S); Indicadores; ShipmentPuntoubicacion (P/L) |
| `DespatchProducto` | Ítems: codigo, codProdSunat, descripcion, unidad, cantidad | — |
| `Adicionales` | Documentos relacionados: tipo, nro, emisor, tipoDesc | — |
| `EstadoElectronico` | Estado SUNAT de la guía: `estado` (P/F/B), estadoSunat, codigoSunat, descripcion, ticket, hash, hashQr, rutaXml/Pdf/Cdr, cdrbase64 | belongsTo Despatch |
| `Scop` | Números SCOP de una guía (únicos) | belongsTo Despatch |
| Catálogos | `Cliente`, `Conductor`, `Transportista`, `Producto`, `Vehiculo` (con `tracto`, `glp`), `Puntoubicacion`, `Ubigeo`, `Puerto`, `MotivoTraslado`, `ModalidadTraslado`, `TipoDocumento`, `Indicadores` | Los 6 primeros usan el trait `TieneFavoritos` |
| `AlmacenFafio` | Almacén FAFIO ↔ punto de ubicación (entrada/salida) | — |
| `Favorito` | Preferencias por usuario (morph) | Solo con `FAVORITOS_POR_USUARIO=true` |

## Flujo antiguo de una guía (sigue disponible)

```
Front ──POST /api/despatches──▶ DespatchController::store (transacción)
                                 ├─ despatches, despatch_productos, adicionales, scop
                                 ├─ shipments + puntos P/L + vehículos/conductores P/S + indicadores
                                 ├─ numeracion.numeroActual = correlativo enviado
                                 └─ estado_electronico: estado P "PENDIENTE DE ENVIO"

Proceso externo ──GET /api/sunat/parametros──▶ credenciales + certificado
                 ──(arma XML, firma, envía a SUNAT GRE, consulta el ticket)
                 ──PUT /api/estadoelectronico/{id}──▶ guarda el resultado (estado F, hash, hashQr, rutas)
```

Otros detalles del flujo:
- `update` borra y vuelve a crear los hijos, sin tocar el estado electrónico.
- `show` responde 403 si la guía está en `F` o en `B`.
- `baja` solo marca `B` localmente y libera los SCOP; no comunica nada a SUNAT.
- `EstadoElectronicoController::descargar` descarga XML, PDF o CDR desde `env('DB_ELECTRONICO_HOST') . rutaX` y los entrega en un zip.

El flujo nuevo, con la API de facturación, está en [INTEGRACION-API-GUIAS.md](INTEGRACION-API-GUIAS.md).

## Variables `.env` propias

| Variable | Uso |
|---|---|
| `FAVORITOS_POR_USUARIO` | Switch de favoritos (ver `config/favoritos.php`) |
| `API_VERSION` | Versión mostrada en la documentación de Scramble |
| `API_SCOP`, `API_KEY_SCOP`, `API_SCOP_CONNECT_TIMEOUT`, `API_SCOP_TIMEOUT`, `API_SCOP_CACHE_MINUTOS`, `API_SCOP_CACHE_MINUTOS_HISTORICO`, `API_SCOP_LOG_LENTO` | Cliente SCOP (`config/services.php`) |
| `DATABASE_SQL_*` | Conexión `sqlsrv` (FAFIO) |
| `DATABASE2_URL`, `DATABASE2_SQL_*` | Conexión `sqlsrv2` (FAFIO, tabla Almacen) |
| `DB_ELECTRONICO_HOST` | Host desde el que se descargan XML, PDF y CDR (flujo antiguo) |
| `FE_API_URL`, `FE_API_TOKEN`, `FE_WEBHOOK_SECRET`, `FE_RUC`, `FE_API_TIMEOUT` | API de facturación (`config/services.php` → `facturacion`) |
