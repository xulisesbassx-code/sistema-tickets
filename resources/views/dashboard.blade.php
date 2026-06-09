<x-app-layout>

<div class="container mt-4">

    <h2 class="mb-4">
        Dashboard de Soporte Técnico
    </h2>

    <div class="row">

        <div class="col-md-3 mb-3">

            <div class="card bg-primary text-white shadow">

                <div class="card-body">

                    <h5>Tickets Nuevos</h5>

                    <h2>{{ $ticketsNuevos }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-warning text-dark shadow">

                <div class="card-body">

                    <h5>En Proceso</h5>

                    <h2>{{ $ticketsProceso }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-success text-white shadow">

                <div class="card-body">

                    <h5>Resueltos</h5>

                    <h2>{{ $ticketsResueltos }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-danger text-white shadow">

                <div class="card-body">

                    <h5>Críticos</h5>

                    <h2>{{ $ticketsCriticos }}</h2>

                </div>

            </div>

        </div>

        @if(auth()->user()->rol == 'admin')

        <div class="col-md-3 mb-3">

            <div class="card bg-dark text-white shadow">

                <div class="card-body">

                    <h5>Total Usuarios</h5>

                    <h2>{{ $totalUsuarios }}</h2>

                </div>

            </div>

        </div>

        @endif

    </div>

    <div class="card shadow mt-4">

        <div class="card-header">

            Últimos Tickets

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Título</th>
                        <th>Usuario</th>
                        <th>Técnico</th>
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th>Fecha</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($ultimosTickets as $ticket)

                    <tr>

                        <td>{{ $ticket->id }}</td>

                        <td>{{ $ticket->titulo }}</td>

                        <td>
                            {{ $ticket->usuario->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $ticket->tecnico->name ?? 'Sin asignar' }}
                        </td>

                        <td>

                            @if($ticket->estado == 'nuevo')

                                <span class="badge bg-primary">
                                    Nuevo
                                </span>

                            @elseif($ticket->estado == 'proceso')

                                <span class="badge bg-warning text-dark">
                                    En proceso
                                </span>

                            @elseif($ticket->estado == 'resuelto')

                                <span class="badge bg-success">
                                    Resuelto
                                </span>

                            @elseif($ticket->estado == 'revision')

                                <span class="badge bg-info">
                                    Revisión
                                </span>

                            @elseif($ticket->estado == 'cerrado')

                                <span class="badge bg-secondary">
                                    Cerrado
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($ticket->prioridad == 'critica')

                                <span class="badge bg-danger">
                                    Crítica
                                </span>

                            @elseif($ticket->prioridad == 'alta')

                                <span class="badge bg-warning text-dark">
                                    Alta
                                </span>

                            @elseif($ticket->prioridad == 'media')

                                <span class="badge bg-primary">
                                    Media
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Baja
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center">
                            No hay tickets registrados.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>