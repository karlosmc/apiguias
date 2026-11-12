# CLAUDE.md — guiasapi

Backend (API REST) para registrar **guías de remisión electrónicas** (SUNAT, Perú) y sus catálogos.
Lo consume un frontend propio. Más detalle en [docs/ARQUITECTURA.md](docs/ARQUITECTURA.md).

## Stack
- Laravel 9 (PHP ^8.0.2), MySQL como conexión por defecto.
- Paquetes: Sanctum (tokens Bearer), Scramble (OpenAPI en `/docs/api`), Guzzle, PhpSpreadsheet (exportar Excel) y doctrine/dbal.
- Conexiones extra a SQL Server: `sqlsrv` y `sqlsrv2`, que usa la migración de guías hacia el ERP FAFIO.
- No hay librería XML/SUNAT (greenter), colas, cron ni generación de PDF. Ver "Flujo de una guía".

## Comandos
```bash
php artisan serve
php artisan migrate
php artisan route:list --path=<prefijo>
php artisan despatches:duplicados [--eliminar]   # detecta (y opcionalmente borra) guías serie+correlativo duplicadas
php artisan docs:openapi                         # exporta openapi.json (Scramble)
```
- Tests: solo los de ejemplo (`tests/`). `phpunit.xml` **no** usa sqlite en memoria: los tests usarían la BD real del `.env`.

## Convenciones
- **Todo en español**: modelos, métodos (`buscar`, `baja`, `disponible`), comentarios y mensajes. Mantener ese idioma.
- **Columnas**: en camelCase (`fechaEmision`, `nombreCorto`, `estadoSunat`); las llaves foráneas en `id_*` (`id_cliente`, `id_despatch`).
- **Respuestas JSON**: `{ exito: bool, message|error }`. Si serie+correlativo está duplicado → 409.
- **Organización**:
  - Resources en `app/Http/Resources`. Algunos nombres tienen errata: `ClienteResouce`, `PuntoubicacionResouce`.
  - FormRequests en `app/Http/Requests`, aunque muchos controladores validan en línea.
  - Servicios en `app/Services`.
- **Rutas**: todas en `routes/api.php`, bajo `auth:sanctum`, salvo `login`, `registro`, `convert` y `factiliza/*`. El grupo `admin` usa el middleware `app/Http/Middleware/EsAdmin.php` (`users.perfil === 'admin'`).
- **Línea de código**: el repo usa LF; Git avisa de la conversión a CRLF en Windows.

## Dominio (resumen)
- `Despatch` (la guía: serie, correlativo, fechaEmision, cliente, tercero, comprador) se relaciona con:
  - `Shipment`: traslado, con motivo, modalidad, transportista, pesos y fechas.
  - Pivots `shipment_vehiculo` / `shipment_conductor`, con `tipo` P = principal o S = secundario.
  - `shipment_puntoubicacions`, con `tipo` P = partida o L = llegada.
  - `shipment_indicadores`.
  - `DespatchProducto` (ítems), `Adicionales` (documentos relacionados) y `Scop` (números SCOP; un número no puede repetirse en dos guías).
- **`EstadoElectronico`**: una fila por guía, con estado `P` pendiente, `F` final (ya no editable) o `B` baja. También guarda ticket, hash, hashQr, rutas XML/PDF/CDR y la respuesta de SUNAT.
- **Serie y correlativo**:
  - `Numeracion` pertenece a `PuntoEmision`, y los usuarios se asignan por `users_puntoemision`.
  - **El correlativo lo envía el cliente**; `store` actualiza `numeroActual`.
  - Hay un índice único `unique_serie_correlativo`, más un lock de fila.
- **Credenciales SUNAT**: en `sunat_parameters` (fila `activo=1` de la primera `Empresa`): client_id/secret GRE, usuario/clave SOL y certificado PEM en base64.
- **Una sola empresa**: el código usa `Empresa::first()`.

## Flujo de una guía (estado actual)
1. `POST /api/despatches` (`DespatchController::store`) guarda todo en una transacción y crea `EstadoElectronico` con estado `P`.
2. **Un proceso externo** (el front u otro servicio) arma el XML, firma, envía a SUNAT y consulta el ticket. Para eso lee las credenciales con `GET /api/sunat/parametros`.
3. Ese proceso escribe el resultado con `PUT /api/estadoelectronico/{id}` (update genérico, sin validación).

Se planea que **guiasapi** emita a través de la API de facturación propia (`G:\codeigniterprojects\FacturacionApi`). Ver [docs/INTEGRACION-API-GUIAS.md](docs/INTEGRACION-API-GUIAS.md).

## Integraciones
- **FAFIO** (ERP): `MigracionGuiasController` lee almacenes y series de SQL Server y migra guías. `AlmacenFafio` mapea almacén ↔ punto de ubicación. Usar `nombreCortoGlobal()` para los datos que salen hacia FAFIO.
- **SCOP**: `ScopApiService` usa la `x-api-key` de `config('services.scop')`, con caché, timeouts y log de llamadas lentas. Es el patrón a copiar para nuevos clientes HTTP.
- **Factiliza**: `FactilizaCommonServices`, consulta de RUC/DNI.

## Favoritos y nombre corto (switch)
- `config/favoritos.php` → `FAVORITOS_POR_USUARIO`:
  - `false` (por defecto): `fav` y `nombreCorto` se guardan en las columnas de cada catálogo y los comparten todos.
  - `true`: cada usuario tiene los suyos en la tabla `favoritos` (morph map en `AppServiceProvider::TIPOS_FAVORITOS`), con opción de clonar.
- La lógica está en el trait `app/Models/Concerns/TieneFavoritos.php`, con los scopes `conPreferencias`, `filtrarFavorito` y `filtrarNombreCorto`. Los controladores no distinguen el modo; las rutas y respuestas son iguales.

## Cuidado
- `docs/INTEGRACION-ERP.md` y `docs/ejemplos/*.json` describen la **API de facturación externa**, no las rutas de este repo.
- **Seguridad pendiente**:
  - Token JWT de Factiliza escrito en `app/Services/FactilizaCommonServices.php`.
  - `GET /api/sunat/parametros` devuelve secretos y certificado.
  - `POST /api/convert` y `/api/factiliza/*` son públicos.
- `AlmacenFafio` referencia `PuntoUbicacion::class` (con U mayúscula), lo que falla en Linux, porque el modelo es `Puntoubicacion`.
- No hay base local accesible por defecto: pide al usuario que pruebe contra su BD.
