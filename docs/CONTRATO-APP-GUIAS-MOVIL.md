# Contrato: app móvil de guías (Guía rápida + Consulta de guías)

Este documento es para quien construya la app en **React Native + NativeWind**. Describe las llamadas a **guiasapi** y las reglas de negocio que hoy cumple el front web (`modtest_client_ts`) en dos pantallas:

- **Guía rápida**: crear una guía de remisión eligiendo SCOP y enviarla a SUNAT.
- **Consulta de guías**: lista, estado, reenvío, baja y archivos (PDF/XML/CDR).

> **Los SCOP se consultan al portal** con `POST /api/scop/consulta`, como hacía el front antes de `scop_temporal`. La app **no** usa `GET /api/scop/temporales`.

Este contrato no cubre otras pantallas, como el formulario completo de guía o los mantenimientos.

---

## 1. Stack recomendado y compatibilidad

| Tema | Recomendación |
|---|---|
| Base | Expo (SDK actual) + TypeScript + `expo-router` |
| Estilos | NativeWind v4 (Tailwind 3) |
| Android mínimo | **API 24 (Android 7.0)**: `minSdkVersion 24`, con Hermes y la nueva arquitectura (vienen por defecto) |
| HTTP | `axios`, el mismo que usa el front |
| Fechas | `dayjs` con el plugin `customParseFormat` |
| Token | `expo-secure-store` |
| Otros datos persistentes | `@react-native-async-storage/async-storage` (con zustand `persist` + `createJSONStorage`) |
| Red | `@react-native-community/netinfo` |
| Fecha (selector) | `@react-native-community/datetimepicker` |
| Archivos | `expo-file-system` (descarga) + `expo-sharing` (compartir/abrir) |
| Listas | `FlatList`: SCOP y guías pueden ser decenas |

- **HTTP en pruebas.** Android 9 o superior bloquea el tráfico sin cifrar. Hay que activar `usesCleartextTraffic: true` con el plugin `expo-build-properties`, **solo en el perfil de pruebas**. En producción la app va por HTTPS.
- **APK.** `eas build -p android --profile preview` (o un build local) y generar el APK para `armeabi-v7a` y `arm64-v8a`, para cubrir equipos de 32 bits.
- **Variable de entorno:** `EXPO_PUBLIC_API_URL=http://<host>`, sin `/api` al final. Todas las rutas de este documento empiezan con `/api/...`.

---

## 2. Reglas generales HTTP

Cabeceras en **todas** las peticiones:

```
Accept: application/json          ← obligatoria
Content-Type: application/json
Authorization: Bearer <token>     ← todas menos el login
```

- **Sin `Accept: application/json`, un token vencido no da 401 sino 500.** Laravel intenta redirigir a una ruta `login` que no existe.
- **Errores.**
  - Validación: **422** `{ "message": "...", "errors": { "campo": ["mensaje"] } }`.
  - Errores propios: `{ "exito": false, "error": "...", "message": "..." }`.
  - En la app, mostrar `message` o `error` y, si existen, los textos de `errors`.
- **401/419 = sesión vencida**: borrar el token y volver al login. **Excepción: `/api/scop/*`.** Ahí un 401/403/502 viene del servicio SCOP externo, no de la sesión, así que **no** se cierra la sesión.
- **Reintentos.** Solo en GET, hasta 3 veces (esperas de 1 s, 2 s y 4 s), cuando no hay respuesta o llega 429/502/503/504. En 429 se respeta `Retry-After`. **POST y PUT nunca se reintentan**, porque se podría duplicar una guía.
- **No enviar filtros vacíos.** `?placa=` no significa "sin filtro": el backend lo convierte en `null` y busca registros con esa columna en null. Si un filtro no tiene valor, no se envía.
- **Token.** Dura **12 h** (`sanctum.expiration = 720`). Es el token "web" (`*`). El token de la app PVO (`/api/movil/login`, ability `movil`) **no** sirve para estas rutas: da 403.
- **Límite.** 60 peticiones por minuto por usuario (`throttle:api`).

---

## 3. Login y sesión

### `POST /api/login` (sin token)

```json
{ "documento": "44556677", "password": "secreto", "id_empresa": 1 }
```

`id_empresa` es parte de la credencial: debe coincidir con la empresa del usuario. En una instalación hay una sola empresa, así que se configura fijo en la app.

| Caso | HTTP | Cuerpo |
|---|---|---|
| Correcto | 200 | `{ "token": "12\|abc...", "user": { ... } }` |
| Documento o clave incorrectos | 422 | `{ "errors": ["El documento o el password son incorrectos"] }` ← `errors` es **array** |
| Documento no registrado o campos faltantes | 422 | `{ "message", "errors": { "documento": ["El documento no está registrado"] } }` |
| Usuario no aprobado | **200** | `{ "token": "", "user": {...}, "error": "Tu cuenta aún no ha sido aprobada..." }` |

**Regla:** solo hay sesión si `token` no está vacío **y** existe `user`. Si no, se muestra `error` o `errors`.

Campos de `user` que se usan:

| Campo | Para qué |
|---|---|
| `id` | `GET /api/usuario/{id}` (puntos de emisión) |
| `name` | Mostrar |
| `documento` | Buscar al chofer principal (el usuario es el chofer) |
| `perfil` | `"admin"` habilita **reenviar** y **dar de baja**, y ve las guías de todos |

### `POST /api/logout`
No lleva body y responde `{ "user": null }`. Después hay que borrar el token y los datos guardados.

