# App Android: conexión con guiasapi (credenciales PVO y SCOP)

Este documento es para el desarrollo de la app Android. Explica todo lo que la app tiene que hacer para:

1. **Iniciar sesión** con un usuario de guiasapi.
2. **Descargar los maestros** (establecimientos y placas de la empresa).
3. **Pedir las credenciales del PVO de Osinergmin** de un establecimiento o placa. Llegan **cifradas para ese celular**.
4. **Consultar el PVO**, con lógica propia de la app que no forma parte de guiasapi.
5. **Subir los SCOP obtenidos** a guiasapi (`scop_temporal`).

Todo lo que dice este documento está implementado y probado en guiasapi (`MovilController`, `ScopTemporalController`).

---

## 1. Datos de conexión

| Qué | Valor |
|---|---|
| URL base (pruebas) | `http://apiguiascentenario.elcentenario.cloud/api` |
| URL base (producción) | `https://apiguiascentenario.elcentenario.cloud/api` (cuando el servidor tenga HTTPS) |
| Cabeceras en todas las peticiones | `Accept: application/json`, `Content-Type: application/json` |
| Autenticación | `Authorization: Bearer <token>` (el token sale del login) |
| Formato de fechas | `yyyy-MM-dd` o `yyyy-MM-dd HH:mm:ss` (hora de Perú) |

**La URL base debe ser configurable**, por ejemplo con `BuildConfig` por *build type*. No la dejes escrita en el código.

### HTTP en pruebas (solo debug)

Android bloquea HTTP sin cifrar. Mientras el servidor no tenga HTTPS, permítelo **solo en el build de debug** y **solo para ese dominio**.

`app/src/debug/res/xml/network_security_config.xml`:

```xml
<?xml version="1.0" encoding="utf-8"?>
<network-security-config>
    <domain-config cleartextTrafficPermitted="true">
        <domain includeSubdomains="false">apiguiascentenario.elcentenario.cloud</domain>
    </domain-config>
</network-security-config>
```

`app/src/debug/AndroidManifest.xml`:

```xml
<manifest xmlns:android="http://schemas.android.com/apk/res/android">
    <application android:networkSecurityConfig="@xml/network_security_config" />
</manifest>
```

El build de **release no debe permitir HTTP**. Cuando el servidor tenga HTTPS, guiasapi rechazará HTTP con un 403.

---

## 2. Flujo completo

```
┌───────────────┐   1. POST /movil/login (documento, password, llave pública)
│               │ ────────────────────────────────────────────────► token (12 h)
│               │   2. GET  /movil/maestros
│   App Android │ ────────────────────────────────────────────────► establecimientos[], vehiculos[]
│               │   3. POST /movil/credenciales {tipo, id}
│               │ ────────────────────────────────────────────────► {cifrado} → descifrar → usuario/clave
│               │   4. (la app consulta el PVO de Osinergmin con usuario/clave)
│               │   5. POST /scop-temporal/verificar {registros[]}   (no guarda)
│               │ ────────────────────────────────────────────────► "3 nuevos · 2 se actualizan · 40 ya están"
│               │   6. POST /scop-temporal {lote, registros[]}       (al confirmar)
│               │ ────────────────────────────────────────────────► {insertados, actualizados, sinCambios}
│               │   7. POST /movil/logout (al cerrar sesión)
└───────────────┘
```

---

## 3. Llave del celular (Android Keystore)

guiasapi **nunca** manda las credenciales en texto plano. Las cifra con la **llave pública de este celular**, y solo su llave privada puede abrirlas. Esa llave privada vive en el Android Keystore y no se puede extraer.

Crea la llave **una sola vez**, en el primer arranque o antes del primer login. Se reutiliza en todos los logins:

