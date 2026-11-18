<?php

namespace App\Http\Controllers;

use App\Models\CredencialPvo;
use App\Models\CredencialPvoAcceso;
use App\Models\DispositivoMovil;
use App\Models\Puntoubicacion;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

/**
 * Administración de las credenciales PVO y del acceso móvil (solo admin).
 * La clave nunca se devuelve: solo `tieneClave`.
 */
class CredencialPvoController extends Controller
{
    /**
     * Establecimientos y placas propias con su credencial (si tienen).
     */
    public function index()
    {
        $resumen = function ($maestro) {
            $c = $maestro->credencialPvo;

            return $c ? [
                'usuario' => $c->usuario,
                'tieneClave' => $c->clave !== null && $c->clave !== '',
                'activo' => $c->activo,
                'actualizado' => optional($c->updated_at)->toIso8601String(),
            ] : null;
        };

        $establecimientos = CredencialPvo::validos(Puntoubicacion::with('credencialPvo'))->orderBy('id')->get()
            ->map(fn ($p) => [
                'id' => $p->id,
                'nombreCorto' => $p->nombreCortoGlobal(),
                'direccion' => $p->direccion,
                'codLocal' => $p->codLocal,
                'ruc' => $p->ruc,
                'credencial' => $resumen($p),
            ]);

        // Solo cisternas de GLP propias (CredencialPvo::validos)
        $vehiculos = CredencialPvo::validos(Vehiculo::with('credencialPvo'))->orderBy('placa')->get()
            ->map(fn ($v) => [
                'id' => $v->id,
                'placa' => $v->placa,
                'nombreCorto' => $v->nombreCortoGlobal(),
                'credencial' => $resumen($v),
            ]);

        return response()->json(['exito' => true, 'establecimientos' => $establecimientos, 'vehiculos' => $vehiculos]);
    }

    /**
     * Crear o actualizar. `clave` es obligatoria al crear; al actualizar, si
     * no se manda se conserva la que había.
     */
    public function guardar(Request $request, $tipo, $id)
    {
        $maestro = CredencialPvo::maestro($tipo, $id);

        if (! $maestro) {
            return response()->json(['exito' => false, 'error' => 'Solo se cargan credenciales a establecimientos propios o placas propias de GLP'], 404);
        }

        $columna = CredencialPvo::columna($tipo);
        $credencial = CredencialPvo::firstOrNew([$columna => $maestro->id]);

        $datos = $request->validate([
            'usuario' => 'required|string|max:100',
            'clave' => [$credencial->exists ? 'nullable' : 'required', 'string', 'max:200'],
            'activo' => 'sometimes|boolean',
        ]);

        $credencial->usuario = trim($datos['usuario']);
        if (($datos['clave'] ?? '') !== '') {
            $credencial->clave = $datos['clave'];
        }
        $credencial->activo = $datos['activo'] ?? ($credencial->activo ?? true);
        $credencial->id_user_actualizo = $request->user()->id;
        $credencial->save();

        return response()->json([
            'exito' => true,
            'message' => 'Credencial PVO guardada',
            'credencial' => ['id' => $credencial->id, 'usuario' => $credencial->usuario, 'tieneClave' => true, 'activo' => $credencial->activo],
        ], $credencial->wasRecentlyCreated ? 201 : 200);
    }

    public function eliminar($tipo, $id)
    {
        // Sin filtro: debe poder borrarse aunque al vehículo le hayan quitado el GLP
        $maestro = CredencialPvo::maestro($tipo, $id, false);
        $borradas = $maestro ? CredencialPvo::where(CredencialPvo::columna($tipo), $maestro->id)->delete() : 0;

        if (! $borradas) {
            return response()->json(['exito' => false, 'error' => 'No tiene credencial PVO'], 404);
        }

        return response()->json(['exito' => true, 'message' => 'Credencial PVO eliminada']);
    }

    /**
     * Auditoría de entregas, la más reciente primero.
     */
    public function accesos(Request $request)
    {
        $accesos = CredencialPvoAcceso::with(['credencial.establecimiento:id,direccion,codLocal', 'credencial.vehiculo:id,placa', 'user:id,name,documento', 'dispositivo:id,nombre'])
            ->orderByDesc('id')
            ->paginate(min((int) $request->input('porPagina', 50), 200));

        $accesos->getCollection()->transform(fn ($a) => [
            'id' => $a->id,
            'fecha' => optional($a->created_at)->toIso8601String(),
            'usuario' => optional($a->user)->only(['id', 'name', 'documento']),
            'dispositivo' => optional($a->dispositivo)->nombre,
            'ip' => $a->ip,
            'establecimiento' => optional(optional($a->credencial)->establecimiento)->only(['id', 'direccion', 'codLocal']),
            'vehiculo' => optional(optional($a->credencial)->vehiculo)->only(['id', 'placa']),
        ]);

        return response()->json(['exito' => true] + $accesos->toArray());
    }

    public function dispositivos()
    {
        $dispositivos = DispositivoMovil::with(['user:id,name,documento', 'token:id,expires_at'])
            ->orderByDesc('id')
            ->get()
            ->map(fn ($d) => [
                'id' => $d->id,
                'nombre' => $d->nombre,
                'usuario' => optional($d->user)->only(['id', 'name', 'documento']),
                'ultimoAcceso' => optional($d->ultimoAcceso)->toIso8601String(),
                'revocadoEn' => optional($d->revocadoEn)->toIso8601String(),
                'sesionActiva' => ! $d->revocadoEn && $d->token && (! $d->token->expires_at || $d->token->expires_at->isFuture()),
            ]);

        return response()->json(['exito' => true, 'dispositivos' => $dispositivos]);
    }

    public function revocarDispositivo(DispositivoMovil $dispositivo)
    {
        $dispositivo->revocar();

        return response()->json(['exito' => true, 'message' => "Dispositivo {$dispositivo->nombre} revocado"]);
    }

    /**
     * Dar o quitar acceso a la app móvil. Al quitarlo se cierran sus sesiones.
     */
    public function accesoMovil(Request $request, User $user)
    {
        $datos = $request->validate(['accesoMovil' => 'required|boolean']);

        $user->forceFill(['accesoMovil' => $datos['accesoMovil']])->save();

        if (! $datos['accesoMovil']) {
            DispositivoMovil::where('id_user', $user->id)->whereNull('revocadoEn')->get()->each->revocar();
        }

        return response()->json([
            'exito' => true,
            'message' => $datos['accesoMovil'] ? "{$user->name} ya puede usar la app móvil" : "{$user->name} ya no tiene acceso a la app móvil",
        ]);
    }
}
