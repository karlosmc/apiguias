# Pasos para poner en producción (VPS)

Checklist de todo lo que hay que hacer, en orden. El porqué está en [DESPLIEGUE.md](DESPLIEGUE.md) y [INTEGRACION-API-GUIAS.md](INTEGRACION-API-GUIAS.md).

Valores de ejemplo (cámbialos por los tuyos):

| Qué | Ejemplo |
|---|---|
| guiasapi (esta API) | `/var/www/apiguiascentenario`, `https://apiguias.tudominio.com` |
| API de facturación | `/var/www/facturacionapi`, `https://facturacion.tudominio.com` |
| PHP del proyecto | **8.3**. La versión por defecto del VPS sigue siendo 8.2 por las otras aplicaciones |

> En este VPS, `php` es la 8.2. Para estos proyectos usa siempre **`php8.3`**: `php8.3 artisan ...` y `php8.3 /usr/local/bin/composer ...`.

---

## 1. Preparar el VPS (una sola vez)

```bash
sudo apt install php8.3-fpm php8.3-mysql php8.3-xml php8.3-mbstring php8.3-curl \
                 php8.3-zip php8.3-gd php8.3-bcmath php8.3-intl unzip
sudo systemctl restart php8.3-fpm
```

- [ ] Composer instalado (`which composer`). Si no está:
  `curl -sS https://getcomposer.org/installer | php && sudo mv composer.phar /usr/local/bin/composer`
- [ ] Consola y web con las mismas extensiones: `diff <(php8.3 -m | sort) <(php-fpm8.3 -m | sort)` no debe mostrar nada.
- [ ] Opcional, solo si la empresa usa FAFIO (SQL Server): driver `msodbcsql18` de Microsoft y `sudo pecl -d php_suffix=8.3 install sqlsrv pdo_sqlsrv`.

Alias opcionales en `~/.bashrc`, solo para tu usuario:

```bash
alias artisan83='php8.3 artisan'
alias composer83='php8.3 /usr/local/bin/composer'
```

---

## 2. guiasapi

```bash
cd /var/www
git clone git@github.com:karlosmc/apiguias.git apiguiascentenario
cd apiguiascentenario
php8.3 /usr/local/bin/composer install --no-dev --optimize-autoloader
cp .env.example .env && nano .env
```

- [ ] En el `.env`:
  - `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://apiguias.tudominio.com`
  - `DB_*` de la base de esta empresa
  - `QUEUE_CONNECTION=sync`: guiasapi **no usa colas** y no necesita worker
  - `DATABASE_SQL_*` y `DATABASE2_SQL_*` si usa FAFIO
  - `API_SCOP` y `API_KEY_SCOP`
- [ ] `APP_KEY`:
  - Si restauras el backup de Windows, **copia la `APP_KEY` de Windows**, porque el token de facturación está cifrado con ella.
  - Si no, genera una con `php8.3 artisan key:generate`.
- [ ] Restaurar la configuración (backup sacado en Windows con `bash scripts/backup-configuracion.sh`):
  ```bash
  # desde Windows:
  scp G:\laravelproyects\guiasapi\storage\app\backups\configuracion_....sql.gz usuario@IP_VPS:/root/backups/
  # en el VPS:
  bash scripts/restaurar-configuracion.sh /root/backups/configuracion_....sql.gz
  ```
- [ ] Migraciones y cachés:
  ```bash
  php8.3 artisan migrate --force
  php8.3 artisan config:cache
  php8.3 artisan route:cache
  sudo chown -R www-data:www-data storage bootstrap/cache
  ```
- [ ] Revisar que la numeración quedó con el último número de cada serie (el script de restauración la muestra).

---

## 3. Nginx + HTTPS (un bloque por proyecto)

`/etc/nginx/sites-available/apiguiascentenario`:

```nginx
server {
    listen 80;
    server_name apiguias.tudominio.com;
    root /var/www/apiguiascentenario/public;     # siempre /public
    index index.php;
    charset utf-8;
    client_max_body_size 20M;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;   # 8.3 solo para este sitio
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
        fastcgi_read_timeout 120;
    }

    location ~ /\.(?!well-known).* { deny all; }
}
```

```bash
sudo ln -s /etc/nginx/sites-available/apiguiascentenario /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
sudo certbot --nginx -d apiguias.tudominio.com      # antes: registro DNS A → IP del VPS
```

