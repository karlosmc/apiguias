<?php

namespace App\Services;

use RuntimeException;

/**
 * Cifra datos para UN celular con su llave pública (Android Keystore).
 *
 * Esquema híbrido "RSA-OAEP+A256GCM":
 *   1. llave AES-256 y IV de 12 bytes aleatorios por respuesta;
 *   2. datos (JSON) cifrados con AES-256-GCM; el tag de 16 bytes va AL FINAL
 *      de `datos`, que es lo que espera Cipher "AES/GCM/NoPadding" en Java;
 *   3. la llave AES cifrada con la pública RSA, OAEP con SHA-1/MGF1-SHA1
 *      (lo que da openssl_public_encrypt; en Android:
 *      "RSA/ECB/OAEPWithSHA-1AndMGF1Padding").
 *
 * Solo la llave privada del celular, que no sale del Keystore, puede abrirlo.
 * Contrato completo y ejemplo en Kotlin: docs/API-MOVIL.md.
 */
class CifradoDispositivo
{
    public const ALGORITMO = 'RSA-OAEP+A256GCM';

    public const BITS_MINIMOS = 2048;

    /**
     * Acepta la llave en PEM ("-----BEGIN PUBLIC KEY-----") o en base64 del DER
     * SubjectPublicKeyInfo (lo que da `publicKey.encoded` en Android).
     * Devuelve el PEM normalizado, o null si no es una llave RSA de 2048+ bits.
     */
    public static function validarLlave($llave)
    {
        $llave = trim((string) $llave);

        if ($llave === '') {
            return null;
        }

        if (! str_contains($llave, 'BEGIN PUBLIC KEY')) {
            $der = base64_decode(preg_replace('/\s+/', '', $llave), true);

            if ($der === false || $der === '') {
                return null;
            }

            $llave = "-----BEGIN PUBLIC KEY-----\n" . chunk_split(base64_encode($der), 64, "\n") . "-----END PUBLIC KEY-----\n";
        }

        $recurso = @openssl_pkey_get_public($llave);

        if ($recurso === false) {
            return null;
        }

        $detalles = openssl_pkey_get_details($recurso);

        if (($detalles['type'] ?? null) !== OPENSSL_KEYTYPE_RSA || ($detalles['bits'] ?? 0) < self::BITS_MINIMOS) {
            return null;
        }

        return $detalles['key'];
    }

    /**
     * @return array{alg: string, llave: string, iv: string, datos: string} todo en base64
     */
    public static function cifrar($pem, array $datos)
    {
        $llaveAes = random_bytes(32);
        $iv = random_bytes(12);
        $tag = '';

        $cifrado = openssl_encrypt(
            json_encode($datos, JSON_UNESCAPED_UNICODE),
            'aes-256-gcm',
            $llaveAes,
            OPENSSL_RAW_DATA,
            $iv,
            $tag,
            '',
            16
        );

        if ($cifrado === false || ! openssl_public_encrypt($llaveAes, $llaveCifrada, $pem, OPENSSL_PKCS1_OAEP_PADDING)) {
            throw new RuntimeException('No se pudo cifrar para el dispositivo');
        }

        return [
            'alg' => self::ALGORITMO,
            'llave' => base64_encode($llaveCifrada),
            'iv' => base64_encode($iv),
            'datos' => base64_encode($cifrado . $tag),
        ];
    }
}
