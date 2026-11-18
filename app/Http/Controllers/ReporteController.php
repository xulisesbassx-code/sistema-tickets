<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\ServicioRapido;
use App\Exports\ReporteTecnicoExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tecnico_id' => 'nullable|exists:users,id',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $tecnicos = User::where('rol', 'tecnico')->get();

        $datos = [
            'ticketsResueltos' => 0,
            'ticketsAbiertos' => 0,
            'serviciosRapidos' => 0,
            'totalAtenciones' => 0,
            'tickets' => collect(),
            'servicios' => collect(),
        ];

        if ($request->filled('tecnico_id')) {
            $datos = $this->consultarReporte($request);
        }

        return view(
            'reportes.index',
            array_merge(
                compact('tecnicos'),
                $datos
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Consultar información del reporte
    |--------------------------------------------------------------------------
    */

    private function consultarReporte(Request $request)
    {
        $tecnicoId = $request->tecnico_id;

        // Consulta de tickets
        $consultaTickets = Ticket::with('usuario')
            ->where('tecnico_id', $tecnicoId)
            ->when($request->fecha_inicio, fn($q) =>
                $q->whereDate(
                    'created_at',
                    '>=',
                    $request->fecha_inicio
                )
            )
            ->when($request->fecha_fin, fn($q) =>
                $q->whereDate(
                    'created_at',
                    '<=',
                    $request->fecha_fin
                )
            );

        // Tickets resueltos
        $ticketsResueltos = (clone $consultaTickets)
            ->where('estado', 'resuelto')
            ->count();

        // Tickets abiertos
        $ticketsAbiertos = (clone $consultaTickets)
            ->whereIn('estado', [
                'nuevo',
                'proceso',
                'revision'
            ])
            ->count();

        // Listado completo de tickets
        $tickets = (clone $consultaTickets)
            ->latest()
            ->get();

        // Consulta de servicios rápidos
        $consultaServicios = ServicioRapido::where(
            'tecnico_id',
            $tecnicoId
        )
        ->when($request->fecha_inicio, fn($q) =>
            $q->whereDate(
                'created_at',
                '>=',
                $request->fecha_inicio
            )
        )
        ->when($request->fecha_fin, fn($q) =>
            $q->whereDate(
                'created_at',
                '<=',
                $request->fecha_fin
            )
        );

        $serviciosRapidos = (clone $consultaServicios)->count();

        $servicios = (clone $consultaServicios)
            ->latest()
            ->get();

        // Total de atenciones
        $totalAtenciones =
            $ticketsResueltos +
            $serviciosRapidos;

        return compact(
            'ticketsResueltos',
            'ticketsAbiertos',
            'serviciosRapidos',
            'totalAtenciones',
            'tickets',
            'servicios'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Exportar Excel
    |--------------------------------------------------------------------------
    */

    public function exportarExcel(Request $request)
    {
        $request->validate([
            'tecnico_id' => 'required|exists:users,id',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $tecnico = User::where('rol', 'tecnico')
            ->findOrFail($request->tecnico_id);

        $datos = $this->consultarReporte($request);

        return Excel::download(
            new ReporteTecnicoExport(
                $datos['tickets'],
                $datos['servicios']
            ),
            'reporte-tecnico-' . $tecnico->id . '.xlsx'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Exportar PDF
    |--------------------------------------------------------------------------
    */

    public function exportarPdf(Request $request)
    {
        $request->validate([
            'tecnico_id' => 'required|exists:users,id',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $tecnico = User::where('rol', 'tecnico')
            ->findOrFail($request->tecnico_id);

        $datos = $this->consultarReporte($request);

        $pdf = Pdf::loadView(
            'reportes.pdf',
            array_merge(
                $datos,
                [
                    'tecnico' => $tecnico,
                    'fechaInicio' => $request->fecha_inicio,
                    'fechaFin' => $request->fecha_fin,
                ]
            )
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download(
            'reporte-tecnico-' . $tecnico->id . '.pdf'
        );
    }
}