- [ ] `curl -I https://apiguias.tudominio.com/api/login` responde 405 o 422. No debe dar 404 ni 502.
- [ ] La API de facturación lleva el mismo bloque con su propio `server_name`, `root` y certificado.

---

## 4. API de facturación (FacturacionApi)

Si ya está en otro servidor, solo revisa que tenga el **worker de colas** y el **scheduler** (4.2 y 4.3).

### 4.1 Instalación

Requiere PHP **8.3** (Laravel 13).

```bash
cd /var/www/facturacionapi
php8.3 /usr/local/bin/composer install --no-dev --optimize-autoloader
# .env: APP_URL, DB_*, QUEUE_CONNECTION=database
php8.3 artisan migrate --force          # incluye la tabla jobs
php8.3 artisan config:cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

### 4.2 Worker de colas (obligatorio)

Sin worker, las guías **se quedan en cola y nunca llegan a SUNAT**. Ahí corren:
- `SendDocumentJob`: envío
- `CheckTicketJob`: consulta del ticket
- `DispatchWebhookJob`: aviso a guiasapi
- `DownloadSunatPdfJob`: PDF de SUNAT

Para que arranque solo, crea `/etc/systemd/system/facturacion-queue.service`:

```ini
[Unit]
Description=FacturacionApi - worker de colas
After=network.target mysql.service

[Service]
User=www-data
Group=www-data
WorkingDirectory=/var/www/facturacionapi
ExecStart=/usr/bin/php8.3 artisan queue:work --sleep=3 --max-time=3600
Restart=always
RestartSec=5

[Install]
WantedBy=multi-user.target
```

```bash
sudo systemctl daemon-reload
sudo systemctl enable --now facturacion-queue
sudo systemctl status facturacion-queue          # debe decir active (running)
journalctl -u facturacion-queue -f               # ver lo que procesa
```

- `--max-time=3600` reinicia el worker cada hora. `Restart=always` lo levanta de nuevo, y también si se cae.
- Los reintentos y esperas los define cada job. No hace falta `--tries`.
- Los jobs que fallan del todo quedan en `failed_jobs`:
  - `php8.3 artisan queue:failed` para verlos
  - `php8.3 artisan queue:retry all` para reintentarlos

### 4.3 Scheduler (obligatorio)

Lo usan:
- `fe:poll-tickets`, cada 5 minutos: consulta tickets pendientes
- `fe:pdf-sunat`, cada hora: reintenta los PDF de SUNAT
- `fe:cert-expiry`, a diario: avisa del vencimiento del certificado

```bash
sudo crontab -u www-data -e
```

```
* * * * * cd /var/www/facturacionapi && /usr/bin/php8.3 artisan schedule:run >> /dev/null 2>&1
```

- [ ] Para comprobarlo: `php8.3 artisan schedule:list`.

### 4.4 Inscribir la empresa

Detalle en [INTEGRACION-API-GUIAS.md](INTEGRACION-API-GUIAS.md).

- [ ] Cliente admin: `php8.3 artisan fe:client:create "Admin" --admin`
- [ ] Alta de la empresa (`POST /api/v1/companies`):
  - `entorno`: `beta` para pruebas, `produccion` al final
  - `webhookUrl`: `https://apiguias.tudominio.com/api/webhooks/facturacion`
  - `webhookSecret`: 16 caracteres o más
- [ ] Certificado (`POST /companies/{ruc}/certificate`), y SOL más GRE `greClientId`/`greClientSecret` (`PUT /companies/{ruc}/credentials`).
- [ ] Token para guiasapi: `php8.3 artisan fe:client:create "guiasapi" --ruc=<RUC>`
- [ ] `GET /companies/{ruc}` → `tieneCredencialesGre: true`

---

## 5. Conectar guiasapi con la API de facturación

- [ ] En el front, con un usuario admin: **Parámetros SUNAT → Conexión con la API de facturación**:
  - URL: `https://facturacion.tudominio.com/api/v1`
  - Token y secreto del webhook: los mismos del 4.4
  - **Probar** y luego **Guardar**
- [ ] Si los pones en el `.env` (`FE_API_URL`, `FE_API_TOKEN`, `FE_WEBHOOK_SECRET`) en lugar de la pantalla, ejecuta `php8.3 artisan config:cache`.

---

## 6. Front (modtest_client_ts)

