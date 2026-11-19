# CLAUDE.md — guiasapi

Backend (API REST) para registrar **guías de remisión electrónicas** (SUNAT, Perú) y sus catálogos.
Lo consume un frontend propio. Más detalle en [docs/ARQUITECTURA.md](docs/ARQUITECTURA.md).

## Stack
- Laravel 9 (PHP ^8.0.2), MySQL como conexión por defecto.
- Paquetes: Sanctum (tokens Bearer), Scramble (OpenAPI en `/docs/api`), Guzzle, PhpSpreadsheet (exportar Excel) y doctrine/dbal.
- Conexiones extra a SQL Server: `sqlsrv` y `sqlsrv2`, que usa la migración de guías hacia el ERP FAFIO.
- No hay librería XML/SUNAT (greenter), colas ni cron: la emisión la hace la API de facturación propia. Ver "Flujo de una guía".

## Comandos
```bash
php artisan serve
php artisan migrate
php artisan route:list --path=<prefijo>
php artisan despatches:duplicados [--eliminar]   # detecta (y opcionalmente borra) guías serie+correlativo duplicadas
php artisan docs:openapi                         # exporta openapi.json (Scramble)
bash scripts/backup-configuracion.sh [destino]   # backup de configuración sin guías (lee el .env)
bash scripts/restaurar-configuracion.sh <archivo> [--forzar]
bash scripts/vaciar-guias.sh [--si]              # backup completo + vacía guías/movimiento (TABLAS_SIN_DATOS en lib-mysql.sh)
```
- Despliegue: una instalación (clone + `.env` + BD) por empresa. Ver [docs/DESPLIEGUE.md](docs/DESPLIEGUE.md) y el checklist [docs/PASOS-VPS.md](docs/PASOS-VPS.md).
- Tests: solo los de ejemplo (`tests/`). `phpunit.xml` **no** usa sqlite en memoria: los tests usarían la BD real del `.env`.

## Convenciones
- **Todo en español**: modelos, métodos (`buscar`, `baja`, `disponible`), comentarios y mensajes. Mantener ese idioma.
- **Columnas**: en camelCase (`fechaEmision`, `nombreCorto`, `estadoSunat`); las llaves foráneas en `id_*` (`id_cliente`, `id_despatch`).
- **Respuestas JSON**: `{ exito: bool, message|error }`. Si serie+correlativo está duplicado → 409.
- **Organización**:
  - Resources en `app/Http/Resources`. Algunos nombres tienen errata: `ClienteResouce`, `PuntoubicacionResouce`.
  - FormRequests en `app/Http/Requests`, aunque muchos controladores validan en línea.
  - Servicios en `app/Services`.
- **Rutas**: todas en `routes/api.php`, bajo `auth:sanctum` + `abilities:web`, salvo `login`, `registro`, `convert`, `factiliza/*`, `webhooks/facturacion` (firma HMAC), `scop-temporal/*` (`X-Api-Key` si hay `SCOP_TEMPORAL_KEY`, o token móvil) y `movil/*` (app Android). El grupo `admin` usa el middleware `app/Http/Middleware/EsAdmin.php` (`users.perfil === 'admin'`).
- **Tokens**: el login web crea tokens con `*`. El de la app Android (`POST /api/movil/login`) solo tiene la ability `movil`, así que no entra al grupo web. No quites `abilities:web` del grupo principal. La app de guías obtiene su token `movil` sin contraseña con `POST /api/movil/vincular` (pide el token web).
- **Línea de código**: el repo usa LF; Git avisa de la conversión a CRLF en Windows.

## Dominio (resumen)
- `Despatch` (la guía: serie, correlativo, fechaEmision, cliente, tercero, comprador) se relaciona con:
  - `Shipment`: traslado, con motivo, modalidad, transportista, pesos y fechas.
  - Pivots `shipment_vehiculo` / `shipment_conductor`, con `tipo` P = principal o S = secundario.
  - `shipment_puntoubicacions`, con `tipo` P = partida o L = llegada.
  - `shipment_indicadores`.
  - `DespatchProducto` (ítems), `Adicionales` (documentos relacionados) y `Scop` (números SCOP; un número no puede repetirse en dos guías).
