<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'mensaje' => 'required'
        ]);

        Comentario::create([

            'ticket_id' => $ticket->id,

            'usuario_id' => auth()->id(),

            'mensaje' => $request->mensaje

        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Comentario agregado');
    }
}