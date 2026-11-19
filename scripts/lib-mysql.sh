#!/usr/bin/env bash
#
# Funciones comunes de backup-configuracion.sh, restaurar-configuracion.sh y
# vaciar-guias.sh. No se ejecuta sola.

# Tablas de configuración: el backup las copia CON datos y vaciar-guias.sh no las toca.
TABLAS_CONFIGURACION=(
  migrations
  empresa sunat_parameters
  users users_puntoemision puntos_emision numeracion numeracion_vehiculos
  tipo_documentos motivo_traslado modalidad_traslado indicadores ubigeos puerto
  puntoubicacion almacen_fafio clientes transportistas conductores vehiculos
  productos productos_fafio favoritos
  credenciales_pvo
)

# Tablas de movimiento (guías, envíos, estado electrónico, SCOP, sesiones, token
# SUNAT en caché): el backup copia solo su estructura y vaciar-guias.sh las vacía.
# Una tabla nueva va en una de las dos listas; si no, los scripts avisan.
TABLAS_SIN_DATOS=(
  despatches despatch_productos adicionales estado_electronico scop
  shipments shipment_vehiculo shipment_conductor shipment_puntoubicacions shipment_indicadores
  scop_temporal dispositivos_moviles credenciales_pvo_accesos personal_access_tokens password_resets failed_jobs token_sunat
)

contiene() { local x="$1"; shift; for e in "$@"; do [ "$e" = "$x" ] && return 0; done; return 1; }

fallar() { echo "ERROR: $*" >&2; exit 1; }
aviso()  { echo "AVISO: $*" >&2; }

# Valor de una clave del .env, sin comillas, espacios ni \r (archivos editados en Windows)
leer_env() {
  local archivo="$1" clave="$2" valor
  valor="$(grep -E "^[[:space:]]*${clave}[[:space:]]*=" "$archivo" | tail -n 1 || true)"
  valor="${valor#*=}"
  valor="${valor%$'\r'}"
  valor="$(printf '%s' "$valor" | sed -E 's/^[[:space:]]+//; s/[[:space:]]+$//')"
  if [[ "$valor" =~ ^\"(.*)\"$ ]] || [[ "$valor" =~ ^\'(.*)\'$ ]]; then
    valor="${BASH_REMATCH[1]}"
  fi
  printf '%s' "$valor"
}

# Lee la conexión del .env y deja las credenciales en un archivo temporal
# (permisos 600, se borra al salir): así la contraseña no queda a la vista en `ps`.
preparar_conexion() {
  local env="$1" usuario clave
  [ -f "$env" ] || fallar "No existe $env. Ejecuta el script dentro de la carpeta de la instalación."

  local conexion
  conexion="$(leer_env "$env" DB_CONNECTION)"
  [ -z "$conexion" ] || [ "$conexion" = "mysql" ] || fallar "DB_CONNECTION=$conexion: el script solo funciona con mysql."

  DB="$(leer_env "$env" DB_DATABASE)"
  DB_HOST="$(leer_env "$env" DB_HOST)"; DB_HOST="${DB_HOST:-127.0.0.1}"
  DB_PORT="$(leer_env "$env" DB_PORT)"; DB_PORT="${DB_PORT:-3306}"
  usuario="$(leer_env "$env" DB_USERNAME)"
  clave="$(leer_env "$env" DB_PASSWORD)"
  [ -n "$DB" ] || fallar "DB_DATABASE está vacío en $env."
  [ -n "$usuario" ] || fallar "DB_USERNAME está vacío en $env."

  command -v mysql >/dev/null || fallar "No se encontró el cliente mysql."

  CREDENCIALES="$(mktemp)"
  chmod 600 "$CREDENCIALES"
  trap 'rm -f "$CREDENCIALES"' EXIT

  # En los archivos de opciones de MySQL la \ y la " se escapan
  clave="${clave//\\/\\\\}"
  clave="${clave//\"/\\\"}"
  {
    echo "[client]"
    echo "host=$DB_HOST"
    echo "port=$DB_PORT"
    echo "user=$usuario"
    echo "password=\"$clave\""
  } > "$CREDENCIALES"

  mysql_cmd -e 'SELECT 1' "$DB" >/dev/null || fallar "No se pudo conectar a '$DB' en $DB_HOST:$DB_PORT con el usuario del .env."
}

# --defaults-extra-file tiene que ir primero
mysql_cmd()     { mysql --defaults-extra-file="$CREDENCIALES" "$@"; }
mysqldump_cmd() { mysqldump --defaults-extra-file="$CREDENCIALES" "$@"; }