- **`ScopTemporal`** (`scop_temporal`): SCOP que carga otra app o la app móvil. **Un SCOP, un registro**: `nroScop` es único y `POST /api/scop-temporal` inserta o actualiza (solo los campos que cambiaron; un vacío nunca borra un dato), con `POST /api/scop-temporal/verificar` como vista previa que no guarda. La lógica está en `app/Services/ScopTemporalSincronizacion.php`. `lote` = la carga en que entró cada SCOP (no cambia al actualizar); `DELETE /api/scop-temporal/lotes/{lote}` borra esa carga. La placa se guarda normalizada (`ABC123`). No es la tabla `scop` (SCOP usados en guías). Al hacer la guía, el front los lista por placa con `GET /api/scop/temporales?placa=` (`ScopController::temporales`; los ya usados salen con `disponible: false` y su guía). En líquidos agrega `id_puntoubicacion` = punto de llegada: la app envía `idEstablecimiento` por SCOP (columna `id_puntoubicacion`) y salen los de ese punto más los que no lo traen; el SCOP elegido se bloquea recién al guardar la guía (`scops` → tabla `scop`, 409 si otra lo tomó).
- **Credenciales PVO** (Osinergmin): `CredencialPvo` (`credenciales_pvo`, usuario y clave con cast `encrypted`), una por establecimiento propio (`isCompany`) o placa propia **de GLP** (`isCompany` + `glp`; filtro en `CredencialPvo::validos`). Se entregan a la app Android cifradas con la llave del celular (`DispositivoMovil`, `CifradoDispositivo`) y cada entrega queda en `credenciales_pvo_accesos`. Acceso por `users.accesoMovil`, activo por defecto (el admin lo quita). Contrato en [docs/API-MOVIL.md](docs/API-MOVIL.md).
- **App móvil de guías** (React Native, aparte): Guía rápida + Consulta de guías con las rutas web existentes y SCOP por portal (`POST /api/scop/consulta`, no `scop_temporal`). Contrato en [docs/CONTRATO-APP-GUIAS-MOVIL.md](docs/CONTRATO-APP-GUIAS-MOVIL.md).
- **`EstadoElectronico`**: una fila por guía, con estado `P` pendiente, `F` final (ya no editable) o `B` baja. También guarda ticket, hash, hashQr, rutas XML/PDF/CDR y la respuesta de SUNAT.
- **Serie y correlativo**:
  - `Numeracion` pertenece a `PuntoEmision`, y los usuarios se asignan por `users_puntoemision`.
  - **El correlativo lo envía el cliente**; `store` actualiza `numeroActual`.
  - Hay un índice único `unique_serie_correlativo`, más un lock de fila.
- **Credenciales SUNAT**: en `sunat_parameters` (fila `activo=1` de la primera `Empresa`): client_id/secret GRE, usuario/clave SOL y certificado PEM en base64.
- **Una sola empresa**: el código usa `Empresa::first()`.

## Flujo de una guía
1. **Guardar**: `POST /api/despatches` (`DespatchController::store`) guarda todo en una transacción y crea `EstadoElectronico` con estado `P`. Funciona como borrador para revisar la guía.
2. **Guardar y enviar**: el mismo `POST` (o `PUT`) con `enviar=true`. Después de guardar, envía la guía por la API de facturación (`G:\codeigniterprojects\FacturacionApi`) y agrega `envio` a la respuesta. Si el envío falla, la guía queda guardada.
3. **Enviar un borrador**: `POST /api/despatches/{id}/enviar`. Para consultar: `POST /api/despatches/{id}/consultar`. Para PDF, XML o CDR: `GET /api/despatches/{id}/archivo`.
4. **Resultado de SUNAT**: llega por `POST /api/webhooks/facturacion` (público, firmado con HMAC) a `FacturacionApiService::aplicar()`. Estado local: `F` si fue aceptada u observada; `P` en cualquier otro caso, también si fue rechazada (se corrige y se reenvía con el mismo número).
5. **Mientras SUNAT procesa la guía o después de aceptada**, `update` responde 409.

La lógica está en `app/Services/FacturacionApiService.php`. Solo se emite la guía de remitente (09); no hay guía de transportista. La conexión (URL, token y secreto del webhook, estos dos cifrados) se guarda en `empresa.fe_*` y se administra con `/api/empresa/facturacion` (solo admin). Lo que falte ahí se toma del `.env` (`FE_*` en `config/services.php`). El flujo antiguo (un proceso externo que firma y luego hace `PUT /api/estadoelectronico/{id}`) sigue funcionando. Detalle en [docs/INTEGRACION-API-GUIAS.md](docs/INTEGRACION-API-GUIAS.md).

## Integraciones
- **FAFIO** (ERP): `MigracionGuiasController` lee almacenes y series de SQL Server y migra guías. `AlmacenFafio` mapea almacén ↔ punto de ubicación. Usar `nombreCortoGlobal()` para los datos que salen hacia FAFIO.
- **SCOP**: `ScopApiService` usa la `x-api-key` de `config('services.scop')`, con caché, timeouts y log de llamadas lentas. Es el patrón a copiar para nuevos clientes HTTP.
- **Factiliza**: `FactilizaCommonServices`, consulta de RUC/DNI (ya configurado).

## Favoritos y nombre corto (switch)
- `config/favoritos.php` → `FAVORITOS_POR_USUARIO`:
  - `false` (por defecto): `fav` y `nombreCorto` se guardan en las columnas de cada catálogo y los comparten todos.
  - `true`: cada usuario tiene los suyos en la tabla `favoritos` (morph map en `AppServiceProvider::TIPOS_FAVORITOS`), con opción de clonar.
- La lógica está en el trait `app/Models/Concerns/TieneFavoritos.php`, con los scopes `conPreferencias`, `filtrarFavorito` y `filtrarNombreCorto`. Los controladores no distinguen el modo; las rutas y respuestas son iguales.

## Cuidado
- `docs/INTEGRACION-ERP.md` y `docs/ejemplos/*.json` describen la **API de facturación externa**, no las rutas de este repo.
- **Seguridad pendiente**:
  - `GET /api/sunat/parametros` devuelve secretos y certificado (lo usa el flujo de firma antiguo).
  - `POST /api/convert` es público.
- Factiliza ya está configurado y no forma parte de los cambios: no tocarlo.
- `AlmacenFafio` referencia `PuntoUbicacion::class` (con U mayúscula), lo que falla en Linux, porque el modelo es `Puntoubicacion`.
- No hay base local accesible por defecto: pide al usuario que pruebe contra su BD.
