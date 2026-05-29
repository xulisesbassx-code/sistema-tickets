<x-app-layout>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">

        <h2>Tickets</h2>

        <a href="{{ route('tickets.create') }}"
           class="btn btn-primary">

           Nuevo Ticket

        </a>

    </div>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            @foreach($tickets as $ticket)

            <tr>

                <td>{{ $ticket->id }}</td>

                <td>{{ $ticket->titulo }}</td>

                <td>{{ $ticket->categoria }}</td>

                <td>{{ $ticket->prioridad }}</td>

                <td>{{ $ticket->estado }}</td>

                <td>{{ $ticket->usuario->name }}</td>

                <td>

                    <a href="{{ route('tickets.show', $ticket) }}"
                       class="btn btn-info btn-sm">

                       Ver

                    </a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</x-app-layout>