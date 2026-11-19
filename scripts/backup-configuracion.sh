#!/usr/bin/env bash
#
# Backup de la CONFIGURACIÓN de una instalación de guiasapi, sin las guías.
#
# Uso, desde la carpeta de la instalación (p. ej. /var/www/guias/empresa-a):
#
#   bash scripts/backup-configuracion.sh                  -> storage/app/backups/
#   bash scripts/backup-configuracion.sh /ruta/destino
#   ENV_FILE=.env.empresa-b bash scripts/backup-configuracion.sh   (otra base: lee ese archivo en vez del .env)
#
# La conexión MySQL se lee del .env de la instalación (DB_HOST, DB_PORT,
# DB_DATABASE, DB_USERNAME, DB_PASSWORD), así que cada empresa saca el backup
# de su propia base. La contraseña no aparece en la línea de comandos.
#
# Genera un solo archivo configuracion_<base>_<fecha>.sql.gz con:
#   1) la estructura de TODAS las tablas, sin datos;
#   2) los datos de las tablas de configuración, incluida `numeracion` con su
#      último número (numeroActual), para seguir el correlativo donde quedó.
#
# Se restaura con scripts/restaurar-configuracion.sh. Detalle en docs/DESPLIEGUE.md.

set -euo pipefail

# Las listas TABLAS_CONFIGURACION y TABLAS_SIN_DATOS están en scripts/lib-mysql.sh
# (las comparte con vaciar-guias.sh).

RAIZ="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
# shellcheck source=scripts/lib-mysql.sh
source "$RAIZ/scripts/lib-mysql.sh"

DESTINO="${1:-$RAIZ/storage/app/backups}"

preparar_conexion "${ENV_FILE:-$RAIZ/.env}"
command -v mysqldump >/dev/null || fallar "No se encontró mysqldump (instala el cliente de MySQL/MariaDB)."

mapfile -t EXISTENTES < <(mysql_cmd -N -B -e 'SHOW TABLES' "$DB" | tr -d '\r')
[ "${#EXISTENTES[@]}" -gt 0 ] || fallar "La base '$DB' no tiene tablas."


CON_DATOS=()
for t in "${TABLAS_CONFIGURACION[@]}"; do
  if contiene "$t" "${EXISTENTES[@]}"; then
    CON_DATOS+=("$t")
  else
    aviso "La tabla '$t' no existe en '$DB'; se omite."
  fi
done
contiene migrations "${CON_DATOS[@]}" || fallar "Falta la tabla 'migrations': sin ella el backup no sirve para restaurar."

for t in "${EXISTENTES[@]}"; do
  if ! contiene "$t" "${TABLAS_CONFIGURACION[@]}" && ! contiene "$t" "${TABLAS_SIN_DATOS[@]}"; then
    aviso "La tabla '$t' no está clasificada: se copia solo su estructura (agrégala a TABLAS_CONFIGURACION si es configuración)."
  fi
done

mkdir -p "$DESTINO"
ARCHIVO="$DESTINO/configuracion_${DB}_$(date +%Y%m%d_%H%M%S).sql.gz"

echo "Base:    $DB ($DB_HOST:$DB_PORT)"
echo "Destino: $ARCHIVO"

# --single-transaction: copia consistente sin bloquear las tablas (InnoDB)
# --no-tablespaces: evita exigir el privilegio PROCESS en MySQL 8
{
  echo "-- Backup de configuración de guiasapi: base $DB, $(date '+%Y-%m-%d %H:%M:%S')"
  echo "-- Estructura de todas las tablas + datos de: ${CON_DATOS[*]}"
  mysqldump_cmd --single-transaction --no-tablespaces --no-data "$DB"
  mysqldump_cmd --single-transaction --no-tablespaces --no-create-info --skip-triggers "$DB" "${CON_DATOS[@]}"
} | gzip > "$ARCHIVO.tmp"
mv "$ARCHIVO.tmp" "$ARCHIVO"

echo
echo "Último número por serie incluido en el backup:"
mysql_cmd -t -e 'SELECT serie, nombre, numeroActual FROM numeracion ORDER BY serie' "$DB" || true

echo
echo "Listo: $ARCHIVO ($(du -h "$ARCHIVO" | cut -f1))"