---

## 4. Guía rápida: carga inicial

Las llamadas se hacen **en este orden** y la pantalla muestra el avance paso a paso. Si una falla, se muestra el error con un botón para reintentar ese paso.

### 4.1 Emisión
1. **`GET /api/usuario/{user.id}`**: devuelve un array plano (sin `data`) de puntos de emisión `{ id, codigo, nombre, codLocal, direccion, ruc }`. Se usa **el primero**; si hay varios, se puede elegir.
2. **`GET /api/numeracion/actualbypunto?id_puntoemision={id}`**: devuelve `{ data: [ ... ] }`. Se toma la **primera** serie.

```json
{
  "id": 3, "nombre": "...", "serie": "T001", "numeroActual": 125,
  "primario":   { "id": 8, "placa": "ABC-123", "nroCirculacion": "...", "codEmisor": "...", "nroAutorizacion": "...", "glp": false, "tracto": true, "nombreCorto": "..." },
  "secundario": [ { "id": 9, "placa": "AKA-983", "nroCirculacion": "...", "codEmisor": "...", "nroAutorizacion": "...", "glp": true } ],
  "id_puntoemision": 2
}
```

- **Correlativo a usar = `numeroActual + 1`**, como string. El cliente es quien lo envía.
- `primario` es el tracto. `secundario[]` son las cisternas. **La cisterna decide el tipo de SCOP:** si `glp` es `true` es GLP, si no, líquidos.

### 4.2 Chofer
**`GET /api/conductor/buscar?nroDoc={user.documento}`**: devuelve `{ data: [ ... ] }` y se toma el primero.

```json
{ "id": 3, "tipoDoc": "1", "nroDoc": "44556677", "nombres": "...", "apellidos": "...", "licencia": "Q44556677" }
```

### 4.3 Personas
**`GET /api/clientes?fav=1`**: devuelve `{ data: [ { id, numDoc, rznSocial, tipoDoc, isCompany, nombreCorto, ... } ] }`.
- **Destinatario** = el primer cliente con `isCompany` verdadero (la propia empresa).
- Esta lista también sirve de catálogo para elegir el **proveedor** (`tercero`).

### 4.4 Llegada
1. RUC de la empresa: **`GET /api/sunat/parametros`**. De `data.ruc` **solo se usa `ruc`**; el resto de campos es sensible y no se guarda.
2. **`GET /api/puntos?ruc={ruc}`**, una llamada por RUC (empresa y destinatario). Devuelve `{ data: [ { id, ubigeo, direccion, codLocal, ruc, rznSocial, nombreCorto, isCompany } ] }`. Se filtra por RUC exacto.
3. La llegada **no** se preselecciona: la elige el usuario.

### 4.5 Productos
**`GET /api/productos`**: devuelve `{ data: [ { id, codigo, descripcion, unidad, codProdSunat, ... } ] }`.
- Se buscan los códigos de la tabla de la sección 6.1: `0001`, `0002`, `0003`, `0004` y `0044`. Al comparar, `"0003"` y `"3"` son el mismo código.
- Si falta alguno, se pide con `GET /api/productos?codigo={cod}`. Si tampoco existe, la guía usa los datos de la tabla con `id = 0` y la pantalla muestra un aviso.

### 4.6 Valores fijos al iniciar

| Campo | Valor |
|---|---|
| Motivo (`codTraslado` / `desTraslado`) | `"02"` / `"Compra"` (se puede cambiar) |
| Modalidad (`modTraslado`) | `"02"` = transporte privado |
| `fecTraslado` y fecha de emisión | hoy (`YYYY-MM-DD`) |
| `indicadores` | `[]` |
| `numBultos` | `0` |
| `pesoTotal` | se calcula (sección 7.3) |

### 4.7 Llamadas bajo demanda

| Cuándo | Llamada |
|---|---|
| Abrir el selector de tracto o cisterna | `GET /api/vehiculos` → `{ id, placa, nroCirculacion, codEmisor, nroAutorizacion, glp, tracto, nombreCorto }` |
| Abrir el selector de chofer | `GET /api/conductor` |
| Cambiar el punto de emisión | `GET /api/numeracion/actualbypunto?id_puntoemision=` |
| Elegir un proveedor | `GET /api/puntos?ruc={proveedor.numDoc}`: puntos de **partida**; se elige el primero automáticamente |
| La primera vez que hay SCOP disponibles | `GET /api/clientes` (todos, una sola vez) para emparejar al vendedor (sección 5.6) |

---

## 5. SCOP: consulta al portal

### 5.1 Parámetros

| Dato | Regla |
|---|---|
| `placaScop` | La placa de la **cisterna** (vehículo secundario) elegida, o la primera si no eligió ninguna. **Nunca** la del tracto |
| `tipo` | `"glp"` si la cisterna tiene `glp = true`; si no, `"liquido"`. Sin cisterna no hay consulta |
| `sucursal` | **GLP**: la placa de la cisterna (`"AKA-983"`). **Líquidos**: el `id` del punto de **llegada**, como string (`"15"`) |
| Rango | Por defecto, de hoy − 6 días a hoy. **Máximo 7 días contando ambos extremos** (límite del portal). Si el usuario cambia una fecha y el rango pasa de 7 días, se mueve la otra |

