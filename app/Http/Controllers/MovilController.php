<?php

namespace App\Http\Controllers;

use App\Models\CredencialPvo;
use App\Models\CredencialPvoAcceso;
use App\Models\DispositivoMovil;
use App\Models\Puntoubicacion;
use App\Models\User;
use App\Models\Vehiculo;
use App\Services\CifradoDispositivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

/**
 * API de la app Android (prefijo /api/movil). Contrato: docs/API-MOVIL.md.
 *
 *   POST /login         documento + password + llave pública del celular → token `movil`
 *   GET  /maestros      establecimientos y placas propias (sin credenciales)
 *   POST /credenciales  usuario/clave PVO de UNO, cifrados para ese celular
 *   POST /logout        cierra la sesión del celular
 *
 * El token móvil solo sirve aquí y en /api/scop-temporal: el resto de la API
 * exige la ability `web` (ver routes/api.php).
 */
class MovilController extends Controller
{
    public function login(Request $request)
    {
        $datos = $request->validate([
            'documento' => 'required|string|max:20',
            'password' => 'required|string',
            'dispositivo.nombre' => 'required|string|max:100',
            'dispositivo.llavePublica' => 'required|string|max:5000',
        ]);

        $user = User::where('documento', $datos['documento'])->first();

        // Mismo mensaje exista o no el documento: no revela qué usuarios hay
        if (! $user || ! Hash::check($datos['password'], $user->password)) {
            throw ValidationException::withMessages(['documento' => 'El documento o el password son incorrectos']);
        }

        if (! $user->aprobado) {
            return response()->json(['exito' => false, 'error' => 'Tu cuenta aún no ha sido aprobada, comunícate con el administrador'], 403);
        }

        return $this->emitirTokenMovil($user, $datos['dispositivo']);
    }

    /**
     * Vincula este celular desde la app de guías, que ya tiene la sesión web
     * (token `web`): registra su llave pública y devuelve un token `movil`, igual
     * que /movil/login pero sin volver a pedir la contraseña. Un token `movil` no
     * puede usar esta ruta (pide la ability `web`).
     */
    public function vincular(Request $request)
    {
        $datos = $request->validate([
            'dispositivo.nombre' => 'required|string|max:100',
            'dispositivo.llavePublica' => 'required|string|max:5000',
        ]);

        $user = $request->user();

        if (! $user->aprobado) {
            return response()->json(['exito' => false, 'error' => 'Tu cuenta aún no ha sido aprobada, comunícate con el administrador'], 403);
        }

        return $this->emitirTokenMovil($user, $datos['dispositivo']);
    }

