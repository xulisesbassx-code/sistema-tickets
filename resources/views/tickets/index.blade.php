
<x-app-layout>

<style>
    .tickets-page {
        padding: 30px 0 45px;
        color: #243247;
    }

    .tickets-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 15px;
        flex-wrap: wrap;
    }

    .tickets-heading h2 {
        color: #17365d;
        font-size: 27px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .tickets-heading p {
        color: #7b8797;
        font-size: 14px;
        margin: 0;
    }

    .btn-new-ticket {
        background: #0755a0;
        color: white;
        padding: 12px 20px;
        border-radius: 9px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .btn-new-ticket:hover {
        background: #063e78;
        color: white;
    }

    .tickets-panel {
        background: white;
        border-radius: 13px;
        border: 1px solid #e4eaf1;
        box-shadow: 0 5px 20px rgba(30, 50, 80, .06);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .panel-title {
        padding: 19px 23px;
        border-bottom: 1px solid #edf0f4;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .panel-title h5 {
        font-size: 16px;
        font-weight: 750;
        color: #17365d;
        margin: 0;
    }

    .panel-content {
        padding: 22px;
    }

    .tickets-page label {
        font-size: 13px;
        font-weight: 650;
        color: #44546a;
        margin-bottom: 7px;
    }

    .tickets-page .form-control,
    .tickets-page .form-select {
        border: 1px solid #dce3eb;
        border-radius: 8px;
        min-height: 43px;
        font-size: 13px;
        box-shadow: none;
    }

    .tickets-page .form-control:focus,
    .tickets-page .form-select:focus {
        border-color: #0755a0;
        box-shadow: 0 0 0 3px rgba(7,85,160,.10);
    }

    .btn-search-ticket {
        background: #0755a0;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 700;
        min-height: 42px;
    }

    .btn-search-ticket:hover {
        background: #063e78;
        color: white;
    }

    .btn-reset-ticket {
        background: #edf1f5;
        color: #45566c;
        border: 1px solid #dce3eb;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 13px;
        text-decoration: none;
        min-height: 42px;
        display: inline-flex;
        align-items: center;
    }

    .btn-reset-ticket:hover {
        background: #dfe6ee;
        color: #26384d;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .tickets-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        white-space: nowrap;
    }

    .tickets-table thead th {
        background: #f1f5f9;
        color: #52647b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 800;
        padding: 16px;
        border-bottom: 1px solid #e1e8f0;
    }

    .tickets-table tbody td {
        padding: 16px;
        font-size: 13px;
        color: #46566c;
        border-bottom: 1px solid #edf1f5;
        vertical-align: middle;
    }

    .tickets-table tbody tr:hover {
        background: #f8fbff;
    }

    .tickets-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ticket-id {
        color: #0755a0;
        font-weight: 800;
    }

    .ticket-name {
        color: #263d59;
        font-weight: 700;
        white-space: normal;
        min-width: 150px;
    }

    .ticket-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 750;
    }

    .priority-critica { background: #fee2e2; color: #b42318; }
    .priority-alta { background: #ffedd5; color: #a34c00; }
    .priority-media { background: #dbeafe; color: #0755a0; }
    .priority-baja { background: #dcfce7; color: #167342; }

    .status-nuevo { background: #dbeafe; color: #0755a0; }
    .status-proceso { background: #ffedd5; color: #a34c00; }
    .status-revision { background: #cffafe; color: #08718d; }
    .status-resuelto { background: #dcfce7; color: #167342; }
    .status-cerrado { background: #e9edf2; color: #596579; }

    .ticket-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .ticket-actions .btn {
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        padding: 7px 11px;
    }

    .btn-ticket-view {
        background: #e3efff;
        color: #0755a0;
        border: 1px solid #cbdff8;
    }

    .btn-ticket-view:hover {
        background: #0755a0;
        color: white;
    }

    .btn-ticket-edit {
        background: #fff0d9;
        color: #9a5800;
        border: 1px solid #f6d9aa;
    }

    .btn-ticket-edit:hover {
        background: #f36b21;
        color: white;
    }

    .btn-ticket-close {
        background: #fee2e2;
        color: #b42318;
        border: 1px solid #fecaca;
    }

    .btn-ticket-close:hover {
        background: #dc3545;
        color: white;
    }

    .empty-tickets {
        text-align: center;
        padding: 45px 15px !important;
        color: #8793a3 !important;
    }

    @media(max-width:768px) {
        .tickets-page {
            padding: 20px 0;
        }

        .tickets-heading h2 {
            font-size: 23px;
        }

        .panel-content {
            padding: 15px;
        }
    }
</style>

<div class="container tickets-page">

    <!-- ENCABEZADO -->

    <div class="tickets-heading">

        <div>
            <h2>
                @if(auth()->user()->rol == 'usuario')
                    Mis Solicitudes
                @else
                    Gestión de Tickets
                @endif
            </h2>

            <p>
                @if(auth()->user()->rol == 'usuario')
                    Consulta y administra tus solicitudes de soporte.
                @else
                    Administra las incidencias y solicitudes de soporte técnico.
                @endif
            </p>
        </div>

        <a href="{{ route('tickets.create') }}" class="btn-new-ticket">
            @if(auth()->user()->rol == 'usuario')
                + Solicitar Soporte
            @else
                + Nuevo Ticket
            @endif
        </a>

    </div>

    <!-- FILTROS -->

    @if(auth()->user()->rol != 'usuario')

    <div class="tickets-panel">

        <div class="panel-title">
            <h5>Buscar y filtrar tickets</h5>
        </div>

        <div class="panel-content">

            <form method="GET" action="{{ route('tickets.index') }}">

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

                            <option value="nuevo" {{ request('estado') == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="proceso" {{ request('estado') == 'proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="revision" {{ request('estado') == 'revision' ? 'selected' : '' }}>Revisión</option>
                            <option value="resuelto" {{ request('estado') == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                            <option value="cerrado" {{ request('estado') == 'cerrado' ? 'selected' : '' }}>Cerrado</option>

                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Prioridad</label>

                        <select name="prioridad" class="form-select">

                            <option value="">Todas</option>

                            <option value="baja" {{ request('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                            <option value="media" {{ request('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                            <option value="alta" {{ request('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                            <option value="critica" {{ request('prioridad') == 'critica' ? 'selected' : '' }}>Crítica</option>

                        </select>
                    </div>

                    <div class="col-md-2 mb-3 d-flex align-items-end gap-2">

                        <button type="submit" class="btn-search-ticket">
                            Buscar
                        </button>

                        <a href="{{ route('tickets.index') }}" class="btn-reset-ticket">
                            Limpiar
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    @endif

    <!-- TABLA -->

    <div class="tickets-panel">

        <div class="panel-title">
            <h5>
                @if(auth()->user()->rol == 'usuario')
                    Mis Solicitudes
                @else
                    Lista de Tickets
                @endif
            </h5>
        </div>

        <div class="table-responsive">

            <table class="tickets-table">

                <thead>
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

                        <td>
                            <span class="ticket-id">#{{ $ticket->id }}</span>
                        </td>

                        <td>
                            <div class="ticket-name">
                                {{ $ticket->titulo }}
                            </div>
                        </td>

                        <td>
                            {{ ucfirst($ticket->categoria) }}
                        </td>

                        <td>

                            @if($ticket->prioridad == 'critica')
                                <span class="ticket-badge priority-critica">Crítica</span>

                            @elseif($ticket->prioridad == 'alta')
                                <span class="ticket-badge priority-alta">Alta</span>

                            @elseif($ticket->prioridad == 'media')
                                <span class="ticket-badge priority-media">Media</span>

                            @else
                                <span class="ticket-badge priority-baja">Baja</span>
                            @endif

                        </td>

                        <td>

                            @if($ticket->estado == 'nuevo')
                                <span class="ticket-badge status-nuevo">Nuevo</span>

                            @elseif($ticket->estado == 'proceso')
                                <span class="ticket-badge status-proceso">En Proceso</span>

                            @elseif($ticket->estado == 'revision')
                                <span class="ticket-badge status-revision">Revisión</span>

                            @elseif($ticket->estado == 'resuelto')
                                <span class="ticket-badge status-resuelto">Resuelto</span>

                            @else
                                <span class="ticket-badge status-cerrado">Cerrado</span>
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

                            <div class="ticket-actions">

                                <a href="{{ route('tickets.show', $ticket) }}"
                                   class="btn btn-ticket-view">
                                    Ver
                                </a>

                                @if(auth()->user()->rol != 'usuario')

                                    <a href="{{ route('tickets.edit', $ticket) }}"
                                       class="btn btn-ticket-edit">
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
                                                class="btn btn-ticket-close"
                                                onclick="return confirm('¿Cerrar este ticket?')">
                                            Cerrar
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="empty-tickets">
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