**Cuándo se consulta:**
- **GLP**: automáticamente al tener la cisterna.
- **Líquidos**: cuando ya hay llegada **y** el usuario pulsa "Consultar".
- **Refrescar**: igual que una consulta normal, pero con `refrescar: true`, que ignora la caché del backend. Se conservan los SCOP ya marcados que sigan disponibles.
- Si cambia la placa, el tipo, la llegada o las fechas, se **cancela** la consulta en curso (`AbortController`) y se descartan los marcados.

**Validar antes de llamar** (si falla, se muestra el mensaje y no se llama):
- falta `sucursal` → "Falta la sucursal: elige el punto de llegada.";
- fechas inválidas;
- `fecha_fin` anterior a `fecha_inicio`;
- rango de más de 7 días.

### 5.2 `POST /api/scop/consulta`

```json
{
  "sucursal": "AKA-983",
  "fecha_inicio": "2026-11-11",
  "fecha_fin": "2026-11-17",
  "para_liquido": false,
  "para_glp": true,
  "refrescar": true
}
```

- `refrescar` es opcional. `placa` también existe, pero la guía rápida **no** la envía: filtra por placa en la app (sección 5.4).
- **Timeout de la petición: 90 s.** El portal tarda entre 10 y 18 s, y si otra consulta igual está en curso el backend espera hasta 70 s.

**Respuesta correcta (200):**

```json
{
  "success": true,
  "desde_cache": false,
  "data": {
    "sucursal": "AKA-983",
    "fecha_inicio": "2026-11-11",
    "fecha_fin": "2026-11-17",
    "glp":     { "ok": true, "total": 20, "coincidencias": 20, "registros": [ { ... } ] },
    "liquido": { "ok": true, "total": 13, "coincidencias": 13, "registros": [ { ... } ] }
  }
}
```

- `glp` y `liquido` llegan **solo si se pidieron**.
- `desde_cache` puede llegar como `true`, `1`, `"1"` o `"true"`. Si es verdadero, se muestra "datos en caché" con un botón para refrescar.

**Errores. Todos se muestran como texto y ninguno cierra sesión:**

| Caso | Cómo llega | Mensaje sugerido |
|---|---|---|
| Fallo del servicio | `{ "success": false, "message": "..." }` con HTTP 4xx/5xx | `message` |
| Error dentro de un 200 | `data.error`, o `success: false` | el texto |
| Un bloque pedido falló | `data.glp.ok === false` (o `liquido`) | `error` o `mensaje` del bloque, o "El portal no devolvió los pedidos de GLP." |
| 401/403/502 | clave del servicio SCOP rechazada o portal caído | "El servicio SCOP o el portal fallaron. Intenta de nuevo en unos minutos." |
| 503 | consulta igual en curso | "Ya hay una consulta igual en curso. Espera y vuelve a consultar." |
| 504 o timeout | el portal no respondió | "El SCOP tardó demasiado en responder. Intenta de nuevo." |

### 5.3 Ejemplo de registros (tal como llegan)

Las claves traen espacios, acentos y símbolos, y **varían entre líquidos y GLP**.

**Líquidos:**

```json
{
  "Código Autorización": "12760092030",
  "Factura": "F021-00044763",
  "Producto": "Diesel B5 S-50 UV",
  "Volumen": "2,940",
  "Placa": "V0B-999",
  "Estado Det. Pedido": "DESPACHADA",
  "Fecha Pedido": "15/09/2026 10:25:48",
  "Fecha Despacho": "15/09/2026 12:44:53",
  "Pta. Abastecimiento": "PETRÓLEOS DEL PERÚ - PETROPERÚ S.A.",
  "Prov. Producto": "REFINERIA LA PAMPILLA S.A."
}
```

**GLP:**

```json
{
  "Código Autorización": "61727822016",
  "Vendedor Razón Social": "ESTACIÓN DE ENERGIAS EL CENTENARIO S.A.C.",
  "N° Factura": "",
  "N° Guia": "TX04-470",
  "Fecha Pedido": "09/09/2026 13:30:07",
  "Producto": "GLP - G",
  "Volumen": "3801.3",
  "Unidad Medida": "Galones",
  "Placa": "AKA-983",
  "Est. Det. Pedido": "CERRADO"
}
```

### 5.4 Conversión a pedido

**Las claves se comparan normalizadas**, para que `"N° Factura"`, `"Nº Factura"` y `"N Factura"` sean la misma:

```ts
const normalizarClave = (t: string) =>
  t.normalize("NFD").replace(/[̀-ͯ]/g, "").toLowerCase().replace(/[^a-z0-9]/g, "");

const leerCampo = (r: Record<string, string>, ...nombres: string[]) => {
  const buscadas = nombres.map(normalizarClave);
  const clave = Object.keys(r).find((k) => buscadas.includes(normalizarClave(k)));
  return clave ? String(r[clave] ?? "").trim() : "";
};
```

| Campo del pedido | Columna(s) | Regla |
|---|---|---|
| `tipo` | bloque | `"liquido"` o `"glp"` |
| `codigoAutorizacion` | `Código Autorización` | **Si viene vacío, el registro se descarta** |
| `factura` | líquidos: `Factura`; GLP: `N° Factura` | En mayúsculas. `"-"` o vacío = sin factura (`""`) |
| `estado` | `Estado Det. Pedido` / `Est. Det. Pedido` | |
| `disponible` | estado | `false` si cumple `/^(CERRAD\|ANULAD)[AO]\b/i` |
| `fechaPedido` | `Fecha Pedido` | Formato estricto `DD/MM/YYYY HH:mm:ss`. Sirve para ordenar |
| `producto` | `Producto` | |
| `volumen` | `Volumen` | Ver `parseVolumen` |
| `unidad` | `Unidad Medida` / `Unidad de Medida` / `Unidad` | El bloque de líquidos no la trae: queda `""` |
| `vendedor` | `Vendedor Razón Social` | GLP |
| `provProducto` | `Prov. Producto` / `Prov Producto` / `Proveedor Producto` | Líquidos |
| `placa` | `Placa` | Normalizada: `"abc123"` → `"ABC-123"` |

