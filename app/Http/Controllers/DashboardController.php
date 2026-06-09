<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ADMIN
        if ($user->rol == 'admin') {

            $ticketsNuevos = Ticket::where('estado', 'nuevo')->count();

            $ticketsProceso = Ticket::where('estado', 'proceso')->count();

            $ticketsResueltos = Ticket::where('estado', 'resuelto')->count();

            $ticketsCriticos = Ticket::where('prioridad', 'critica')->count();

            $totalUsuarios = User::count();

            $ultimosTickets = Ticket::with([
                'usuario',
                'tecnico'
            ])
            ->latest()
            ->take(5)
            ->get();

            return view('dashboard', compact(
                'ticketsNuevos',
                'ticketsProceso',
                'ticketsResueltos',
                'ticketsCriticos',
                'totalUsuarios',
                'ultimosTickets'
            ));
        }

        // TECNICO
        if ($user->rol == 'tecnico') {

            $ticketsNuevos = Ticket::where('tecnico_id', $user->id)
                ->where('estado', 'nuevo')
                ->count();

            $ticketsProceso = Ticket::where('tecnico_id', $user->id)
                ->where('estado', 'proceso')
                ->count();

            $ticketsResueltos = Ticket::where('tecnico_id', $user->id)
                ->where('estado', 'resuelto')
                ->count();

            $ticketsCriticos = Ticket::where('tecnico_id', $user->id)
                ->where('prioridad', 'critica')
                ->count();

            $ultimosTickets = Ticket::with([
                'usuario',
                'tecnico'
            ])
            ->where('tecnico_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

            return view('dashboard', compact(
                'ticketsNuevos',
                'ticketsProceso',
                'ticketsResueltos',
                'ticketsCriticos',
                'ultimosTickets'
            ));
        }

        // USUARIO
        $ticketsNuevos = Ticket::where('user_id', $user->id)
            ->where('estado', 'nuevo')
            ->count();

        $ticketsProceso = Ticket::where('user_id', $user->id)
            ->where('estado', 'proceso')
            ->count();

        $ticketsResueltos = Ticket::where('user_id', $user->id)
            ->where('estado', 'resuelto')
            ->count();

        $ticketsCriticos = Ticket::where('user_id', $user->id)
            ->where('prioridad', 'critica')
            ->count();

        $ultimosTickets = Ticket::with([
            'usuario',
            'tecnico'
        ])
        ->where('user_id', $user->id)
        ->latest()
        ->take(5)
        ->get();

        return view('dashboard', compact(
            'ticketsNuevos',
            'ticketsProceso',
            'ticketsResueltos',
            'ticketsCriticos',
            'ultimosTickets'
        ));
    }
}