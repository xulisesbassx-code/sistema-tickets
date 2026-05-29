<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\HistorialTicket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('usuario')->latest()->get();

        return view('tickets.index', compact('tickets'));
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

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket creado');
    }
    

   public function show(Ticket $ticket)
{
    $ticket->load('comentarios.usuario');

    return view('tickets.show', compact('ticket'));
}


public function edit(Ticket $ticket)
{
    return view('tickets.edit', compact('ticket'));
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

    $ticket->update([

        'titulo' => $request->titulo,

        'descripcion' => $request->descripcion,

        'categoria' => $request->categoria,

        'estado' => $request->estado,

        'prioridad' => $request->prioridad

    ]);

    return redirect()
        ->route('tickets.index')
        ->with('success', 'Ticket actualizado');
}
}