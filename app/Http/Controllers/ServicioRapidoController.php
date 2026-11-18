<?php

namespace App\Http\Controllers;

use App\Models\ServicioRapido;
use Illuminate\Http\Request;

class ServicioRapidoController extends Controller
{
    public function index()
    {
        $query = ServicioRapido::with('tecnico');

        if(auth()->user()->rol == 'tecnico')
        {
            $query->where(
                'tecnico_id',
                auth()->id()
            );
        }

        $servicios = $query
            ->latest()
            ->get();

        return view(
            'servicios-rapidos.index',
            compact('servicios')
        );
    }

    public function create()
    {
        return view(
            'servicios-rapidos.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required',
            'tipo_equipo' => 'required',
            'problema' => 'required',
            'solucion' => 'required',
            'resultado' => 'required',
            'tiempo_invertido' => 'required'
        ]);

        ServicioRapido::create([

            'tecnico_id' => auth()->id(),

            'nombre_usuario' => $request->nombre_usuario,

            'departamento' => $request->departamento,

            'extension' => $request->extension,

            'ubicacion' => $request->ubicacion,

            'tipo_equipo' => $request->tipo_equipo,

            'problema' => $request->problema,

            'diagnostico' => $request->diagnostico,

            'solucion' => $request->solucion,

            'resultado' => $request->resultado,

            'tiempo_invertido' => $request->tiempo_invertido
        ]);

        return redirect()
            ->route('servicios-rapidos.index')
            ->with(
                'success',
                'Servicio registrado correctamente'
            );
    }

    public function show(ServicioRapido $servicios_rapido)
    {
        return view(
            'servicios-rapidos.show',
            compact('servicios_rapido')
        );
    }

    public function edit(ServicioRapido $servicios_rapido)
    {
        return view(
            'servicios-rapidos.edit',
            compact('servicios_rapido')
        );
    }

   public function update(
    Request $request,
    ServicioRapido $servicios_rapido
)
{
    $request->validate([

        'nombre_usuario' => 'required',

        'problema' => 'required',

        'solucion' => 'required',

        'resultado' => 'required'

    ]);

    $servicios_rapido->update([

        'nombre_usuario' => $request->nombre_usuario,

        'departamento' => $request->departamento,

        'extension' => $request->extension,

        'ubicacion' => $request->ubicacion,

        'tipo_equipo' => $request->tipo_equipo,

        'problema' => $request->problema,

        'diagnostico' => $request->diagnostico,

        'solucion' => $request->solucion,

        'resultado' => $request->resultado,

        'tiempo_invertido' => $request->tiempo_invertido

    ]);

    return redirect()
        ->route('servicios-rapidos.index')
        ->with(
            'success',
            'Servicio actualizado correctamente'
        );
}

   public function destroy(
    ServicioRapido $servicios_rapido
)
{
    if(auth()->user()->rol != 'admin')
    {
        abort(403);
    }

    $servicios_rapido->delete();

    return redirect()
        ->route('servicios-rapidos.index')
        ->with(
            'success',
            'Servicio eliminado correctamente'
        );
}
}
