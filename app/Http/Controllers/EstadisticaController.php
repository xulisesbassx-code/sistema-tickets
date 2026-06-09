<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class EstadisticaController extends Controller
{
    public function index()
    {
        $nuevo = Ticket::where('estado', 'nuevo')->count();
        $proceso = Ticket::where('estado', 'proceso')->count();
        $revision = Ticket::where('estado', 'revision')->count();
        $resuelto = Ticket::where('estado', 'resuelto')->count();
        $cerrado = Ticket::where('estado', 'cerrado')->count();

        return view('estadisticas.index', compact(
            'nuevo',
            'proceso',
            'revision',
            'resuelto',
            'cerrado'
        ));
    }
}