```ts
/** Líquidos usan coma de miles ("2,940"); GLP, punto decimal ("3801.3"). Si vienen ambos, el último es el decimal. */
export const parseVolumen = (valor: unknown): number => {
  if (typeof valor === "number") return Number.isFinite(valor) ? valor : 0;
  let texto = String(valor ?? "").replace(/\s/g, "");
  if (!texto) return 0;
  const coma = texto.includes(","), punto = texto.includes(".");
  if (coma && punto) {
    texto = texto.lastIndexOf(",") > texto.lastIndexOf(".")
      ? texto.replace(/\./g, "").replace(",", ".")
      : texto.replace(/,/g, "");
  } else if (coma) {
    texto = /^\d{1,3}(,\d{3})+$/.test(texto) ? texto.replace(/,/g, "") : texto.replace(",", ".");
  }
  const n = parseFloat(texto);
  return Number.isFinite(n) ? n : 0;
};

export const normalizarPlaca = (placa?: string | null) => {
  const limpia = (placa || "").toUpperCase().replace(/[^A-Z0-9]/g, "");
  return limpia.length <= 3 ? limpia : `${limpia.slice(0, 3)}-${limpia.slice(3)}`;
};
```

Después de convertir:
1. **Ordenar** del pedido más reciente al más antiguo, por `Fecha Pedido`.
2. **Filtrar por placa** comparando solo letras y números: `"AKA-983"` = `"AKA983"`. Se **conservan** los pedidos que no traen placa.

### 5.5 Qué SCOP salen deshabilitados

Se muestran todos, pero solo se pueden marcar los que pasan **todas** estas reglas. El motivo se muestra en la fila.

| Regla | Detalle |
|---|---|
| Estado | `CERRADO`/`CERRADA`/`ANULADO`/`ANULADA` → no disponible |
| Producto conocido | Debe estar en la tabla de la sección 6.1 (`GLP - G`, `Diesel B5 S-50 UV`, `GASOHOL PREMIUM`, `GASOHOL REGULAR`). Se compara sin importar mayúsculas, acentos ni espacios repetidos |
| Unidad según el motivo | Ver `unidadCompatible`. Con motivo **02 Compra** el GLP va en **kilos** (producto 0004). Con cualquier otro motivo va en **galones** (0044). Si el SCOP **no trae unidad**, se acepta |
| Usado en otra guía | `GET /api/scop/disponible` (abajo) |
| Hay proveedor | Sin proveedor elegido no se puede marcar ningún SCOP: el RUC del proveedor es el emisor de sus documentos |

Si el usuario **cambia el motivo**, se quitan de la selección los SCOP cuya unidad ya no corresponde, con el aviso: "Se quitó X: con este motivo el producto no se registra en esa unidad".

#### `GET /api/scop/disponible?nroScop[]=A&nroScop[]=B[&id_despatch=N]`
Se llama cada vez que cambia la lista de números visibles. Se envían números únicos. `id_despatch` solo se usa al editar una guía, para que sus propios números no salgan ocupados.

```json
{ "exito": true, "disponible": false,
  "scops": [ { "nroScop": "A", "disponible": true,  "id_despatch": null, "guia": null },
             { "nroScop": "B", "disponible": false, "id_despatch": 812, "guia": "T001-125" } ] }
```

- Los que tienen `disponible: false` se muestran deshabilitados con "usado en T001-125" y se quitan si ya estaban marcados.
- **Si esta llamada falla, no se bloquea la pantalla.** Al guardar, el backend vuelve a validar (sección 8).

### 5.6 Proveedor automático (a partir del vendedor)

- **Nombre del vendedor**: en GLP es `vendedor`; en líquidos, `provProducto`.
- Los pedidos se agrupan por ese nombre y se muestran como **chips**, con cuántos pedidos hay de cada uno.
- **Cliente que le corresponde:**
  - **GLP**: el cliente cuya `rznSocial` sea **más parecida** al nombre del vendedor (`masParecido`, mínimo 0.6). Se busca en el catálogo completo de `GET /api/clientes`, o en los favoritos si aún no se cargó.
  - **Líquidos**: si `provProducto` contiene `PAMPILLA` (sin importar mayúsculas), es el **cliente con id 17** (Repsol Comercial). En cualquier otro caso no hay cliente automático.
- **Cuándo se elige solo:**
  - Si hay un solo vendedor, su chip queda seleccionado.
  - Si **todavía no hay proveedor** y el vendedor tiene cliente, ese cliente pasa a ser el proveedor.
  - **Nunca** reemplaza un proveedor que ya eligió el usuario.
- **Al elegir el proveedor:**
  - Pasa a ser el `tercero` de la guía.
  - Se cargan sus puntos de **partida** (`GET /api/puntos?ruc=`) y se elige el primero.
- **Si el usuario cambia de proveedor** después de marcar SCOP, los documentos ya generados **conservan el RUC anterior**. Se muestra un aviso: "quítalos y vuelve a elegirlos".

