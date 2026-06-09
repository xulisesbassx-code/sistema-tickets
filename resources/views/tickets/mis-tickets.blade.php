<x-app-layout>

<div class="container mt-4">

    <h2>Mis Tickets Asignados</h2>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse($tickets as $ticket)

            <tr>

                <td>{{ $ticket->id }}</td>

                <td>{{ $ticket->titulo }}</td>

                <td>{{ $ticket->estado }}</td>

                <td>{{ $ticket->prioridad }}</td>

                <td>

                    <a href="{{ route('tickets.show', $ticket) }}"
                       class="btn btn-info btn-sm">

                        Ver

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5">
                    No tienes tickets asignados.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

</x-app-layout>