# guiasapi

API REST (Laravel 9) para registrar guías de remisión electrónicas (SUNAT, Perú) y sus catálogos: clientes, conductores, transportistas, vehículos, productos y puntos de ubicación.

## Inicio rápido
```bash
composer install
cp .env.example .env   # configurar DB_*, conexiones sqlsrv, API_SCOP*, FAVORITOS_POR_USUARIO
php artisan key:generate
php artisan migrate
php artisan serve
```
La documentación OpenAPI se genera con Scramble y se ve en `/docs/api`. Para exportarla: `php artisan docs:openapi`.

## Documentación
- [CLAUDE.md](CLAUDE.md): resumen, convenciones y advertencias del proyecto.
- [docs/ARQUITECTURA.md](docs/ARQUITECTURA.md): rutas, modelos, flujo actual de una guía y variables `.env`.
- [docs/INTEGRACION-API-GUIAS.md](docs/INTEGRACION-API-GUIAS.md): cómo inscribir la empresa en la API de facturación, el webhook, el mapeo de datos y el diseño de la integración.
- [docs/INTEGRACION-ERP.md](docs/INTEGRACION-ERP.md): contrato de la API de facturación externa (no son rutas de este repo).