Código de referencia, que se puede copiar tal cual:

```ts
// utils/similitud.ts — "SOLGAS S.A." y "SOLGAS SA" son la misma empresa
const SUFIJOS = ["SOCIEDAD ANONIMA CERRADA", "SOCIEDAD ANONIMA",
  "SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA", "EMPRESA INDIVIDUAL DE RESPONSABILIDAD LIMITADA",
  "SAC", "SA", "SRL", "SCRL", "EIRL", "SAA"];

export const normalizarRazonSocial = (texto: string): string => {
  let limpio = (texto || "").normalize("NFD").replace(/[̀-ͯ]/g, "")
    .toUpperCase().replace(/[^A-Z0-9]+/g, " ").trim();
  let cambio = true;
  while (cambio) {
    cambio = false;
    for (const s of SUFIJOS) if (limpio.endsWith(` ${s}`)) { limpio = limpio.slice(0, -s.length - 1).trim(); cambio = true; }
  }
  return limpio.replace(/\s+/g, " ");
};

const bigramas = (t: string) => { const p: string[] = []; for (let i = 0; i < t.length - 1; i++) p.push(t.slice(i, i + 2)); return p; };

/** Coeficiente de Dice sobre pares de letras; si uno contiene al otro, mínimo 0.9. */
export const similitudRazonSocial = (a: string, b: string): number => {
  const x = normalizarRazonSocial(a), y = normalizarRazonSocial(b);
  if (!x || !y) return 0;
  if (x === y) return 1;
  const px = bigramas(x), py = [...bigramas(y)];
  if (!px.length || !py.length) return 0;
  const total = px.length + py.length;
  let comunes = 0;
  px.forEach((par) => { const i = py.indexOf(par); if (i >= 0) { comunes++; py.splice(i, 1); } });
  const dice = (2 * comunes) / total;
  return x.includes(y) || y.includes(x) ? Math.max(dice, 0.9) : dice;
};

export const masParecido = <T,>(texto: string, lista: T[], nombreDe: (i: T) => string, minimo = 0.6) => {
  let mejor: { item: T; puntaje: number } | null = null;
  lista.forEach((item) => {
    const puntaje = similitudRazonSocial(texto, nombreDe(item));
    if (!mejor || puntaje > mejor.puntaje) mejor = { item, puntaje };
  });
  return mejor && (mejor as { puntaje: number }).puntaje >= minimo ? mejor : null;
};
```

---

## 6. Productos del SCOP

### 6.1 Tabla

| Nombre en el SCOP | Código | Descripción | Unidad | Kg por unidad |
|---|---|---|---|---|
| `Diesel B5 S-50 UV` | `0003` | DIESEL B5 S-50 UV | GLL | 1.9391 |
| `GASOHOL PREMIUM` | `0002` | GASOHOL PREMIUM | GLL | 1.9391 |
| `GASOHOL REGULAR` | `0001` | GASOHOL REGULAR | GLL | 1.9391 |
| `GLP - G` | `0004` | GLP GRANEL | **KGM** | 1 |
| `GLP - G` | `0044` | GLP GRANEL | **GLL** | 1.9391 |

El GLP aparece dos veces, y **el motivo decide cuál se usa**: `02` (Compra) → `0004` en kilos; cualquier otro motivo → `0044` en galones.

```ts
export const unidadPorMotivo = (motivo?: string) => (motivo === "02" ? "KGM" : "GLL");

export const productoScopDe = (nombreScop: string, motivo?: string) => {
  const n = (t: string) => t.normalize("NFD").replace(/[̀-ͯ]/g, "").toUpperCase().replace(/\s+/g, " ").trim();
  const c = PRODUCTOS_SCOP.filter((p) => p.nombresScop.some((x) => n(x) === n(nombreScop)));
  if (c.length <= 1) return c[0];
  return c.find((p) => p.unidad === unidadPorMotivo(motivo)) || c[0];
};

/** "Galones"/"GLL" → "gal", "Kilogramos"/"KG"/"KGM" → "kg", "Litros"/"LTR"/"L" → "L". */
export const abreviarUnidad = (u: string) => {
  const t = (u || "").normalize("NFD").replace(/[̀-ͯ]/g, "").toLowerCase().trim();
  if (!t) return "";
  if (/^gal/.test(t) || t === "gll") return "gal";
  if (/^kil/.test(t) || t === "kg" || t === "kgm") return "kg";
  if (/^lit/.test(t) || t === "ltr" || t === "l") return "L";
  return u.trim();
};

/** Si el SCOP no informa unidad (líquidos), se acepta. */
export const unidadCompatible = (p: { unidad?: string; producto: string }, motivo?: string) => {
  const prod = productoScopDe(p.producto, motivo);
  if (!prod || !p.unidad?.trim()) return true;
  return abreviarUnidad(p.unidad) === abreviarUnidad(prod.unidad);
};
```

---

## 7. De SCOP marcados a datos de la guía

### 7.1 Bienes (`details`)
Por cada SCOP marcado se toma `productoScopDe(producto, motivo)` y se busca ese código en el catálogo de la sección 4.5. Los volúmenes se **agrupan por código** y se suman, con redondeo a 4 decimales. Los bienes que el usuario agregue a mano se suman al mismo código.

```json
{ "id": 21, "codigo": "0044", "descripcion": "GLP GRANEL", "unidad": "GLL", "codProdSunat": "15111510", "cantidad": 7602.6, "atributos": null }
```

