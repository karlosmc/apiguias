# API para la app Android (credenciales PVO)

La app Android:
1. Inicia sesión con un usuario de guiasapi.
2. Descarga los establecimientos y placas **propios**.
3. Pide el usuario y la contraseña del **PVO de Osinergmin** del establecimiento o placa que va a usar.
4. Hace sus consultas al PVO y sube el resultado a `scop_temporal`.

Guía de implementación para la app (paso a paso, con código Kotlin): [README-APP-ANDROID.md](README-APP-ANDROID.md).

Código: `app/Http/Controllers/MovilController.php`, `app/Services/CifradoDispositivo.php`.

## Seguridad

| Capa | Qué hace |
|---|---|
| BD | `usuario` y `clave` cifrados con APP_KEY (`CredencialPvo`, cast `encrypted`) y ocultos en todo JSON |
| Token | El login móvil da un token Sanctum con la ability **`movil`**, que caduca (`MOVIL_TOKEN_HORAS`, 12 h). Solo sirve en `/api/movil/*` y `/api/scop-temporal`; el resto de la API responde 403 |
| Acceso | Usuarios `aprobado` con **`accesoMovil`**. Está **activo por defecto** para todos; el admin se lo quita a quien corresponda y en ese momento se cierran sus sesiones |
| Cifrado al celular | Cada credencial va cifrada con la llave pública del celular (Android Keystore). Sin la llave privada, que no sale del celular, la respuesta no sirve: ni con el token robado ni leyendo un proxy o un log |
| Una por petición | `POST /credenciales` entrega una sola, con throttle de 20/min. El login tiene 5/min por IP |
| Auditoría | Cada entrega queda en `credenciales_pvo_accesos`: usuario, celular, IP y fecha |
| Revocación | `POST /logout`, o el admin revoca el dispositivo. Si se pierde un celular: revocar y cambiar la clave en el PVO |
| HTTPS | `MOVIL_EXIGIR_HTTPS=true` rechaza HTTP con 403. **Solo en pruebas** se pone `false`: sin HTTPS, la contraseña del login y el token viajan en claro |

## Rutas de la app (`/api/movil`)

Todas usan `Accept: application/json`. Después del login, todas usan `Authorization: Bearer <token>`.

### `POST /login`

```json
{
  "documento": "44444444",
  "password": "********",
  "dispositivo": {
    "nombre": "Moto G - Juan",
    "llavePublica": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA..."
  }
}
```

`llavePublica` es la llave RSA de 2048 bits o más, en base64 de `publicKey.encoded` (DER) o en PEM.

| Respuesta | Cuándo |
|---|---|
| 200 `{exito, token, expiraEn, user:{id,name,documento}}` | correcto |
| 422 | documento o contraseña incorrectos, o llave inválida |
| 403 | cuenta no aprobada, o sin acceso móvil |
| 429 | más de 5 intentos por minuto |

Cada login registra un dispositivo nuevo con su llave.

### `POST /vincular` (app de guías, sin contraseña)
La app de guías ya tiene la sesión **web** (`POST /api/login`). Para consultar el PVO necesita además un token `movil`. Lo obtiene registrando el celular con su token web, sin volver a pedir la contraseña.

- **Auth:** `Authorization: Bearer <token web>` (ability `web`). Un token `movil` recibe 403, así que esta ruta no sirve para renovar un token móvil por sí solo.
- **Body:**
  ```json
  { "dispositivo": { "nombre": "Pixel 7 - guías", "llavePublica": "MIIBIjANBgkqh..." } }
  ```
- **Respuesta:** la misma de `/login` (`token`, `expiraEn`, `user`). Sus reglas son las de `/login`: usuario `aprobado` y con `accesoMovil`, y llave RSA de 2048 bits o más (422 si no).
- **Throttle:** solo el `throttle:api` del grupo.

### `GET /maestros`

Devuelve solo los establecimientos propios (`isCompany = 1`) y las placas propias de GLP (`isCompany = 1` y `glp = 1`), **nunca credenciales**:

```json
{
  "exito": true,
  "establecimientos": [
    { "id": 1, "nombre": "GRIFO 1", "nombreCorto": "GRIFO 1", "direccion": "...", "ubigeo": "230101", "codLocal": "0001", "ruc": "20123456789", "tieneCredencial": true }
  ],
  "vehiculos": [
    { "id": 5, "nombre": "ABC123", "placa": "ABC123", "nombreCorto": null, "tracto": false, "glp": true, "tieneCredencial": false }
  ]
}
```

`nombre` es el título para la app: el `nombreCorto` del catálogo (igual para todos los usuarios) o, si falta, `"codLocal - dirección"` en los establecimientos y la placa en los vehículos.

### `POST /credenciales`

Petición: `{"tipo": "establecimiento" | "vehiculo", "id": 1}`

```json
{
  "exito": true, "tipo": "establecimiento", "id": 1,
  "cifrado": { "alg": "RSA-OAEP+A256GCM", "llave": "<b64>", "iv": "<b64>", "datos": "<b64>" }
}
```

Al descifrarse da `{"usuario": "...", "clave": "..."}`.

| Respuesta | Cuándo |
|---|---|
| 404 | no es propio, o no tiene credencial activa |
| 401 | el celular fue revocado; hay que iniciar sesión de nuevo |
| 429 | más de 20 por minuto |

