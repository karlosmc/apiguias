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

# Tablas que se copian CON datos. Las demás (guías, envíos, estado
# electrónico, SCOP, sesiones, token SUNAT en caché) solo con su estructura.
TABLAS_CONFIGURACION=(
  migrations
  empresa sunat_parameters
  users users_puntoemision puntos_emision numeracion numeracion_vehiculos
  tipo_documentos motivo_traslado modalidad_traslado indicadores ubigeos puerto
  puntoubicacion almacen_fafio clientes transportistas conductores vehiculos
  productos productos_fafio favoritos
  credenciales_pvo
)

# Las que se dejan vacías a propósito (solo para avisar de tablas nuevas que
# no estén en ninguna de las dos listas).
TABLAS_SIN_DATOS=(
  despatches despatch_productos adicionales estado_electronico scop
  shipments shipment_vehiculo shipment_conductor shipment_puntoubicacions shipment_indicadores
  scop_temporal dispositivos_moviles credenciales_pvo_accesos personal_access_tokens password_resets failed_jobs token_sunat
)

RAIZ="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
# shellcheck source=scripts/lib-mysql.sh
source "$RAIZ/scripts/lib-mysql.sh"

DESTINO="${1:-$RAIZ/storage/app/backups}"

preparar_conexion "${ENV_FILE:-$RAIZ/.env}"
command -v mysqldump >/dev/null || fallar "No se encontró mysqldump (instala el cliente de MySQL/MariaDB)."

mapfile -t EXISTENTES < <(mysql_cmd -N -B -e 'SHOW TABLES' "$DB" | tr -d '\r')
[ "${#EXISTENTES[@]}" -gt 0 ] || fallar "La base '$DB' no tiene tablas."

contiene() { local x="$1"; shift; for e in "$@"; do [ "$e" = "$x" ] && return 0; done; return 1; }

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