- `id`, `descripcion`, `unidad` y `codProdSunat` salen del catálogo. Si el producto no está en el catálogo, se usan los de la tabla y `id: 0`; el backend lo guarda como producto 1, "no catalogado".
- `codigo` y `descripcion` van en mayúsculas.

### 7.2 Documentos relacionados (`addDocs`)
Por cada SCOP marcado:

```json
{ "tipo": "81", "tipoDesc": "CODIGO DE AUTORIZACION EMITIDA POR EL SCOP", "nro": "61727822016", "emisor": "20100176450" }
```

Si además tiene factura:

```json
{ "tipo": "01", "tipoDesc": "FACTURA", "nro": "F021-00044763", "emisor": "20100176450" }
```

- `emisor` es el **RUC del proveedor en el momento en que se marcó el SCOP**: queda fijado.
- No se repite el par `emisor|nro`. Los documentos sin emisor no se envían.
- Documentos manuales: se validan como factura `^[FBE][A-Z0-9]{3}-\d+$` y SCOP `^\d+$`.

### 7.3 Peso (`envio.pesoTotal`, en KGM)
- Los bienes en kilos suman su cantidad tal cual.
- Los demás bienes suman `cantidad × kg por unidad` (1.9391).
- El resultado se redondea a entero (`Math.round`).
- El usuario puede sobrescribir el peso a mano. Si lo hace, se muestra "calculado: N kg".

### 7.4 `scops`
Son los números `nro` de los `addDocs` con `tipo: "81"`, sin repetir.

---

## 8. Guardar y enviar

### 8.1 Payload: `POST /api/despatches` (nueva) o `PUT /api/despatches/{id}` (editar)

```json
{
  "version": "2.0",
  "tipoDoc": "09",
  "serie": "T001",
  "correlativo": "126",
  "fechaEmision": "2026-11-17 10:30",
  "observacion": "",
  "destinatario": { "id": 5, "tipoDoc": "6", "numDoc": "20601234567", "rznSocial": "MI EMPRESA S.A.C." },
  "tercero":      { "id": 7, "tipoDoc": "6", "numDoc": "20100176450", "rznSocial": "PROVEEDOR S.A." },
  "comprador": null,
  "envio": {
    "codTraslado": "02",
    "desTraslado": "Compra",
    "modTraslado": "02",
    "fecTraslado": "2026-11-17",
    "fecInicioTrasladoBienes": null,
    "indicadores": [],
    "indTransbordo": false,
    "pesoTotal": 14742,
    "undPesoTotal": "KGM",
    "numBultos": 0,
    "partida": { "id": 40, "ubigeo": "150101", "direccion": "...", "codLocal": "0001", "ruc": "20100176450", "rznSocial": "..." },
    "llegada": { "id": 15, "ubigeo": "040101", "direccion": "...", "codLocal": "0002", "ruc": "20601234567", "rznSocial": "..." },
    "vehiculo": {
      "id": 8, "placa": "ABC-123", "nroCirculacion": "...", "codEmisor": "...", "nroAutorizacion": "...",
      "secundarios": [ { "id": 9, "placa": "AKA-983", "nroCirculacion": "...", "codEmisor": "...", "nroAutorizacion": "..." } ]
    },
    "aeropuerto": null,
    "puerto": null,
    "choferes": [ { "id": 3, "tipo": "Principal", "tipoDoc": "1", "nroDoc": "44556677", "nombres": "...", "apellidos": "...", "licencia": "Q44556677" } ],
    "transportista": null
  },
  "addDocs": [ { "tipo": "81", "tipoDesc": "CODIGO DE AUTORIZACION EMITIDA POR EL SCOP", "nro": "61727822016", "emisor": "20100176450" } ],
  "details": [ { "id": 21, "codigo": "0044", "descripcion": "GLP GRANEL", "unidad": "GLL", "codProdSunat": "15111510", "cantidad": 7602.6, "atributos": null } ],
  "scops": ["61727822016"]
}
```

**Reglas que hay que respetar:**
- **Siempre enviar** las claves `envio.partida`, `envio.llegada`, `envio.vehiculo` y `envio.transportista`, aunque valgan `null`. Si falta una, el backend responde 500.
- `codTraslado` y `modTraslado` deben existir en el catálogo: `"01"`/`"02"`… y `"01"` público / `"02"` privado.
- En modalidad **privada** (`"02"`): `fecInicioTrasladoBienes: null` y `transportista: null`. En **pública** (`"01"`) sin choferes: `fecInicioTrasladoBienes = fecTraslado`.
- Los puntos se identifican por `id`. El backend también acepta `id_puntoubicacion`.
- `tercero` = proveedor; `null` si no hay.
- **Al editar (PUT) hay que mandar la guía completa**: el backend reemplaza detalles, documentos, puntos, vehículos y choferes.
- Bloquear el botón mientras se guarda, para evitar el doble toque.

### 8.2 Respuestas

**Correcta (200):**

```json
{
  "exito": true,
  "message": "Guia electrónica con id 900 insertada con éxito",
  "despatch": { "id": 812, "serie": "T001", "correlativo": "126", "fechaEmision": "...", "...": "..." },
  "electronico": 812
}
```

- El id de la guía es **`despatch.id`**. El número del `message` es otro id: no se usa.
- Con un POST correcto, el backend actualiza `numeroActual`. La app vuelve a pedir `actualbypunto` para tener el siguiente correlativo.