- [ ] Variables del build:
  - `VITE_API_URL=https://apiguias.tudominio.com`
  - `VITE_EMISION_LEGACY=false`
  - Las demás `VITE_*` que ya usas: `VITE_API_LOGO`, `VITE_API_SCOP`, `VITE_API_URL_CONSULT_PERSONAS`, `VITE_GUIA_RAPIDA`
- [ ] `npm install && npm run build`, y sube `dist/` a su sitio en Nginx. Las `VITE_*` se leen al compilar: cualquier cambio exige recompilar.
- [ ] Recargar con Ctrl+F5. En la consola del navegador (F12) debe salir `[Emisión de guías] NUEVA`.

---

## 7. Prueba completa (en beta)

- [ ] Login desde el front.
- [ ] Crear una guía de prueba → **Revisar** → **Guardar y enviar**.
- [ ] El modal pasa de "Enviando" a "Aceptada". Si se queda en "Esperando", revisa el worker (4.2) y el scheduler (4.3).
- [ ] Ver PDF (A4), PDF SUNAT, XML y CDR descargan.
- [ ] En el panel, la guía queda en estado final.
- [ ] El webhook llegó: en `storage/logs/laravel.log` de guiasapi no hay errores de firma, y en la API el job no está en `failed_jobs`.
- [ ] Cuando todo esté bien: cambia la empresa a `entorno: produccion` en la API.

---

## 8. Actualizar después

```bash
# guiasapi
cd /var/www/apiguiascentenario
git pull --ff-only
php8.3 /usr/local/bin/composer install --no-dev --optimize-autoloader
php8.3 artisan migrate --force
php8.3 artisan config:cache && php8.3 artisan route:cache

# API de facturación: lo mismo, más reiniciar el worker para que tome el código nuevo
cd /var/www/facturacionapi
git pull --ff-only && php8.3 /usr/local/bin/composer install --no-dev --optimize-autoloader
php8.3 artisan migrate --force && php8.3 artisan config:cache
php8.3 artisan queue:restart
```

Nunca uses `composer update` en el VPS: solo `install`, que respeta el `composer.lock`.

---

## 9. Backups

Backup de configuración, sin guías: `bash scripts/backup-configuracion.sh /root/backups/empresa-a`.

Para programarlo, en `crontab -e`:

```
0 2 * * * cd /var/www/apiguiascentenario && bash scripts/backup-configuracion.sh /root/backups/empresa-a >> /var/log/backup-guias.log 2>&1 && find /root/backups/empresa-a -name '*.sql.gz' -mtime +30 -delete
```

Ese backup **no incluye las guías**. Para no perderlas, programa también un `mysqldump` completo de la base.

---

## 10. Problemas comunes

| Error | Causa | Solución |
|---|---|---|
| `vendor/autoload.php: No such file` | Falta `composer install` | `php8.3 /usr/local/bin/composer install --no-dev` |
| `could not find driver` | A la versión de PHP que usa Nginx le falta `pdo_mysql` | `sudo apt install php8.3-mysql && sudo systemctl restart php8.3-fpm` |
| 502 Bad Gateway | `fastcgi_pass` no coincide con el socket | `ls /run/php/` y corrige el bloque de Nginx |
| 500 | Permisos o `.env` | `storage/logs/laravel.log`; `sudo chown -R www-data:www-data storage bootstrap/cache` |
| La guía se queda en "Esperando" | No corre el worker o el scheduler de la API | `systemctl status facturacion-queue`, `schedule:list` |
| `The payload is invalid` al enviar | `APP_KEY` distinta a la de origen | Vuelve a guardar el token y el secreto en la configuración de facturación |
| Cambié el `.env` y no toma | Caché de configuración | `php8.3 artisan config:cache` |

---

## 11. Seguridad pendiente (antes de abrir a usuarios)

- [ ] `APP_DEBUG=false` en las dos APIs.
- [ ] `config/cors.php`: cambiar `allowed_origins => ['*']` por el dominio del front.
- [ ] `GET /api/sunat/parametros` devuelve el certificado y las claves. Con `VITE_EMISION_LEGACY=false` el front ya no lo necesita: conviene restringirlo o retirarlo.
- [ ] `POST /api/convert` es público.
- [ ] Los backups (`.sql.gz`) contienen el certificado y la clave SOL: guárdalos fuera de `public/` y con acceso restringido.
