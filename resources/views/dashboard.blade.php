
<x-app-layout>

<style>
    .dashboard-page {
        background: #f3f6fa;
        min-height: 100vh;
        padding: 28px 0 45px;
    }

    .dashboard-page .container {
        max-width: 1500px;
    }

    .dashboard-header {
        background: linear-gradient(120deg, #0755a0, #063b73);
        border-radius: 14px;
        padding: 28px 30px;
        color: white;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        border-bottom: 5px solid #f36b21;
    }

    .dashboard-header h2 {
        font-size: 25px;
        font-weight: 700;
        margin: 0 0 7px;
    }

    .dashboard-header p {
        margin: 0;
        color: #e1edfa;
        font-size: 14px;
    }

    .dashboard-header .header-label {
        display: inline-block;
        background: rgba(255,255,255,.15);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        margin-bottom: 12px;
        letter-spacing: .5px;
    }

    .section-heading {
        color: #173653;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 17px;
    }

    .metric-card {
        background: #fff;
        border: 1px solid #e7edf4;
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        min-height: 130px;
        position: relative;
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease;
        box-shadow: 0 3px 12px rgba(15, 43, 70, .04);
    }

    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(15, 43, 70, .10);
    }

    .metric-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--metric-color);
    }

    .metric-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .metric-title {
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .metric-icon {
        width: 39px;
        height: 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: var(--metric-bg);
        color: var(--metric-color);
        font-size: 19px;
        font-weight: 700;
    }

    .metric-number {
        font-size: 30px;
        font-weight: 750;
        color: #183653;
        margin-top: 10px;
        line-height: 1.2;
    }

    .metric-blue {
        --metric-color: #0755a0;
        --metric-bg: #e8f2fc;
    }

    .metric-orange {
        --metric-color: #f36b21;
        --metric-bg: #fff0e7;
    }

    .metric-green {
        --metric-color: #15966a;
        --metric-bg: #e6f7ef;
    }

    .metric-red {
        --metric-color: #dc3545;
        --metric-bg: #fdebed;
    }

    .metric-cyan {
        --metric-color: #0891b2;
        --metric-bg: #e5f7fb;
    }

    .metric-gray {
        --metric-color: #64748b;
        --metric-bg: #edf1f5;
    }

    .tickets-card {
        background: white;
        border: 1px solid #e7edf4;
        border-radius: 13px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(15, 43, 70, .04);
    }

    .tickets-card-header {
        padding: 20px 23px;
        border-bottom: 1px solid #e9eef4;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .tickets-card-header h3 {
        color: #173653;
        font-size: 17px;
        font-weight: 700;
        margin: 0;
    }

    .tickets-card-header span {
        color: #8492a6;
        font-size: 12px;
    }

    .tickets-table-wrapper {
        overflow-x: auto;
    }

    .tickets-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
        margin: 0;
    }

    .tickets-table thead th {
        background: #f7f9fc;
        color: #64748b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 700;
        padding: 15px 17px;
        border-bottom: 1px solid #e9eef4;
        white-space: nowrap;
    }

    .tickets-table tbody td {
        padding: 15px 17px;
        color: #475569;
        font-size: 13px;
        border-bottom: 1px solid #f0f3f7;
        vertical-align: middle;
    }

    .tickets-table tbody tr:last-child td {
        border-bottom: none;
    }

    .tickets-table tbody tr:hover {
        background: #f8fbff;
    }

    .ticket-id {
        color: #0755a0;
        font-weight: 700;
    }

    .ticket-title {
        color: #173653;
        font-weight: 600;
    }

    .ticket-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-new {
        color: #0755a0;
        background: #e8f2fc;
    }

    .status-process {
        color: #a65b00;
        background: #fff1d6;
    }

    .status-resolved {
        color: #11734e;
        background: #e3f7ed;
    }

    .status-review {
        color: #087e9b;
        background: #e2f7fc;
    }

    .status-closed {
        color: #64748b;
        background: #edf1f5;
    }

    .priority-critical {
        color: #bd2636;
        background: #fde8eb;
    }

    .priority-high {
        color: #a65b00;
        background: #fff1d6;
    }

    .priority-medium {
        color: #0755a0;
        background: #e8f2fc;
    }

    .priority-low {
        color: #11734e;
        background: #e3f7ed;
    }

    .empty-tickets {
        padding: 38px 15px !important;
        text-align: center;
        color: #94a3b8 !important;
    }

    @media (max-width: 768px) {
        .dashboard-page {
            padding: 18px 0 30px;
        }

        .dashboard-header {
            padding: 22px 20px;
        }

        .dashboard-header h2 {
            font-size: 21px;
        }

        .metric-card {
            min-height: 115px;
            padding: 16px;
        }

        .metric-number {
            font-size: 26px;
        }

        .tickets-card-header {
            padding: 17px;
        }
    }
</style>