**Errores:**

| Caso | HTTP | Cuerpo | Qué hacer |
|---|---|---|---|
| Serie + correlativo ya existe | **422** (o 409 si dos guardan a la vez) | `errors.correlativo: ["Ya existe un despacho con esta serie y correlativo."]` / 409: `{ error, message, despatch }` | Volver a pedir `actualbypunto`, poner `numeroActual + 1` y avisar |
| SCOP ya usado | **422** (o 409) | `errors["scops.0"]: ["El número de SCOP X ya está usado en otra guía."]` / 409: `{ error, message, scops: [ { nroScop, guia } ] }` | Mostrar "X en la guía T001-5" y quitarlo de la selección |
| Editar una guía enviada o en proceso | 409 | `{ error: "La guía ya fue enviada a SUNAT y no se puede modificar." }` | Solo mostrar el mensaje |
| Guía inexistente (PUT) | 404 | `{ error }` | |
| Error interno | 500 | `{ error, message, exito: false }` | Mostrar `message` |

### 8.3 Enviar a SUNAT

"Guardar y enviar" se hace en **dos pasos**, como el front:
1. Guardar (8.1).
2. Con el id que devolvió, **`POST /api/despatches/{id}/enviar`**, sin body.

> Alternativa: mandar `"enviar": true` en el mismo POST/PUT. El resultado llega en `envio` con el formato de abajo, y el HTTP es **200 aunque el envío falle**: hay que mirar `envio.exito`. La guía queda guardada igual.

Respuesta de `enviar` y de `consultar` (mismo formato; también en los errores):

```json
{
  "exito": true,
  "message": "...",
  "errors": [],
  "electronico": {
    "id": 812, "estado": "P", "estadoSunat": "PENDIENTE", "codigoSunat": null, "descripcion": "...",
    "feId": 5531, "feEstado": "pendingTicket", "feQrUrl": null, "ticket": "..."
  }
}
```

**Seguimiento:** mientras `feEstado` sea `registered`, `sending` o `pendingTicket`, llamar a **`POST /api/despatches/{id}/consultar`** cada **3 s**, como **máximo 5 veces**. Además, poner un botón "Consultar ahora".

| `feEstado` | Pantalla |
|---|---|
| `accepted` / `observed` | **Aceptada**: botones PDF, XML, CDR y QR |
| `registered` / `sending` / `pendingTicket` | Esperando a SUNAT. El resultado final también llega al backend por webhook, así que se puede cerrar y revisar en la consulta |
| `rejected` | **Rechazada**: mostrar `codigoSunat` + `descripcion`. Se corrige (PUT) y se reenvía **con el mismo número** |
| `error` / otro | Fallo: mostrar `message` |

| HTTP de `enviar` | Significado |
|---|---|
| 409 | Ya aceptada o dada de baja. Si no trae `electronico`, llamar a `consultar` para mostrar el estado real |
| 422 | Datos inválidos para la API de facturación: listar `errors` |
| 502 / 503 | La API de facturación no responde o no está configurada |

---

## 9. Consulta de guías

### 9.1 Lista: `GET /api/estadoelectronico/buscar`

| Parámetro | Detalle |
|---|---|
| `fecha_inicio`, `fecha_fin` | `YYYY-MM-DD`. Por defecto, el mes actual. Se envían **los dos** o ninguno |
| `serie` | De `GET /api/numeracion/userid` → `[ { "serie": "T001" } ]` |
| `numero` | Correlativo |
| `estado` | `P` pendiente, `F` final, `B` baja |
| `page`, `per_page` | `page` empieza en 1; `per_page` por defecto 10 |

Recordatorio: los parámetros sin valor no se envían.

```json
{
  "success": true,
  "pagination": { "current_page": 1, "per_page": 10, "total": 57, "last_page": 6, "from": 1, "to": 10 },
  "data": [ {
    "id": 812, "id_despatch": 812, "serie": "T001", "numero": "126", "fecha": "2026-11-17",
    "estado": "F", "estadoSunat": "ACEPTADO", "codigoSunat": "0", "descripcion": "La Guia ... ha sido aceptada",
    "feId": 5531, "feEstado": "accepted", "feQrUrl": "https://...", "fePdfSunat": true,
    "ticket": "...", "hashQr": "...", "name": "Juan Pérez", "id_user": 4
  } ]
}
```

- Se ordena de la guía más nueva a la más antigua. Un usuario que no es admin solo ve **sus** guías.
- Para scroll infinito con `FlatList`: pedir `page + 1` mientras `current_page < last_page`.
- **Chip de estado:**
  - `F` → color según `estadoSunat` (ACEPTADO, OBSERVADO);
  - `P` → pendiente (o `feEstado` en proceso / `rejected`);
  - `B` → de baja.
- La lista **no** trae el cliente ni el destinatario.

### 9.2 Acciones por guía

