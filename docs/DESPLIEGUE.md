# Despliegue en el VPS (varias empresas)

> Checklist paso a paso: [PASOS-VPS.md](PASOS-VPS.md).

El código está pensado para **una empresa por base de datos** (`Empresa::first()`, `sunat_parameters`). Para varias empresas se usa el mismo repositorio con una instalación por empresa:

```
/var/www/guias/
├── empresa-a/   ← git clone + su .env (BD guias_a, APP_KEY propia)
├── empresa-b/
└── empresa-c/
```

```bash
cd /var/www/guias
git clone git@github.com:karlosmc/apiguias.git empresa-a   # el último argumento es el nombre de la carpeta
```

- Cada instalación tiene su `.env` (copia de `.env.example`), que nunca se sube a git. Ahí van `DB_*`, `DATABASE_SQL_*` / `DATABASE2_SQL_*` (FAFIO), `APP_URL`, `SANCTUM_STATEFUL_DOMAINS` y `FE_*`.
- Cada una tiene su subdominio en Nginx, que apunta a su `public/`.
- En la API de facturación, cada empresa tiene su propio token (`fe:client:create --ruc=<RUC>`) y su `webhookUrl` apunta a su subdominio.
- **`APP_KEY`**: `empresa.fe_api_token` y `empresa.fe_webhook_secret` están cifrados con ella. Si se restaura una base en una instalación con otra `APP_KEY`, hay que volver a guardar esos dos valores desde la configuración de facturación.

## Backup de la configuración (sin guías)

`scripts/backup-configuracion.sh` copia la **estructura de todas las tablas** y los **datos solo de la configuración**:

- `migrations`
- empresa y SUNAT: `empresa`, `sunat_parameters`
- usuarios y numeración: `users`, puntos de emisión, `numeracion` con su **último número** y `numeracion_vehiculos`
- catálogos: tipos de documento, motivos, modalidades, indicadores, ubigeos, puertos, puntos de ubicación, almacenes FAFIO, clientes, transportistas, conductores, vehículos, productos y favoritos

Las guías y todo lo que cuelga de ellas quedan vacías: `despatches`, `despatch_productos`, `shipments`, `shipment_*`, `adicionales`, `estado_electronico` y `scop`. También quedan vacías las sesiones, `password_resets`, `failed_jobs` y `token_sunat`.

Los scripts leen la conexión del `.env` de la carpeta donde se ejecutan, así que **cada empresa saca y restaura su propio backup**. Necesitan el cliente `mysql`/`mysqldump` y bash (en Windows: Git Bash).

### Sacar el backup

```bash
cd /var/www/guias/empresa-a
bash scripts/backup-configuracion.sh                 # → storage/app/backups/configuracion_guias_a_<fecha>.sql.gz
bash scripts/backup-configuracion.sh /root/backups   # u otra carpeta
```

Al terminar muestra el último número de cada serie incluido en el backup. Avisa si una tabla de la lista no existe, o si hay una tabla nueva que no está clasificada. En ese caso agrégala a `TABLAS_CONFIGURACION` o `TABLAS_SIN_DATOS` dentro del script.

### Desde Windows

Usa **Git Bash**, no PowerShell ni CMD. Necesitas `mysqldump` en el PATH; el de Laragon (`C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin`) ya lo está.

```bash
cd /g/laravelproyects/guiasapi
bash scripts/backup-configuracion.sh                         # base del .env
bash scripts/backup-configuracion.sh /d/backups/empresa-a    # otra carpeta (D:\backups\empresa-a)
```

Para sacar las tres empresas desde la misma carpeta, crea un archivo por empresa con solo la conexión (`.env.*` está en `.gitignore`):

```
# .env.empresa-b
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=guias_b
DB_USERNAME=root
DB_PASSWORD=
```

```bash
ENV_FILE=.env.empresa-b bash scripts/backup-configuracion.sh /d/backups/empresa-b
```

Luego subes el `.sql.gz` al VPS (WinSCP o `scp archivo.sql.gz usuario@vps:/root/backups/`) y lo restauras allá.

**Cuidado**: el archivo trae `sunat_parameters` (certificado y clave SOL) y los usuarios. Guárdalo en un lugar protegido. No lo compartas ni lo subas a git; `storage/app/backups` ya está ignorado.

### Restaurar

```bash
cd /var/www/guias/empresa-a          # la instalación de destino (su .env manda)
bash scripts/restaurar-configuracion.sh /ruta/configuracion_guias_a_<fecha>.sql.gz
php artisan migrate --force
php artisan config:cache
```

El backup trae `DROP TABLE` de todas las tablas. Si la base de destino ya tiene guías, el script se niega y avisa cuántas borraría. Solo con `--forzar` al final las reemplaza.

### Programarlo (opcional)

Con `crontab -e`, para un backup diario a las 2:00 que borra los de más de 30 días:

```
0 2 * * * cd /var/www/guias/empresa-a && bash scripts/backup-configuracion.sh /root/backups/empresa-a >> /var/log/backup-guias-a.log 2>&1 && find /root/backups/empresa-a -name '*.sql.gz' -mtime +30 -delete
```