### `POST /logout`

Cierra la sesión de ese celular.

### Subir resultados: `POST /api/scop-temporal`

Mismo formato que para la otra app (ver `ScopTemporalController`): `{lote?, registros:[...]}`. Un SCOP es un registro único: inserta los nuevos, actualiza solo lo que cambió y no borra datos con vacíos. En líquidos cada SCOP lleva `idEstablecimiento` (el `id` de `/maestros`); en GLP no. Antes de enviar se puede llamar a `POST /api/scop-temporal/verificar` (vista previa: nuevos, cambios antes → después e iguales). Detalle en la sección 7 de [README-APP-ANDROID.md](README-APP-ANDROID.md). Con la sesión móvil basta el `Authorization: Bearer <token>`; no hace falta `X-Api-Key`.

## Android: llave y descifrado (Kotlin)

Crear la llave **una vez** en el Keystore. No es exportable y sobrevive a los logins:

```kotlin
val alias = "guiasapi-pvo"
val ks = KeyStore.getInstance("AndroidKeyStore").apply { load(null) }
if (!ks.containsAlias(alias)) {
    KeyPairGenerator.getInstance(KeyProperties.KEY_ALGORITHM_RSA, "AndroidKeyStore").apply {
        initialize(
            KeyGenParameterSpec.Builder(alias, KeyProperties.PURPOSE_DECRYPT)
                .setKeySize(2048)
                .setDigests(KeyProperties.DIGEST_SHA1, KeyProperties.DIGEST_SHA256)
                .setEncryptionPaddings(KeyProperties.ENCRYPTION_PADDING_RSA_OAEP)
                .build()
        )
    }.generateKeyPair()
}
val llavePublica = Base64.encodeToString(ks.getCertificate(alias).publicKey.encoded, Base64.NO_WRAP)
// → se manda en dispositivo.llavePublica del login
```

Descifrar la respuesta de `/credenciales`:

```kotlin
fun descifrar(cifrado: JSONObject): JSONObject {
    val privada = (ks.getEntry(alias, null) as KeyStore.PrivateKeyEntry).privateKey

    // 1) llave AES: RSA-OAEP con SHA-1 y MGF1-SHA1 (lo que usa el servidor)
    val rsa = Cipher.getInstance("RSA/ECB/OAEPWithSHA-1AndMGF1Padding")
    rsa.init(Cipher.DECRYPT_MODE, privada,
        OAEPParameterSpec("SHA-1", "MGF1", MGF1ParameterSpec.SHA1, PSource.PSpecified.DEFAULT))
    val aes = rsa.doFinal(Base64.decode(cifrado.getString("llave"), Base64.DEFAULT))

    // 2) datos: AES-256-GCM; `datos` ya trae el tag de 16 bytes al final
    val gcm = Cipher.getInstance("AES/GCM/NoPadding")
    gcm.init(Cipher.DECRYPT_MODE, SecretKeySpec(aes, "AES"),
        GCMParameterSpec(128, Base64.decode(cifrado.getString("iv"), Base64.DEFAULT)))
    val plano = gcm.doFinal(Base64.decode(cifrado.getString("datos"), Base64.DEFAULT))

    return JSONObject(String(plano, Charsets.UTF_8))   // {"usuario": "...", "clave": "..."}
}
```

## Recomendaciones para la app

- **Recordar la sesión**:
  - Guarda el **token** y su `expiraEn` en `EncryptedSharedPreferences`. Mientras no caduque, entra directo.
  - Si el usuario elige "recordar contraseña", guárdala también en `EncryptedSharedPreferences`, idealmente protegida con biometría (`BiometricPrompt`). Así "Iniciar sesión" es un clic cuando el token caduca.
- **Credenciales PVO**: solo en memoria mientras se usan. No las guardes en disco ni las escribas en logs. Si hacen falta otra vez, se piden de nuevo; cada petición queda auditada.
- Ante un **401**, borra el token guardado y vuelve al login.
- Ante un **403** en el login, muestra el mensaje `error`: indica si falta aprobación o acceso móvil.

## Administración (perfil admin, desde el front o Postman)

| Ruta | Qué hace |
|---|---|
| `PATCH /api/admin/usuarios/{id}/acceso-movil` `{accesoMovil: true\|false}` | Todos tienen acceso por defecto: se usa sobre todo para **quitarlo** (por ejemplo, si alguien pierde el celular o deja la empresa). Al quitarlo se cierran sus sesiones |
| `GET /api/admin/credenciales-pvo` | Establecimientos propios y placas propias **de GLP** con `usuario` y `tieneClave`. La clave nunca se devuelve |
| `PUT /api/admin/credenciales-pvo/{establecimiento\|vehiculo}/{id}` `{usuario, clave?, activo?}` | Crea o actualiza. La clave es obligatoria al crear; si se omite al actualizar, se conserva |
| `DELETE /api/admin/credenciales-pvo/{tipo}/{id}` | Elimina la credencial |
| `GET /api/admin/credenciales-pvo/accesos?porPagina=50` | Auditoría de entregas |
| `GET /api/admin/dispositivos` / `DELETE /api/admin/dispositivos/{id}` | Celulares con sesión, y revocar uno |

Las credenciales están cifradas con la `APP_KEY`. El backup de configuración las incluye, pero solo se pueden leer en una instalación con la misma `APP_KEY`.