    /** Token `movil` + registro del celular (su llave pública). Común a login y vincular. */
    private function emitirTokenMovil(User $user, array $dispositivo)
    {
        if (! $user->accesoMovil) {
            return response()->json(['exito' => false, 'error' => 'Tu usuario no tiene acceso a la app móvil, comunícate con el administrador'], 403);
        }

        $pem = CifradoDispositivo::validarLlave($dispositivo['llavePublica']);

        if (! $pem) {
            throw ValidationException::withMessages([
                'dispositivo.llavePublica' => 'La llave pública debe ser RSA de al menos ' . CifradoDispositivo::BITS_MINIMOS . ' bits (PEM o base64 del DER)',
            ]);
        }

        // La expiración global de Sanctum (config/sanctum.php) también aplica
        $expira = now()->addHours((int) config('services.movil.token_horas', 12));
        $nuevo = $user->createToken('movil: ' . $dispositivo['nombre'], ['movil'], $expira);

        DispositivoMovil::create([
            'id_user' => $user->id,
            'nombre' => $dispositivo['nombre'],
            'llavePublica' => $pem,
            'id_token' => $nuevo->accessToken->id,
            'ultimoAcceso' => now(),
        ]);

        return response()->json([
            'exito' => true,
            'token' => $nuevo->plainTextToken,
            'expiraEn' => $expira->toIso8601String(),
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'documento' => $user->documento,
            ],
        ]);
    }

    /**
     * Establecimientos y placas propias. `tieneCredencial` dice si se puede
     * pedir su usuario/clave PVO; las credenciales nunca salen aquí.
     *
     * `nombre` es lo que la app muestra como título:
     *  - establecimiento: su nombreCorto del CATÁLOGO (el mismo para todos los
     *    operadores, no el apodo de cada usuario con FAVORITOS_POR_USUARIO);
     *    si no tiene, "codLocal - dirección";
     *  - vehículo: su nombreCorto del catálogo o, si no tiene, la placa.
     */
    public function maestros(Request $request)
    {
        $conCredencial = ['credencialPvo as tieneCredencial' => fn ($q) => $q->where('activo', true)];

        $establecimientos = CredencialPvo::validos(Puntoubicacion::query())
            ->withExists($conCredencial)
            ->get()
            ->map(function ($p) {
                $nombreCorto = $this->textoONull($p->nombreCortoGlobal());

                return [
                    'id' => $p->id,
                    'nombre' => $nombreCorto ?? trim($p->codLocal . ' - ' . $p->direccion, ' -'),
                    'nombreCorto' => $nombreCorto,
                    'direccion' => $p->direccion,
                    'ubigeo' => $p->ubigeo,
                    'codLocal' => $p->codLocal,
                    'ruc' => $p->ruc,
                    'tieneCredencial' => (bool) $p->tieneCredencial,
                ];
            })
            ->sortBy('nombre', SORT_NATURAL | SORT_FLAG_CASE)
            ->values();

        // Solo las cisternas de GLP propias (CredencialPvo::validos)
        $vehiculos = CredencialPvo::validos(Vehiculo::query())
            ->withExists($conCredencial)
            ->orderBy('placa')
            ->get()
            ->map(function ($v) {
                $nombreCorto = $this->textoONull($v->nombreCortoGlobal());

                return [
                    'id' => $v->id,
                    'nombre' => $nombreCorto ?? $v->placa,
                    'placa' => $v->placa,
                    'nombreCorto' => $nombreCorto,
                    'tracto' => (bool) $v->tracto,
                    'glp' => (bool) $v->glp,
                    'tieneCredencial' => (bool) $v->tieneCredencial,
                ];
            });

        return response()->json([
            'exito' => true,
            'establecimientos' => $establecimientos,
            'vehiculos' => $vehiculos,
        ]);
    }

    /**
     * Usuario y clave PVO de UN establecimiento o placa, cifrados con la llave
     * pública del celular de esta sesión. Cada entrega queda registrada.
     */
    public function credencial(Request $request)
    {
        $datos = $request->validate([
            'tipo' => ['required', Rule::in(array_keys(CredencialPvo::TIPOS))],
            'id' => 'required|integer',
        ]);

        $dispositivo = DispositivoMovil::where('id_token', optional($request->user()->currentAccessToken())->id)
            ->whereNull('revocadoEn')
            ->first();

        if (! $dispositivo) {
            return response()->json(['exito' => false, 'error' => 'Este celular no está registrado o fue revocado; inicia sesión de nuevo'], 401);
        }

        $maestro = CredencialPvo::maestro($datos['tipo'], $datos['id']);
        $credencial = $maestro
            ? CredencialPvo::where(CredencialPvo::columna($datos['tipo']), $maestro->id)->where('activo', true)->first()
            : null;

        if (! $credencial) {
            return response()->json(['exito' => false, 'error' => 'No hay credenciales PVO para ese ' . $datos['tipo']], 404);
        }

        $cifrado = CifradoDispositivo::cifrar($dispositivo->llavePublica, [
            'usuario' => $credencial->usuario,
            'clave' => $credencial->clave,
        ]);

        CredencialPvoAcceso::create([
            'id_credencial' => $credencial->id,
            'id_user' => $request->user()->id,
            'id_dispositivo' => $dispositivo->id,
            'ip' => $request->ip(),
        ]);
        $dispositivo->forceFill(['ultimoAcceso' => now()])->save();

        return response()->json([
            'exito' => true,
            'tipo' => $datos['tipo'],
            'id' => $maestro->id,
            'cifrado' => $cifrado,
        ]);
    }

    private function textoONull($valor)
    {
        $valor = trim((string) $valor);

        return $valor === '' ? null : $valor;
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $dispositivo = $token && isset($token->id) ? DispositivoMovil::where('id_token', $token->id)->first() : null;

        if ($dispositivo) {
            $dispositivo->revocar();
        } elseif ($token && method_exists($token, 'delete')) {
            $token->delete();
        }

        return response()->json(['exito' => true, 'message' => 'Sesión cerrada']);
    }
}
