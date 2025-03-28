<?php

namespace App\Http\Controllers;

use App\Models\Invitado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvitadoController extends Controller
{
    public function verificarCodigo(Request $request)
    {
        $codigo = $request->input('codigo');
        $invitado = Invitado::where('codigo', $codigo)->first();

        if (!$invitado) {
            return response()->json([
                'success' => false,
                'message' => 'Código incorrecto. Inténtalo de nuevo.'
            ]);
        }

        return response()->json([
            'success' => true,
            'redirect_url' => route('confirmar.asistencia', ['invitado' => $invitado->id])
        ]);
    }

    public function formularioConfirmacion($id)
    {
        $invitado = Invitado::findOrFail($id);
        // Fecha límite para confirmar (inclusive el 15 de septiembre de 2025)
        $fechaLimite = Carbon::create(2025, 9, 15)->endOfDay();
        $hoy = Carbon::now();

        $caducado = $hoy->greaterThan($fechaLimite);

        return view('confirmar-asistencia', compact('invitado', 'caducado'));
    }

    public function guardarConfirmacion(Request $request, $id)
    {
        $invitado = Invitado::findOrFail($id);

        if (!$request->has('yo_asistire') && !$request->has('no_asistira')) {
            return back()->with('error', 'Debes indicar si asistirás o no.')->withInput();
        }

        $rules = [];

        // 2. Validaciones si marca "sí asistiré"
        if ($request->has('yo_asistire')) {
            // Si viene con pareja, nombre obligatorio
            if ($request->has('viene_pareja')) {
                $rules['nombre_pareja'] = 'required|string|max:255';
            }

            // Si viene con hijos, número y nombres obligatorios
            if ($request->has('viene_hijos')) {
                $rules['numero_hijos'] = 'required|integer|min:1';
                $rules['nombres_hijos'] = 'required|string';
            }
        }

        // Valida los datos
        $validated = $request->validate($rules);

        // Verificar si ha marcado que no asiste
        $noAsistira = $request->has('no_asistira');
        $invitado->no_asistira = $noAsistira;
        $invitado->confirmado = !$noAsistira;

        if ($noAsistira) {
            // Limpia todos los campos opcionales
            $invitado->viene_pareja = false;
            $invitado->nombre_pareja = null;
            $invitado->viene_hijos = false;
            $invitado->nombres_hijos = null;
            $invitado->comentarios = null;
            $invitado->numero_invitados = 0;
        } else {
            // Guarda los campos normales
            $invitado->viene_pareja = $request->has('viene_pareja');
            $invitado->nombre_pareja = $request->input('nombre_pareja');
            $invitado->viene_hijos = $request->has('viene_hijos');
            $invitado->numero_hijos = $request->has('viene_hijos') ? (int) $request->input('numero_hijos', 0) : 0;
            $invitado->nombres_hijos = $request->input('nombres_hijos');
            $invitado->comentarios = $request->input('comentarios');

            // Calcular número de invitados
            $numero = 1; // el propio invitado
            if ($invitado->viene_pareja) $numero++;
            if ($invitado->viene_hijos && $invitado->nombres_hijos) {
                $numeroHijos = (int) $request->input('numero_hijos', 0);
                $numero += $numeroHijos;
            }
            $invitado->numero_invitados = $numero;
        }
        //dd($request->all());
        $invitado->save();

        return redirect('/')->with('success', $noAsistira
            ? '¡Gracias por avisarnos! Te echaremos de menos 😢'
            : '¡Gracias por confirmar tu asistencia! 🎉'
        );
    }


}
