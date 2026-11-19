#!/usr/bin/env bash
#
# Vacía las guías y el movimiento de una instalación de guiasapi, dejando la
# configuración intacta (empresa, usuarios, catálogos, numeración, credenciales
# SUNAT y PVO). Sirve para pasar una instalación de pruebas a producción.
#
# Uso, desde la carpeta de la instalación:
#
#   bash scripts/vaciar-guias.sh                 -> backup completo + confirmación + vaciado
#   bash scripts/vaciar-guias.sh --si            -> sin preguntar (el backup se hace igual)
#   ENV_FILE=.env.empresa-b bash scripts/vaciar-guias.sh   (otra base)
#
# Vacía las tablas de TABLAS_SIN_DATOS (scripts/lib-mysql.sh). Antes saca un
# backup COMPLETO (con guías) en storage/app/backups/ por si hay que volver atrás.
# Vaciar personal_access_tokens cierra la sesión de todos (web y app).
# La numeración (numeroActual) no se toca: ajústala después.

set -euo pipefail

RAIZ="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
# shellcheck source=scripts/lib-mysql.sh
source "$RAIZ/scripts/lib-mysql.sh"

OPCION="${1:-}"
[ -z "$OPCION" ] || [ "$OPCION" = "--si" ] || fallar "Opción desconocida: $OPCION (solo --si)"

preparar_conexion "${ENV_FILE:-$RAIZ/.env}"
command -v mysqldump >/dev/null || fallar "No se encontró mysqldump (instala el cliente de MySQL/MariaDB)."

mapfile -t EXISTENTES < <(mysql_cmd -N -B -e 'SHOW TABLES' "$DB" | tr -d '\r')
[ "${#EXISTENTES[@]}" -gt 0 ] || fallar "La base '$DB' no tiene tablas."

# Tablas sin clasificar: no se tocan, solo se avisa
for t in "${EXISTENTES[@]}"; do
  if ! contiene "$t" "${TABLAS_CONFIGURACION[@]}" && ! contiene "$t" "${TABLAS_SIN_DATOS[@]}"; then
    aviso "La tabla '$t' no está clasificada: NO se vacía (agrégala a TABLAS_SIN_DATOS en scripts/lib-mysql.sh si corresponde)."
  fi
done

A_VACIAR=()
for t in "${TABLAS_SIN_DATOS[@]}"; do
  contiene "$t" "${EXISTENTES[@]}" && A_VACIAR+=("$t")
done
[ "${#A_VACIAR[@]}" -gt 0 ] || fallar "No hay tablas que vaciar en '$DB'."

echo "Base: $DB ($DB_HOST:$DB_PORT)"
echo
echo "Filas actuales:"
for t in "${A_VACIAR[@]}"; do
  printf '  %-28s %s\n' "$t" "$(mysql_cmd -N -B -e "SELECT COUNT(*) FROM \`$t\`" "$DB" | tr -d '\r')"
done
echo

# Backup completo antes de borrar
mkdir -p "$RAIZ/storage/app/backups"
BACKUP="$RAIZ/storage/app/backups/completo_${DB}_$(date +%Y%m%d_%H%M%S).sql.gz"
echo "Backup completo: $BACKUP"
mysqldump_cmd --single-transaction --no-tablespaces "$DB" | gzip > "$BACKUP.tmp"
mv "$BACKUP.tmp" "$BACKUP"
echo

if [ "$OPCION" != "--si" ]; then
  read -r -p "Se vaciarán ${#A_VACIAR[@]} tablas de '$DB'. Escribe el nombre de la base para confirmar: " RESPUESTA
  [ "$RESPUESTA" = "$DB" ] || fallar "Cancelado: no se borró nada (el backup quedó en $BACKUP)."
fi

SQL="SET FOREIGN_KEY_CHECKS=0;"
for t in "${A_VACIAR[@]}"; do SQL+=" TRUNCATE TABLE \`$t\`;"; done
SQL+=" SET FOREIGN_KEY_CHECKS=1;"
mysql_cmd -e "$SQL" "$DB"

echo "Listo: ${#A_VACIAR[@]} tablas vacías."
echo
echo "Numeración actual (ajusta numeroActual al último número usado de cada serie):"
mysql_cmd -e 'SELECT id, serie, numeroActual FROM numeracion' "$DB"
echo
echo "Ejemplo: UPDATE numeracion SET numeroActual = 1523 WHERE serie = 'T001';"
echo "Para volver atrás: gunzip -c $BACKUP | mysql <base>"
