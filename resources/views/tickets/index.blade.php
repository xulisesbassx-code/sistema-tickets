<x-app-layout>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Gestión de Tickets</h2>

        <a href="{{ route('tickets.create') }}"
           class="btn btn-primary">
            Nuevo Ticket
        </a>

    </div>

    <!-- FILTROS -->

    <div class="card shadow mb-4">

        <div class="card-header">
            Buscar y Filtrar
        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('tickets.index') }}">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label>Título</label>

                        <input
                            type="text"
                            name="titulo"
                            class="form-control"
                            value="{{ request('titulo') }}"
                            placeholder="Buscar ticket..."
                        >

                    </div>

                    <div class="col-md-3 mb-3">

                        <label>Estado</label>

                        <select
                            name="estado"
                            class="form-select"
                        >

                            <option value="">
                                Todos
                            </option>

                            <option value="nuevo"
                                {{ request('estado') == 'nuevo' ? 'selected' : '' }}>
                                Nuevo
                            </option>

                            <option value="proceso"
                                {{ request('estado') == 'proceso' ? 'selected' : '' }}>
                                En Proceso
                            </option>

                            <option value="revision"
                                {{ request('estado') == 'revision' ? 'selected' : '' }}>
                                Revisión
                            </option>

                            <option value="resuelto"
                                {{ request('estado') == 'resuelto' ? 'selected' : '' }}>
                                Resuelto
                            </option>

                            <option value="cerrado"
                                {{ request('estado') == 'cerrado' ? 'selected' : '' }}>
                                Cerrado
                            </option>

                        </select>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label>Prioridad</label>

                        <select
                            name="prioridad"
                            class="form-select"
                        >

                            <option value="">
                                Todas
                            </option>

                            <option value="baja"
                                {{ request('prioridad') == 'baja' ? 'selected' : '' }}>
                                Baja
                            </option>

                            <option value="media"
                                {{ request('prioridad') == 'media' ? 'selected' : '' }}>
                                Media
                            </option>

                            <option value="alta"
                                {{ request('prioridad') == 'alta' ? 'selected' : '' }}>
                                Alta
                            </option>

                            <option value="critica"
                                {{ request('prioridad') == 'critica' ? 'selected' : '' }}>
                                Crítica
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2 d-flex align-items-end mb-3">

                        <button
                            type="submit"
                            class="btn btn-success me-2"
                        >
                            Buscar
                        </button>

                        <a href="{{ route('tickets.index') }}"
                           class="btn btn-secondary">
                            Limpiar
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- TABLA -->

    <div class="card shadow">

        <div class="card-header">
            Lista de Tickets
        </div>

        <div class="card-body">

            <table class="table table-hover table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th>Técnico</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($tickets as $ticket)

                    <tr>

                        <td>{{ $ticket->id }}</td>

                        <td>{{ $ticket->titulo }}</td>

                        <td>{{ ucfirst($ticket->categoria) }}</td>

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

                            @if($ticket->estado == 'nuevo')

                                <span class="badge bg-primary">
                                    Nuevo
                                </span>

                            @elseif($ticket->estado == 'proceso')

                                <span class="badge bg-warning text-dark">
                                    En Proceso
                                </span>

                            @elseif($ticket->estado == 'revision')

                                <span class="badge bg-info">
                                    Revisión
                                </span>

                            @elseif($ticket->estado == 'resuelto')

                                <span class="badge bg-success">
                                    Resuelto
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Cerrado
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $ticket->usuario->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $ticket->tecnico->name ?? 'Sin asignar' }}
                        </td>

                        <td>

                            <a href="{{ route('tickets.show', $ticket) }}"
                               class="btn btn-info btn-sm">
                                Ver
                            </a>

                            <a href="{{ route('tickets.edit', $ticket) }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">
                            No se encontraron tickets.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>