```kotlin
object LlaveDispositivo {
    private const val ALIAS = "guiasapi-pvo"

    private val keyStore: KeyStore
        get() = KeyStore.getInstance("AndroidKeyStore").apply { load(null) }

    /** Crea la llave si no existe y devuelve la pública en base64 (para el login). */
    fun publicaBase64(): String {
        if (!keyStore.containsAlias(ALIAS)) {
            KeyPairGenerator.getInstance(KeyProperties.KEY_ALGORITHM_RSA, "AndroidKeyStore").apply {
                initialize(
                    KeyGenParameterSpec.Builder(ALIAS, KeyProperties.PURPOSE_DECRYPT)
                        .setKeySize(2048)
                        .setDigests(KeyProperties.DIGEST_SHA1, KeyProperties.DIGEST_SHA256)
                        .setEncryptionPaddings(KeyProperties.ENCRYPTION_PADDING_RSA_OAEP)
                        .build()
                )
            }.generateKeyPair()
        }
        val publica = keyStore.getCertificate(ALIAS).publicKey
        return Base64.encodeToString(publica.encoded, Base64.NO_WRAP)
    }

    fun privada(): PrivateKey =
        (keyStore.getEntry(ALIAS, null) as KeyStore.PrivateKeyEntry).privateKey
}
```

Detalles importantes:
- **2048 bits como mínimo**: guiasapi rechaza llaves más chicas con un 422.
- **`DIGEST_SHA1` es obligatorio**: el servidor cifra con RSA-OAEP SHA-1/MGF1-SHA1.
- Si se reinstala la app o se borran sus datos, se genera una llave nueva. No es un problema: el siguiente login registra la llave nueva.

---

## 4. Login

### `POST /movil/login`

Petición:

```json
{
  "documento": "44444444",
  "password": "la-contraseña-de-guiasapi",
  "dispositivo": {
    "nombre": "Moto G54 - Juan Pérez",
    "llavePublica": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA..."
  }
}
```

- `nombre`: algo que permita al admin reconocer el celular (modelo + nombre del usuario). Máximo 100 caracteres.
- `llavePublica`: `LlaveDispositivo.publicaBase64()`.

Respuesta **200**:

```json
{
  "exito": true,
  "token": "12|Xk9a...",
  "expiraEn": "2026-11-15T08:30:00-05:00",
  "user": { "id": 7, "name": "JUAN PEREZ", "documento": "44444444" }
}
```

Errores:

| HTTP | Cuerpo | Qué mostrar |
|---|---|---|
| 422 | `{"message": "...", "errors": {"documento": ["El documento o el password son incorrectos"]}}` | "Documento o contraseña incorrectos" |
| 422 | `errors["dispositivo.llavePublica"]` | Error interno de la app (llave inválida): no debería pasar |
| 403 | `{"exito": false, "error": "Tu cuenta aún no ha sido aprobada..."}` | El texto de `error` |
| 403 | `{"exito": false, "error": "Tu usuario no tiene acceso a la app móvil..."}` | El texto de `error` (lo activa el administrador) |
| 403 | `{"exito": false, "error": "La app móvil solo funciona por HTTPS"}` | Revisar la URL base: el servidor exige HTTPS |
| 429 | `Too Many Attempts.` | "Demasiados intentos, espera un minuto" (máximo 5 por minuto) |

### Recordar la sesión y la contraseña

El token dura **12 horas** (`expiraEn`). Recomendación:

1. **Guarda el token y `expiraEn`** cifrados en el celular (ver §9).
2. **Al abrir la app**:
   - Si hay un token y `expiraEn` está en el futuro, entra directo, sin pantalla de login.
   - Si no, muestra el login.
3. **"Recordar contraseña"** (casilla opcional en el login):
   - Si está marcada, guarda documento y contraseña cifrados, idealmente protegidos con **biometría**.
   - Cuando el token caduque, la pantalla de login aparece ya llena y basta con un clic en **"Iniciar sesión"**, o con la huella.
4. **Ante cualquier 401**: borra el token guardado y vuelve al login. Si hay contraseña recordada, se puede reintentar el login una sola vez de forma automática.

---

## 5. Maestros

### `GET /movil/maestros`

Devuelve **solo** los establecimientos propios de la empresa y las placas propias **de GLP** (`glp = true`). **No trae credenciales.**

```json
{
  "exito": true,
  "establecimientos": [
    {
      "id": 1,
      "nombre": "GRIFO CENTENARIO 1",
      "nombreCorto": "GRIFO CENTENARIO 1",
      "direccion": "AV. LEGUIA 123",
      "ubigeo": "230101",
      "codLocal": "0001",
      "ruc": "20123456789",
      "tieneCredencial": true
    }
  ],
  "vehiculos": [
    {
      "id": 5,
      "nombre": "ABC123",
      "placa": "ABC123",
      "nombreCorto": null,
      "tracto": false,
      "glp": true,
      "tieneCredencial": false
    }
  ]
}
```

