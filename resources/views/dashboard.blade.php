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
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th>Fecha</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($ultimosTickets as $ticket)

                    <tr>

                        <td>{{ $ticket->id }}</td>

                        <td>{{ $ticket->titulo }}</td>

                        <td>

                            @if($ticket->estado == 'nuevo')

                                <span class="badge bg-primary">
                                    Nuevo
                                </span>

                            @elseif($ticket->estado == 'proceso')

                                <span class="badge bg-warning text-dark">
                                    Proceso
                                </span>

                            @elseif($ticket->estado == 'resuelto')

                                <span class="badge bg-success">
                                    Resuelto
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ $ticket->estado }}
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

                            @else

                                <span class="badge bg-info">
                                    {{ $ticket->prioridad }}
                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $ticket->created_at->format('d/m/Y H:i') }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>