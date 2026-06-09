<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\HistorialTicket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
   public function index(Request $request)
{
    $query = Ticket::with([
        'usuario',
        'tecnico'
    ]);

    if ($request->titulo) {
        $query->where(
            'titulo',
            'like',
            '%' . $request->titulo . '%'
        );
    }

    if ($request->estado) {
        $query->where(
            'estado',
            $request->estado
        );
    }

    if ($request->prioridad) {
        $query->where(
            'prioridad',
            $request->prioridad
        );
    }

    $tickets = $query
        ->latest()
        ->get();

    return view(
        'tickets.index',
        compact('tickets')
    );
}

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required'
        ]);

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'prioridad' => 'media',
            'estado' => 'nuevo'
        ]);

        HistorialTicket::create([
            'ticket_id' => $ticket->id,
            'usuario_id' => auth()->id(),
            'accion' => 'Creación de ticket',
            'descripcion' => 'El ticket fue creado'
        ]);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket creado correctamente');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load([
            'comentarios.usuario',
            'historial.usuario',
            'usuario',
            'tecnico'
        ]);

        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $tecnicos = User::where('rol', 'tecnico')->get();

        return view(
            'tickets.edit',
            compact('ticket', 'tecnicos')
        );
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'estado' => 'required',
            'prioridad' => 'required'
        ]);

        $estadoAnterior = $ticket->estado;
        $prioridadAnterior = $ticket->prioridad;
        $tecnicoAnterior = $ticket->tecnico_id;

        $ticket->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'estado' => $request->estado,
            'prioridad' => $request->prioridad,
            'tecnico_id' => $request->tecnico_id
        ]);

        if ($estadoAnterior != $ticket->estado) {

            HistorialTicket::create([
                'ticket_id' => $ticket->id,
                'usuario_id' => auth()->id(),
                'accion' => 'Cambio de estado',
                'descripcion' => "Estado cambiado de '{$estadoAnterior}' a '{$ticket->estado}'"
            ]);
        }

        if ($prioridadAnterior != $ticket->prioridad) {

            HistorialTicket::create([
                'ticket_id' => $ticket->id,
                'usuario_id' => auth()->id(),
                'accion' => 'Cambio de prioridad',
                'descripcion' => "Prioridad cambiada de '{$prioridadAnterior}' a '{$ticket->prioridad}'"
            ]);
        }

        if ($tecnicoAnterior != $ticket->tecnico_id) {

            $nombreTecnico = 'Sin asignar';

            if ($ticket->tecnico) {
                $nombreTecnico = $ticket->tecnico->name;
            }

            HistorialTicket::create([
                'ticket_id' => $ticket->id,
                'usuario_id' => auth()->id(),
                'accion' => 'Asignación de técnico',
                'descripcion' => "Ticket asignado a {$nombreTecnico}"
            ]);
        }

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket actualizado correctamente');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket eliminado correctamente');
    }

    public function misTickets()
    {
        $tickets = Ticket::with([
            'usuario',
            'tecnico'
        ])
        ->where('tecnico_id', auth()->id())
        ->latest()
        ->get();

        return view(
            'tickets.mis-tickets',
            compact('tickets')
        );
    }
}