- **`nombre` es el título que debe mostrar la app** en listas y selectores:
  - Establecimiento: su **`nombreCorto`**, el nombre principal definido en guiasapi e igual para todos los usuarios. Si no tiene, guiasapi envía `"codLocal - dirección"`, así que `nombre` nunca llega vacío.
  - Vehículo: su `nombreCorto` o, si no tiene, la placa.
  - Debajo puede mostrarse un subtítulo: la `direccion` en los establecimientos, la `placa` en los vehículos.
- `nombreCorto` llega tal cual: `null` si no está definido. Úsalo solo si necesitas distinguir "tiene nombre" de "nombre generado".
- La lista de establecimientos llega ordenada por `nombre`, y la de vehículos por placa.
- Guárdalos localmente (Room o un JSON en disco). No son secretos, y sirven para trabajar sin pedirlos a cada rato.
- Refréscalos después de cada login, o con un botón "Actualizar".
- `tieneCredencial = false` significa que el administrador todavía no cargó usuario y clave PVO para ese maestro. Muéstralo deshabilitado o con un aviso, y no pidas sus credenciales (darían 404).
- `id` es el identificador que se usa para pedir las credenciales. La placa o el código no sirven para eso.
- La distribución de los maestros (qué usuario trabaja con qué establecimiento o placa) la decide la app. guiasapi deja pedir cualquiera de los propios.

---

## 6. Credenciales PVO

### `POST /movil/credenciales`

Petición, **una por vez**:

```json
{ "tipo": "establecimiento", "id": 1 }
```

`tipo` es `"establecimiento"` o `"vehiculo"`; `id` viene de los maestros.

Respuesta **200**:

```json
{
  "exito": true,
  "tipo": "establecimiento",
  "id": 1,
  "cifrado": {
    "alg": "RSA-OAEP+A256GCM",
    "llave": "base64...",
    "iv": "base64...",
    "datos": "base64..."
  }
}
```

Errores:

| HTTP | Significado | Qué hacer |
|---|---|---|
| 404 | El maestro no es propio, no existe o no tiene credencial activa | "Este establecimiento/placa no tiene credenciales PVO" |
| 401 | Token vencido o celular revocado por el administrador | Borrar el token y volver al login |
| 422 | `tipo` o `id` inválidos | Error de la app |
| 429 | Más de 20 pedidos por minuto | Esperar; no reintentar en bucle |

### Descifrar

```kotlin
data class CredencialPvo(val usuario: String, val clave: String)

fun descifrarCredencial(cifrado: JSONObject): CredencialPvo {
    require(cifrado.getString("alg") == "RSA-OAEP+A256GCM")

    // 1) La llave AES viene cifrada con RSA-OAEP (SHA-1 / MGF1-SHA1)
    val rsa = Cipher.getInstance("RSA/ECB/OAEPWithSHA-1AndMGF1Padding")
    rsa.init(
        Cipher.DECRYPT_MODE,
        LlaveDispositivo.privada(),
        OAEPParameterSpec("SHA-1", "MGF1", MGF1ParameterSpec.SHA1, PSource.PSpecified.DEFAULT)
    )
    val llaveAes = rsa.doFinal(Base64.decode(cifrado.getString("llave"), Base64.DEFAULT))

    // 2) Los datos van en AES-256-GCM; `datos` ya incluye el tag de 16 bytes al final
    val gcm = Cipher.getInstance("AES/GCM/NoPadding")
    gcm.init(
        Cipher.DECRYPT_MODE,
        SecretKeySpec(llaveAes, "AES"),
        GCMParameterSpec(128, Base64.decode(cifrado.getString("iv"), Base64.DEFAULT))
    )
    val plano = gcm.doFinal(Base64.decode(cifrado.getString("datos"), Base64.DEFAULT))

    val json = JSONObject(String(plano, Charsets.UTF_8))
    llaveAes.fill(0)
    return CredencialPvo(json.getString("usuario"), json.getString("clave"))
}
```

Si `doFinal` lanza `AEADBadTagException` o `BadPaddingException`, la respuesta se cifró para otra llave: por ejemplo, se reinstaló la app y el token es de una sesión anterior. Cierra la sesión y pide login de nuevo.