<div class="dashboard-page">
    <div class="container">

        {{-- ENCABEZADO --}}
        <div class="dashboard-header">
            <span class="header-label">GRUPO IT · SOPORTE TÉCNICO</span>

            <h2>Dashboard de Soporte Técnico</h2>

            <p>
                Bienvenido, {{ auth()->user()->name }}.
                Aquí puedes consultar el resumen de actividades del sistema.
            </p>
        </div>

        {{-- INDICADORES --}}
        <h3 class="section-heading">Resumen general</h3>

        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="metric-card metric-blue">
                    <div class="metric-top">
                        <span class="metric-title">Tickets nuevos</span>
                        <div class="metric-icon">+</div>
                    </div>
                    <div class="metric-number">{{ $ticketsNuevos }}</div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="metric-card metric-orange">
                    <div class="metric-top">
                        <span class="metric-title">En proceso</span>
                        <div class="metric-icon">↻</div>
                    </div>
                    <div class="metric-number">{{ $ticketsProceso }}</div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="metric-card metric-green">
                    <div class="metric-top">
                        <span class="metric-title">Resueltos</span>
                        <div class="metric-icon">✓</div>
                    </div>
                    <div class="metric-number">{{ $ticketsResueltos }}</div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="metric-card metric-red">
                    <div class="metric-top">
                        <span class="metric-title">Tickets críticos</span>
                        <div class="metric-icon">!</div>
                    </div>
                    <div class="metric-number">{{ $ticketsCriticos }}</div>
                </div>
            </div>

            @if(auth()->user()->rol == 'admin')

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card metric-gray">
                        <div class="metric-top">
                            <span class="metric-title">Tickets cerrados</span>
                            <div class="metric-icon">■</div>
                        </div>
                        <div class="metric-number">{{ $ticketsCerrados }}</div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card metric-blue">
                        <div class="metric-top">
                            <span class="metric-title">Total de usuarios</span>
                            <div class="metric-icon">U</div>
                        </div>
                        <div class="metric-number">{{ $totalUsuarios }}</div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card metric-cyan">
                        <div class="metric-top">
                            <span class="metric-title">Servicios rápidos</span>
                            <div class="metric-icon">⚡</div>
                        </div>
                        <div class="metric-number">{{ $totalServiciosRapidos }}</div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card metric-green">
                        <div class="metric-top">
                            <span class="metric-title">Total de atenciones</span>
                            <div class="metric-icon">▤</div>
                        </div>
                        <div class="metric-number">{{ $totalAtenciones }}</div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card metric-orange">
                        <div class="metric-top">
                            <span class="metric-title">Técnicos</span>
                            <div class="metric-icon">T</div>
                        </div>
                        <div class="metric-number">{{ $totalTecnicos }}</div>
                    </div>
                </div>

            @endif

            @if(auth()->user()->rol == 'tecnico')

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card metric-cyan">
                        <div class="metric-top">
                            <span class="metric-title">Servicios rápidos</span>
                            <div class="metric-icon">⚡</div>
                        </div>
                        <div class="metric-number">{{ $serviciosRapidos }}</div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-card metric-gray">
                        <div class="metric-top">
                            <span class="metric-title">Total de atenciones</span>
                            <div class="metric-icon">▤</div>
                        </div>
                        <div class="metric-number">{{ $totalAtenciones }}</div>
                    </div>
                </div>

            @endif

        </div>

        {{-- TABLA DE TICKETS --}}
        <div class="tickets-card">

            <div class="tickets-card-header">
                <div>
                    <h3>Últimos tickets</h3>
                    <span>Actividad reciente de soporte técnico</span>
                </div>
                <span>GRUPO IT</span>
            </div>

            <div class="tickets-table-wrapper">
                <table class="tickets-table">

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
                                <td>
                                    <span class="ticket-id">#{{ $ticket->id }}</span>
                                </td>

                                <td>
                                    <span class="ticket-title">
                                        {{ $ticket->titulo }}
                                    </span>
                                </td>

                                <td>
                                    {{ $ticket->usuario->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $ticket->tecnico->name ?? 'Sin asignar' }}
                                </td>

                                <td>
                                    @if($ticket->estado == 'nuevo')
                                        <span class="ticket-badge status-new">Nuevo</span>
                                    @elseif($ticket->estado == 'proceso')
                                        <span class="ticket-badge status-process">En proceso</span>
                                    @elseif($ticket->estado == 'resuelto')
                                        <span class="ticket-badge status-resolved">Resuelto</span>
                                    @elseif($ticket->estado == 'revision')
                                        <span class="ticket-badge status-review">Revisión</span>
                                    @elseif($ticket->estado == 'cerrado')
                                        <span class="ticket-badge status-closed">Cerrado</span>
                                    @endif
                                </td>

                                <td>
                                    @if($ticket->prioridad == 'critica')
                                        <span class="ticket-badge priority-critical">Crítica</span>
                                    @elseif($ticket->prioridad == 'alta')
                                        <span class="ticket-badge priority-high">Alta</span>
                                    @elseif($ticket->prioridad == 'media')
                                        <span class="ticket-badge priority-medium">Media</span>
                                    @else
                                        <span class="ticket-badge priority-low">Baja</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="empty-tickets">
                                    No hay tickets registrados.
                                </td>
                            </tr>

                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

</x-app-layout>
