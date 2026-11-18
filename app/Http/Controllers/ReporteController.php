<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\ServicioRapido;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $tecnicos = User::where(
            'rol',
            'tecnico'
        )->get();

        $ticketsResueltos = 0;
        $ticketsAbiertos = 0;
        $serviciosRapidos = 0;
        $totalAtenciones = 0;

        if ($request->filled('tecnico_id')) {

            $ticketsResueltos = Ticket::where(
                'tecnico_id',
                $request->tecnico_id
            )
            ->where('estado', 'resuelto')
            ->when(
                $request->fecha_inicio,
                fn($q) =>
                $q->whereDate(
                    'created_at',
                    '>=',
                    $request->fecha_inicio
                )
            )
            ->when(
                $request->fecha_fin,
                fn($q) =>
                $q->whereDate(
                    'created_at',
                    '<=',
                    $request->fecha_fin
                )
            )
            ->count();

            $ticketsAbiertos = Ticket::where(
                'tecnico_id',
                $request->tecnico_id
            )
            ->whereIn('estado', [
                'nuevo',
                'proceso',
                'revision'
            ])
            ->count();

            $serviciosRapidos = ServicioRapido::where(
                'tecnico_id',
                $request->tecnico_id
            )
            ->when(
                $request->fecha_inicio,
                fn($q) =>
                $q->whereDate(
                    'created_at',
                    '>=',
                    $request->fecha_inicio
                )
            )
            ->when(
                $request->fecha_fin,
                fn($q) =>
                $q->whereDate(
                    'created_at',
                    '<=',
                    $request->fecha_fin
                )
            )
            ->count();

            $totalAtenciones =
                $ticketsResueltos +
                $serviciosRapidos;
        }

        return view(
            'reportes.index',
            compact(
                'tecnicos',
                'ticketsResueltos',
                'ticketsAbiertos',
                'serviciosRapidos',
                'totalAtenciones'
            )
        );
    }
}