### Reglas para las credenciales

- **Solo en memoria** mientras se usan para consultar el PVO. **Nunca** en disco, base local, logs, crash reports ni analytics.
- Si hacen falta otra vez, se piden de nuevo. Cada entrega queda auditada en guiasapi con el usuario, el celular, la IP y la hora.
- No las muestres en pantalla. Si el negocio lo exige, solo con confirmación biométrica.
- Desactiva el log de cuerpos HTTP (`HttpLoggingInterceptor`) en release y, en cualquier build, para esta ruta.

---

## 7. Subir los SCOP a guiasapi

Después de consultar el PVO, la app sube los resultados. **Un SCOP (`nroScop`) es un registro único** en guiasapi: volver a enviarlo **no lo duplica**, sino que lo actualiza si cambió algo.

| El SCOP enviado… | Qué hace guiasapi |
|---|---|
| no existe | lo **inserta** |
| existe y algún dato cambió | **actualiza solo los campos que cambiaron** |
| existe y es igual | **no lo toca** |

**Un dato nunca se borra con un vacío.** Si a las 11:00 p. m. un SCOP llega sin factura, se conserva la factura que ya tenía. Un campo vacío, `null` o ausente significa "sin novedad", no "borrar".

Las dos rutas usan el **mismo token** de la sesión (`Authorization: Bearer <token>`). No necesitan otra clave.

### Flujo recomendado

1. Arma los `registros` con lo obtenido del PVO.
2. `POST /scop-temporal/verificar` con esos registros. **No guarda nada.**
3. Muestra el resumen al usuario, por ejemplo: **"3 nuevos · 2 se actualizan · 40 ya están cargados"**, con el detalle de cada cambio (campo: antes → después).
4. El botón dice **"Enviar 3 nuevos y actualizar 2"**. Si no hay nuevos ni cambios, muestra **"Todo ya está cargado"** y no envía nada.
5. Al confirmar: `POST /scop-temporal` con los **mismos** registros.

### Registros (mismo formato en las dos rutas)

```json
{
  "lote": "movil-7-20261116-153000",
  "registros": [
    {
      "nroScop": "12345678901",
      "factura": "F001-00012345",
      "proveedor": "DISTRIBUIDORA DE GAS DEL SUR S.A.C.",
      "fechaPedido": "2026-11-14",
      "fechaVenta": "2026-11-14 10:15:00",
      "fechaDespacho": "2026-11-14 11:30:00",
      "estadoPedido": "DESPACHADO",
      "producto": "GLP GRANEL",
      "placa": "ABC-123",
      "idEstablecimiento": 1,
      "volumen": 1500.5,
      "unidadMedida": "GLL"
    }
  ]
}
```

| Campo | Obligatorio | Formato |
|---|---|---|
| `lote` | No (solo en `POST /scop-temporal`) | Hasta 64 caracteres: letras, números, `.`, `-` y `_`. Si no se manda, se genera uno |
| `registros` | Sí | De 1 a 2000 por petición |
| `nroScop` | **Sí** | Texto, hasta 50 caracteres. Es la identidad del SCOP |
| `placa` | **Sí** | Texto, hasta 20 caracteres. Se normaliza (`abc-123` → `ABC123`) |
| `idEstablecimiento` | **Líquidos: sí** · GLP: no | Número: el `id` del establecimiento de `GET /movil/maestros` (ver abajo) |
| `factura` | No | Hasta 30 caracteres |
| `proveedor` | No | Hasta 400 caracteres |
| `fechaPedido`, `fechaVenta`, `fechaDespacho` | No | `yyyy-MM-dd` o `yyyy-MM-dd HH:mm:ss` |
| `estadoPedido` | No | Hasta 100 caracteres |
| `producto` | No | Hasta 200 caracteres |
| `volumen` | No | Número |
| `unidadMedida` | No | Hasta 10 caracteres |

- **Diferencias de formato no cuentan como cambio**: `2026-11-14` y `2026-11-14 00:00:00`, `1500.50` y `1500.5`, `ABC 123` y `ABC123`, o un texto con espacios al inicio o al final.
- **Mismo `nroScop` repetido en una petición**: se juntan en uno (lo no vacío que viene después tiene prioridad). La respuesta informa cuántos hubo en `repetidosEnPeticion`.
- Si la app manda campos adicionales, como `tipo`, se ignoran.