| Acción | Quién y cuándo | Llamada |
|---|---|---|
| **Consultar estado** | Todos. Deshabilitada si `estado` es `F` o `B`, o si no tiene `feId` | `POST /api/despatches/{id_despatch}/consultar`. Luego se recarga la fila o la lista |
| **Reenviar** | Solo `perfil = admin`. No disponible si `F`, `B` o en proceso | `POST /api/despatches/{id_despatch}/enviar` y el seguimiento de 8.3 |
| **Editar** | No disponible si `F`, `B` o en proceso | `GET /api/despatches/{id_despatch}` → `{ data: {...} }` (403 si F/B). Guardar con `PUT` (8.1) |
| **Ver detalle** (incluidas las aceptadas) | Todos | `GET /api/despatches/pdf/{id_despatch}` → `{ data: {...} }` (JSON; no bloquea por estado) |
| **Dar de baja** | Solo admin, solo si `estado = F` | `PUT /api/despatches/baja/{id_despatch}`, sin body → `{ exito, message, scopsLiberados: [...] }`. **Solo la marca en guiasapi y libera sus SCOP; no comunica nada a SUNAT.** Pedir confirmación |
| **QR** | Si hay `feQrUrl` | Abrir o mostrar la URL |

Ojo: el detalle (`show`/`pdf`) devuelve `envio.vehiculo` como **array** (`[{..., tipo: "P"}, {..., tipo: "S"}]`), pero el payload de guardado espera `{ ..., secundarios: [] }`. Al editar hay que convertirlo.

### 9.3 Archivos: `GET /api/despatches/{id_despatch}/archivo`

| Query | Archivo |
|---|---|
| `?tipo=pdf&formato=a4` | PDF propio (A4) |
| `?tipo=pdf&formato=sunat` | PDF de SUNAT |
| `?tipo=xml` | XML firmado |
| `?tipo=cdr` | CDR (`.zip`) |
| `&descargar=1` | Cabecera `attachment` en vez de `inline` |

- **Devuelve el archivo binario**, no base64. El nombre viene en `Content-Disposition`; por ejemplo, `T001-126.pdf` o `SUNAT-T001-126.pdf`.
- En React Native:

```ts
import * as FileSystem from "expo-file-system";
import * as Sharing from "expo-sharing";

const destino = FileSystem.cacheDirectory + `guia-${id}.pdf`;
const r = await FileSystem.downloadAsync(
  `${API}/api/despatches/${id}/archivo?tipo=pdf&formato=a4`,
  destino,
  { headers: { Authorization: `Bearer ${token}`, Accept: "application/json" } },
);
if (r.status !== 200) {
  // el cuerpo es JSON con { error }: leerlo con FileSystem.readAsStringAsync(destino)
} else {
  await Sharing.shareAsync(r.uri, { mimeType: "application/pdf" });   // o abrir con el visor del sistema
}
```

- Timeout recomendado: 60 s, sin reintentos.

| Error (JSON) | HTTP |
|---|---|
| La guía no se envió por la API de facturación | 409 |
| Archivo aún no disponible / SUNAT no responde | 404 / 503 (puede traer `Retry-After` y `urlQr`) |
| Fallo de conexión | 502 |

### 9.4 Fuera de alcance de la app
Reporte Excel (`/api/despatches/buscar`), descargas masivas en ZIP (`/api/estadoelectronico/descargar`), notas y todo el flujo antiguo de firma (`/api/estadoelectronico/{id}` con PUT, `/api/tokensunat`, servicios `GeneraXml`/`FirmarXml`).

---

## 10. Notas del backend (comportamiento actual)

Estos puntos se observaron en el código y **no** se han corregido. Afectan a la app:

1. El índice único serie + correlativo está desactivado en la base. Los duplicados se frenan con la validación y un bloqueo en `store`.
2. `GET /api/numeracion/actualbypunto` puede dar **500** si una numeración no tiene vehículo principal asignado.
3. `GET /api/despatches/{id}` y `/pdf/{id}` podrían dar 500 en guías sin `tercero`, `comprador` o `transportista`. No está verificado; hay que probarlo con guías reales.
4. La lista de la consulta no trae el cliente ni el destinatario. Si la app los necesita, hace falta un cambio en el backend.
5. `GET /api/usuario/{id}` no comprueba que `{id}` sea el usuario de la sesión: la app debe enviar su propio `user.id`.
6. La baja no valida ni el dueño ni el estado en el backend. La app aplica la regla (solo admin, solo `F`).

---

## 11. Checklist de aceptación

- [ ] Login correcto, usuario no aprobado (200 con `error`) y clave incorrecta (422 con array).
- [ ] Un token vencido (401) vuelve al login. Un 401/502 de `/api/scop/consulta` **no** cierra la sesión.
- [ ] La carga inicial muestra cada paso y permite reintentar el que falle.
- [ ] Una cisterna GLP consulta sola con `sucursal = placa`. En líquidos, la consulta espera la llegada y el botón, con `sucursal = id de llegada`.
- [ ] El rango nunca pasa de 7 días. Refrescar envía `refrescar: true`.
- [ ] Los SCOP cerrados o anulados, los de producto desconocido, los de unidad incompatible con el motivo y los usados en otra guía salen deshabilitados, con su motivo.
- [ ] Al cambiar el motivo se sueltan los SCOP incompatibles.
- [ ] El proveedor se elige solo (GLP por parecido; La Pampilla → cliente 17) y nunca reemplaza al que eligió el usuario.
- [ ] Los detalles, documentos, peso y `scops` coinciden con lo que arma el front web para los mismos SCOP.
- [ ] Un correlativo duplicado (422) refresca el correlativo; un SCOP ocupado lo quita de la selección.
- [ ] Guardar y enviar: seguimiento hasta aceptada o rechazada.
- [ ] La lista de guías es paginada, con filtros, y las acciones se habilitan según el estado y el perfil.
- [ ] El PDF, XML y CDR se descargan y abren o se comparten en **Android 7 (API 24)** y en Android 14 o superior.
