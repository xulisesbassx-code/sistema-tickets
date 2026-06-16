<x-app-layout>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            @if(auth()->user()->rol == 'usuario')
                Mis Solicitudes
            @else
                Gestión de Tickets
            @endif
        </h2>

        <a href="{{ route('tickets.create') }}"
           class="btn btn-primary">

            @if(auth()->user()->rol == 'usuario')
                Solicitar Soporte
            @else
                Nuevo Ticket
            @endif

        </a>

    </div>

    @if(auth()->user()->rol != 'usuario')

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

                        <select name="estado" class="form-select">

                            <option value="">Todos</option>

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

                        <select name="prioridad" class="form-select">

                            <option value="">Todas</option>

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

                        <button type="submit"
                                class="btn btn-success me-2">
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

    @endif

    <!-- TABLA -->

    <div class="card shadow">

        <div class="card-header">

            @if(auth()->user()->rol == 'usuario')
                Mis Solicitudes
            @else
                Lista de Tickets
            @endif

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

                        @if(auth()->user()->rol != 'usuario')
                            <th>Usuario</th>
                            <th>Técnico</th>
                        @endif

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
                                <span class="badge bg-danger">Crítica</span>

                            @elseif($ticket->prioridad == 'alta')
                                <span class="badge bg-warning text-dark">Alta</span>

                            @elseif($ticket->prioridad == 'media')
                                <span class="badge bg-primary">Media</span>

                            @else
                                <span class="badge bg-success">Baja</span>
                            @endif

                        </td>

                        <td>

                            @if($ticket->estado == 'nuevo')
                                <span class="badge bg-primary">Nuevo</span>

                            @elseif($ticket->estado == 'proceso')
                                <span class="badge bg-warning text-dark">En Proceso</span>

                            @elseif($ticket->estado == 'revision')
                                <span class="badge bg-info">Revisión</span>

                            @elseif($ticket->estado == 'resuelto')
                                <span class="badge bg-success">Resuelto</span>

                            @else
                                <span class="badge bg-secondary">Cerrado</span>
                            @endif

                        </td>

                        @if(auth()->user()->rol != 'usuario')

                        <td>
                            {{ $ticket->usuario->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $ticket->tecnico->name ?? 'Sin asignar' }}
                        </td>

                        @endif

                    <td>

    <a href="{{ route('tickets.show', $ticket) }}"
       class="btn btn-info btn-sm">
        Ver
    </a>

    @if(auth()->user()->rol != 'usuario')

        <a href="{{ route('tickets.edit', $ticket) }}"
           class="btn btn-warning btn-sm">
            Editar
        </a>

    @endif

    @if(auth()->user()->rol == 'admin')

        <form action="{{ route('tickets.destroy', $ticket) }}"
              method="POST"
              style="display:inline;">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('¿Cerrar este ticket?')">
                Cerrar
            </button>

        </form>

    @endif

</td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center">

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