### `idEstablecimiento` (líquidos)

En **líquidos**, cada SCOP debe llevar el **`id` del establecimiento** que lo originó:

- Es el `id` de `establecimientos[]` en `GET /movil/maestros`.
- Normalmente es el establecimiento cuyas credenciales PVO se usaron para consultar.

Al hacer la guía de remisión, guiasapi filtra los SCOP de líquidos por **placa y punto de llegada**, y ese punto es este `id`. Si un SCOP de líquidos llega sin `idEstablecimiento`, se sigue mostrando, pero en **todos** los puntos de llegada de esa placa. Por eso conviene enviarlo siempre.

En **GLP** no se envía (o va `null`): ahí basta la placa de la cisterna.

| Caso | Qué pasa |
|---|---|
| `idEstablecimiento` no existe en guiasapi | 422 en ese registro (`errors["registros.N.idEstablecimiento"]`) y no se guarda nada |
| El SCOP ya tenía establecimiento y llega sin él | Se conserva el que tenía (un vacío no borra) |
| Llega con otro establecimiento | Es un cambio: sale en `verificar` como `"idEstablecimiento": {"antes": 1, "despues": 2}` y se actualiza |

### `POST /scop-temporal/verificar` (vista previa, no guarda)

Respuesta **200**:

```json
{
  "exito": true,
  "mensaje": "3 nuevos · 2 se actualizan · 40 ya están cargados",
  "resumen": { "nuevos": 3, "actualizan": 2, "iguales": 40 },
  "repetidosEnPeticion": 0,
  "nuevos": [
    { "nroScop": "300", "factura": null, "proveedor": "GAS SUR", "fechaPedido": "2026-11-16 00:00:00", "fechaVenta": null,
      "fechaDespacho": null, "estadoPedido": "PENDIENTE", "producto": "GLP", "placa": "ABC123", "volumen": 1200, "unidadMedida": "GLL" }
  ],
  "cambios": [
    {
      "nroScop": "100",
      "cambios": {
        "estadoPedido": { "antes": "PENDIENTE", "despues": "DESPACHADO" },
        "fechaDespacho": { "antes": null, "despues": "2026-11-15 23:00:00" }
      }
    }
  ],
  "iguales": ["200", "201"]
}
```

- Si no hay nuevos ni cambios, `mensaje` es `"Todo ya está cargado (40)"`.
- En `cambios` solo aparecen los campos que **realmente** cambiarían. Un campo vacío nunca aparece, porque no borra.

### `POST /scop-temporal` (guardar)

Respuesta **200**:

```json
{
  "exito": true,
  "message": "3 nuevos · 2 actualizados · 40 sin cambios",
  "lote": "movil-7-20261116-153000",
  "insertados": 3,
  "actualizados": 2,
  "sinCambios": 40,
  "repetidosEnPeticion": 0,
  "detalle": {
    "insertados": ["300", "301", "302"],
    "actualizados": [
      { "nroScop": "100", "cambios": { "estadoPedido": { "antes": "PENDIENTE", "despues": "DESPACHADO" } } }
    ]
  }
}
```

- Es **todo o nada**: si un registro es inválido, no se guarda ninguno.
- Entre la verificación y el envío pueden pasar cosas, por ejemplo otra carga del mismo SCOP. Por eso los números finales son los de **esta** respuesta, no los de la vista previa.
- **Reenviar es seguro**: si una petición falla por red y no sabes si llegó, vuelve a enviarla igual. Lo que ya estaba cargado sale como "sin cambios"; nada se duplica.

Errores (para las dos rutas):

| HTTP | Significado |
|---|---|
| 422 | Algún registro es inválido. `errors` indica cuál (p. ej. `"registros.3.nroScop"`) |
| 401 | Token vencido: volver al login y reenviar |
| 429 | Más de 60 peticiones por minuto |

### Lotes

- El `lote` identifica la carga en la que **entró** cada SCOP. Solo se asigna a los nuevos; al actualizar un SCOP, su lote no cambia.
- Genera uno por consulta al PVO, por ejemplo `movil-{userId}-{yyyyMMdd-HHmmss}`.
- Si son más de 2000 registros, envíalos en varias peticiones (y verifícalos en bloques del mismo tamaño).

---

