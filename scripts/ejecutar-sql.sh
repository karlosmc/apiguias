#!/usr/bin/env bash
#
# Ejecuta un archivo .sql (varias sentencias) en la base de ESTA instalación,
# con la conexión del .env. Antes saca un backup completo y pide confirmar.
#
#   bash scripts/ejecutar-sql.sh scripts/sql/correlativos.sql
#   bash scripts/ejecutar-sql.sh <archivo.sql> --si          (sin preguntar)
#   ENV_FILE=.env.empresa-b bash scripts/ejecutar-sql.sh <archivo.sql>
#
# Las sentencias corren en orden y se detiene en la primera que falle
# (las anteriores ya quedaron hechas: para volver atrás está el backup).

set -euo pipefail

RAIZ="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
# shellcheck source=scripts/lib-mysql.sh
source "$RAIZ/scripts/lib-mysql.sh"

ARCHIVO="${1:-}"
OPCION="${2:-}"
[ -n "$ARCHIVO" ] || fallar "Indica el archivo: bash scripts/ejecutar-sql.sh <archivo.sql> [--si]"
[ -f "$ARCHIVO" ] || fallar "No existe el archivo $ARCHIVO."
[ -z "$OPCION" ] || [ "$OPCION" = "--si" ] || fallar "Opción desconocida: $OPCION (solo --si)"

preparar_conexion "${ENV_FILE:-$RAIZ/.env}"
command -v mysqldump >/dev/null || fallar "No se encontró mysqldump (instala el cliente de MySQL/MariaDB)."

echo "Base:    $DB ($DB_HOST:$DB_PORT)"
echo "Archivo: $ARCHIVO"
echo
echo "----- sentencias -----"
grep -vE '^[[:space:]]*(--|$)' "$ARCHIVO" || true
echo "----------------------"
echo

mkdir -p "$RAIZ/storage/app/backups"
BACKUP="$RAIZ/storage/app/backups/completo_${DB}_$(date +%Y%m%d_%H%M%S).sql.gz"
echo "Backup completo: $BACKUP"
mysqldump_cmd --single-transaction --no-tablespaces "$DB" | gzip > "$BACKUP.tmp"
mv "$BACKUP.tmp" "$BACKUP"
echo

if [ "$OPCION" != "--si" ]; then
  read -r -p "Escribe el nombre de la base para ejecutar el archivo en '$DB': " RESPUESTA
  [ "$RESPUESTA" = "$DB" ] || fallar "Cancelado: no se ejecutó nada (el backup quedó en $BACKUP)."
fi

# -v muestra la salida de los SELECT con encabezados; se detiene en el primer error
mysql_cmd -v -t "$DB" < "$ARCHIVO" || fallar "Falló una sentencia (las anteriores sí se aplicaron). Para volver atrás: gunzip -c $BACKUP | mysql <base>"

echo
echo "Listo. Backup previo: $BACKUP"
