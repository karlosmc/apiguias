#!/usr/bin/env bash
#
# Restaura un backup de backup-configuracion.sh en la base de ESTA instalación
# (la del .env de la carpeta donde se ejecuta).
#
#   bash scripts/restaurar-configuracion.sh storage/app/backups/configuracion_guias_a_20261113_101500.sql.gz
#   bash scripts/restaurar-configuracion.sh <archivo> --forzar     (si la base ya tiene guías)
#   ENV_FILE=.env.empresa-b bash scripts/restaurar-configuracion.sh <archivo>  (otra base)
#
# OJO: el backup trae `DROP TABLE` de todas las tablas. Si la base de destino
# ya tiene guías se borran; por eso el script se niega salvo con --forzar.

set -euo pipefail

RAIZ="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
# shellcheck source=scripts/lib-mysql.sh
source "$RAIZ/scripts/lib-mysql.sh"

ARCHIVO="${1:-}"
FORZAR="${2:-}"
[ -n "$ARCHIVO" ] || fallar "Indica el archivo: bash scripts/restaurar-configuracion.sh <backup.sql.gz> [--forzar]"
[ -f "$ARCHIVO" ] || fallar "No existe el archivo $ARCHIVO."
[ -z "$FORZAR" ] || [ "$FORZAR" = "--forzar" ] || fallar "Opción desconocida: $FORZAR"

preparar_conexion "${ENV_FILE:-$RAIZ/.env}"

# ¿La base de destino ya tiene guías?
GUIAS=0
if mysql_cmd -N -B -e "SHOW TABLES LIKE 'despatches'" "$DB" | grep -q despatches; then
  GUIAS="$(mysql_cmd -N -B -e 'SELECT COUNT(*) FROM despatches' "$DB" | tr -d '\r')"
fi
if [ "$GUIAS" != "0" ] && [ "$FORZAR" != "--forzar" ]; then
  fallar "La base '$DB' tiene $GUIAS guías y la restauración las BORRARÍA. Si de verdad quieres reemplazarla, repite con --forzar."
fi

echo "Restaurando $ARCHIVO en '$DB' ($DB_HOST:$DB_PORT)..."
case "$ARCHIVO" in
  *.gz) gunzip -c "$ARCHIVO" | mysql_cmd "$DB" ;;
  *)    mysql_cmd "$DB" < "$ARCHIVO" ;;
esac

echo
echo "Numeración restaurada (el siguiente correlativo parte de aquí):"
mysql_cmd -t -e 'SELECT serie, nombre, numeroActual FROM numeracion ORDER BY serie' "$DB" || true

cat <<'FIN'

Listo. Ahora, en esta misma carpeta:

  php artisan migrate --force     # aplica las migraciones que falten
  php artisan config:cache

Si la APP_KEY de esta instalación no es la de la instalación de origen, vuelve
a guardar el token y el secreto de la API de facturación desde la pantalla de
configuración (están cifrados con la APP_KEY).
FIN