## 8. Cerrar sesión

### `POST /movil/logout`

Con el token. Respuesta: `{"exito": true, "message": "Sesión cerrada"}`.

Después, borra el token guardado. Si el usuario elige "olvidar contraseña", borra también las credenciales de login recordadas. **No borres** la llave del Keystore: sirve para el siguiente login.

---

## 9. Guardar el token y la contraseña en el celular

Nunca en texto plano en `SharedPreferences`. Cifra con una llave **AES del Android Keystore** y guarda el resultado, por ejemplo en DataStore:

```kotlin
object Boveda {
    private const val ALIAS = "guiasapi-local"

    private fun llave(conBiometria: Boolean = false): SecretKey {
        val ks = KeyStore.getInstance("AndroidKeyStore").apply { load(null) }
        val alias = if (conBiometria) "$ALIAS-bio" else ALIAS
        (ks.getEntry(alias, null) as? KeyStore.SecretKeyEntry)?.let { return it.secretKey }
        return KeyGenerator.getInstance(KeyProperties.KEY_ALGORITHM_AES, "AndroidKeyStore").apply {
            init(
                KeyGenParameterSpec.Builder(alias, KeyProperties.PURPOSE_ENCRYPT or KeyProperties.PURPOSE_DECRYPT)
                    .setBlockModes(KeyProperties.BLOCK_MODE_GCM)
                    .setEncryptionPaddings(KeyProperties.ENCRYPTION_PADDING_NONE)
                    .setKeySize(256)
                    .apply { if (conBiometria) setUserAuthenticationRequired(true) }
                    .build()
            )
        }.generateKey()
    }

    fun cifrar(texto: String): String {
        val c = Cipher.getInstance("AES/GCM/NoPadding").apply { init(Cipher.ENCRYPT_MODE, llave()) }
        val salida = c.iv + c.doFinal(texto.toByteArray(Charsets.UTF_8))
        return Base64.encodeToString(salida, Base64.NO_WRAP)
    }

    fun descifrar(b64: String): String {
        val todo = Base64.decode(b64, Base64.NO_WRAP)
        val c = Cipher.getInstance("AES/GCM/NoPadding")
        c.init(Cipher.DECRYPT_MODE, llave(), GCMParameterSpec(128, todo.copyOfRange(0, 12)))
        return String(c.doFinal(todo.copyOfRange(12, todo.size)), Charsets.UTF_8)
    }
}
```

- **Token**: guarda `Boveda.cifrar(token)` y `expiraEn`.
- **Contraseña recordada con huella**: usa la variante `conBiometria = true` y descifra dentro de un `BiometricPrompt` con `CryptoObject(cipher)`. Así la contraseña solo se abre con la huella del dueño.

---

## 10. Cliente HTTP (ejemplo con Retrofit + OkHttp)

```kotlin
interface GuiasApi {
    @POST("movil/login")        suspend fun login(@Body body: LoginRequest): Response<LoginResponse>
    @GET("movil/maestros")      suspend fun maestros(): Response<MaestrosResponse>
    @POST("movil/credenciales") suspend fun credenciales(@Body body: CredencialRequest): Response<CredencialResponse>
    @POST("scop-temporal/verificar") suspend fun verificarScop(@Body body: ScopLoteRequest): Response<ScopVerificacionResponse>
    @POST("scop-temporal")      suspend fun subirScop(@Body body: ScopLoteRequest): Response<ScopLoteResponse>
    @POST("movil/logout")       suspend fun logout(): Response<Unit>
}

class AuthInterceptor(private val sesion: Sesion) : Interceptor {
    override fun intercept(chain: Interceptor.Chain): okhttp3.Response {
        val req = chain.request().newBuilder()
            .header("Accept", "application/json")
            .apply { sesion.token()?.let { header("Authorization", "Bearer $it") } }
            .build()
        val res = chain.proceed(req)
        if (res.code == 401) sesion.cerrar()   // borra el token → la UI vuelve al login
        return res
    }
}

val okHttp = OkHttpClient.Builder()
    .addInterceptor(AuthInterceptor(sesion))
    .connectTimeout(15, TimeUnit.SECONDS)
    .readTimeout(30, TimeUnit.SECONDS)
    // HttpLoggingInterceptor solo en debug y con nivel HEADERS, nunca BODY
    .build()
```

Las clases de datos siguen exactamente los JSON de las secciones 4 a 7. Respeta las mayúsculas de los nombres: `llavePublica`, `tieneCredencial`, `nroScop`, `fechaDespacho`, etc.

---

## 11. Checklist de implementación

- [ ] URL base configurable por build type. HTTP permitido solo en debug y solo para el dominio de pruebas.
- [ ] Llave RSA 2048 en el Keystore con `DIGEST_SHA1` + OAEP, creada una vez.
- [ ] Login con `dispositivo.nombre` y `dispositivo.llavePublica`. Mensajes para 422, 403 y 429.
- [ ] Token y `expiraEn` guardados cifrados; entrar directo si no caducó.
- [ ] "Recordar contraseña" opcional, cifrada (idealmente con biometría); login de un clic.
- [ ] Cualquier 401 → borrar el token y volver al login.
- [ ] Maestros guardados localmente; deshabilitar los de `tieneCredencial = false`.
- [ ] Credenciales pedidas una por una, descifradas y **solo en memoria**. Nada de logs de cuerpos HTTP.
- [ ] Antes de subir: `scop-temporal/verificar` y mostrar "N nuevos · M se actualizan · K ya están cargados" con el detalle de cambios; botón "Enviar N nuevos y actualizar M" o "Todo ya está cargado".
- [ ] En líquidos, cada SCOP lleva `idEstablecimiento` (el `id` de los maestros); en GLP no.
- [ ] Subida a `scop-temporal` con un lote por consulta y bloques de hasta 2000. Reenviar es seguro (no duplica); los campos vacíos no borran datos.
- [ ] Logout llama a la API y borra el token; la llave del Keystore se conserva.

---

## 12. Probar sin la app (curl)

```bash
BASE=http://apiguiascentenario.elcentenario.cloud/api

# Llave de prueba (en la app la genera el Keystore)
openssl genpkey -algorithm RSA -pkeyopt rsa_keygen_bits:2048 -out priv.pem
LLAVE=$(openssl rsa -in priv.pem -pubout -outform DER | base64 -w0)

# 1) Login
curl -s -X POST $BASE/movil/login -H "Accept: application/json" -H "Content-Type: application/json" \
  -d "{\"documento\":\"44444444\",\"password\":\"secreto\",\"dispositivo\":{\"nombre\":\"Prueba curl\",\"llavePublica\":\"$LLAVE\"}}"
TOKEN=...   # el "token" de la respuesta

# 2) Maestros
curl -s $BASE/movil/maestros -H "Accept: application/json" -H "Authorization: Bearer $TOKEN"

# 3) Credencial (sale cifrada)
curl -s -X POST $BASE/movil/credenciales -H "Accept: application/json" -H "Content-Type: application/json" \
  -H "Authorization: Bearer $TOKEN" -d '{"tipo":"establecimiento","id":1}'

# 4) Verificar (no guarda) y luego subir SCOP
curl -s -X POST $BASE/scop-temporal/verificar -H "Accept: application/json" -H "Content-Type: application/json"   -H "Authorization: Bearer $TOKEN"   -d '{"registros":[{"nroScop":"123","placa":"ABC-123","producto":"GLP","volumen":100,"unidadMedida":"GLL"}]}'
curl -s -X POST $BASE/scop-temporal -H "Accept: application/json" -H "Content-Type: application/json"   -H "Authorization: Bearer $TOKEN"   -d '{"lote":"prueba-curl-1","registros":[{"nroScop":"123","placa":"ABC-123","producto":"GLP","volumen":100,"unidadMedida":"GLL"}]}'
# Repetir el último comando → "0 nuevos · 0 actualizados · 1 sin cambios"

# 5) Logout
curl -s -X POST $BASE/movil/logout -H "Accept: application/json" -H "Authorization: Bearer $TOKEN"
```

Antes de probar, en guiasapi tiene que estar listo lo siguiente:
- El usuario está **aprobado**. El acceso móvil está activo por defecto; si a alguien se le quitó, se reactiva con `PATCH /api/admin/usuarios/{id}/acceso-movil` `{"accesoMovil": true}`.
- El establecimiento o la placa está marcado como **propio** y tiene su credencial PVO cargada (`PUT /api/admin/credenciales-pvo/{tipo}/{id}`).
