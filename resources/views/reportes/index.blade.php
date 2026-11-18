
<x-app-layout>

<div class="container py-4">

    <style>
        .reporte-titulo {
            color: #0755A0;
            font-weight: 700;
        }

        .reporte-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .reporte-header {
            background: #0755A0;
            color: #FFFFFF;
            padding: 16px 22px;
            font-weight: 700;
        }

        .seccion-header {
            background: #F2F5F9;
            color: #0755A0;
            padding: 15px 20px;
            font-weight: 700;
            border-bottom: 1px solid #E2E8F0;
        }

        .form-label {
            color: #334155;
            font-weight: 600;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            border: 1px solid #DCE3EC;
            border-radius: 8px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0755A0;
            box-shadow: 0 0 0 0.2rem rgba(7, 85, 160, 0.12);
        }

        .btn-buscar {
            background: #F36B21;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 16px;
        }

        .btn-buscar:hover {
            background: #D95712;
            color: #FFFFFF;
        }

        .indicador {
            border: none;
            border-radius: 12px;
            color: #FFFFFF;
            min-height: 135px;
            overflow: hidden;
        }

        .indicador .card-body {
            padding: 20px;
        }

        .indicador h5 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .indicador h2 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }

        .indicador-icono {
            font-size: 30px;
            opacity: .75;
        }

        .indicador-resueltos {
            background: #198754;
        }

        .indicador-abiertos {
            background: #F36B21;
        }

        .indicador-servicios {
            background: #0755A0;
        }

        .indicador-total {
            background: #334155;
        }

        .tabla-reporte {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .tabla-reporte thead th {
            background: #F2F5F9;
            color: #0755A0;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 13px;
            white-space: nowrap;
            border-bottom: 2px solid #DCE3EC;
        }

        .tabla-reporte tbody td {
            padding: 12px;
            color: #334155;
            font-size: 14px;
        }

        .tabla-reporte tbody tr:hover {
            background: #F8FAFC;
        }

        .btn-excel {
            background: #198754;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 10px 17px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-excel:hover {
            background: #146C43;
            color: #FFFFFF;
        }

        .btn-pdf {
            background: #DC3545;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 10px 17px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-pdf:hover {
            background: #BB2D3B;
            color: #FFFFFF;
        }

        .estado-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .tabla-vacia {
            padding: 25px !important;
            color: #64748B !important;
        }

        .exportacion-card {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
        }

        @media (max-width: 576px) {
            .indicador h2 {
                font-size: 26px;
            }
        }
    </style>

    <!-- TITULO -->
    <div class="mb-4">

        <h2 class="reporte-titulo">
            <i class="bi bi-bar-chart-fill me-2"></i>
            Reportes por Técnico
        </h2>

        <p class="text-muted mb-0">
            Consulta el rendimiento y las actividades realizadas por cada técnico.
        </p>

    </div>

    <!-- FILTROS -->
    <div class="card shadow-sm reporte-card mb-4">

        <div class="reporte-header">
            <i class="bi bi-funnel-fill me-2"></i>
            Filtros de búsqueda
        </div>

        <div class="card-body p-4">

            <form method="GET" action="{{ route('reportes') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-md-4">

                        <label class="form-label">
                            Técnico
                        </label>

                        <select name="tecnico_id" class="form-select">

                            <option value="">Seleccione un técnico...</option>

                            @foreach($tecnicos as $tecnico)

                                <option
                                    value="{{ $tecnico->id }}"
                                    {{ request('tecnico_id') == $tecnico->id ? 'selected' : '' }}
                                >
                                    {{ $tecnico->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Fecha de inicio
                        </label>

                        <input
                            type="date"
                            name="fecha_inicio"
                            class="form-control"
                            value="{{ request('fecha_inicio') }}"
                        >

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Fecha de fin
                        </label>

                        <input
                            type="date"
                            name="fecha_fin"
                            class="form-control"
                            value="{{ request('fecha_fin') }}"
                        >

                    </div>

                    <div class="col-md-2 d-grid">

                        <button type="submit" class="btn btn-buscar">

                            <i class="bi bi-search me-1"></i>
                            Buscar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    @if(request()->filled('tecnico_id'))

        <!-- INDICADORES -->
        <div class="row g-3 mb-4">

            <div class="col-md-3 col-sm-6">

                <div class="card indicador indicador-resueltos shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h5>Tickets Resueltos</h5>
                            <h2>{{ $ticketsResueltos }}</h2>
                        </div>

                        <i class="bi bi-check-circle-fill indicador-icono"></i>

                    </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="card indicador indicador-abiertos shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h5>Tickets Abiertos</h5>
                            <h2>{{ $ticketsAbiertos }}</h2>
                        </div>

                        <i class="bi bi-hourglass-split indicador-icono"></i>

                    </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="card indicador indicador-servicios shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h5>Servicios Rápidos</h5>
                            <h2>{{ $serviciosRapidos }}</h2>
                        </div>

                        <i class="bi bi-tools indicador-icono"></i>

                    </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="card indicador indicador-total shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h5>Total Atenciones</h5>
                            <h2>{{ $totalAtenciones }}</h2>
                        </div>

                        <i class="bi bi-clipboard-data-fill indicador-icono"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- EXPORTACIONES -->
        <div class="card shadow-sm exportacion-card mb-4">

            <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <h5 class="mb-1 reporte-titulo">
                        <i class="bi bi-download me-2"></i>
                        Exportar reporte
                    </h5>

                    <small class="text-muted">
                        Descarga los resultados de acuerdo con los filtros seleccionados.
                    </small>
                </div>

                <div class="d-flex flex-wrap gap-2">

                    <a href="{{ route('reportes.excel', request()->only([
                        'tecnico_id',
                        'fecha_inicio',
                        'fecha_fin'
                    ])) }}"
                       class="btn-excel">

                        <i class="bi bi-file-earmark-excel me-1"></i>
                        Exportar a Excel

                    </a>

                    <a href="{{ route('reportes.pdf', request()->only([
                        'tecnico_id',
                        'fecha_inicio',
                        'fecha_fin'
                    ])) }}"
                       class="btn-pdf">

                        <i class="bi bi-file-earmark-pdf me-1"></i>
                        Exportar a PDF

                    </a>

                </div>

            </div>

        </div>

        <!-- TABLA DE TICKETS -->
        <div class="card shadow-sm reporte-card mb-4">

            <div class="seccion-header">
                <i class="bi bi-ticket-detailed-fill me-2"></i>
                Tickets del Técnico
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover tabla-reporte">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                                <th>Prioridad</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($tickets as $ticket)

                                <tr>

                                    <td>
                                        <strong>#{{ $ticket->id }}</strong>
                                    </td>

                                    <td>{{ $ticket->titulo }}</td>

                                    <td>
                                        {{ $ticket->usuario->name ?? 'N/A' }}
                                    </td>

                                    <td>

                                        @if($ticket->estado == 'nuevo')

                                            <span class="estado-badge bg-primary text-white">
                                                Nuevo
                                            </span>

                                        @elseif($ticket->estado == 'proceso')

                                            <span class="estado-badge text-dark"
                                                  style="background: #FFC107;">
                                                En proceso
                                            </span>

                                        @elseif($ticket->estado == 'revision')

                                            <span class="estado-badge bg-info text-dark">
                                                En revisión
                                            </span>

                                        @elseif($ticket->estado == 'resuelto')

                                            <span class="estado-badge bg-success text-white">
                                                Resuelto
                                            </span>

                                        @elseif($ticket->estado == 'cerrado')

                                            <span class="estado-badge bg-secondary text-white">
                                                Cerrado
                                            </span>

                                        @else

                                            {{ ucfirst($ticket->estado) }}

                                        @endif

                                    </td>

                                    <td>

                                        @if($ticket->prioridad == 'critica')

                                            <span class="estado-badge bg-danger text-white">
                                                Crítica
                                            </span>

                                        @elseif($ticket->prioridad == 'alta')

                                            <span class="estado-badge text-dark"
                                                  style="background: #FFC107;">
                                                Alta
                                            </span>

                                        @elseif($ticket->prioridad == 'media')

                                            <span class="estado-badge bg-info text-dark">
                                                Media
                                            </span>

                                        @else

                                            <span class="estado-badge bg-secondary text-white">
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
                                    <td colspan="6" class="text-center tabla-vacia">

                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                        No hay tickets registrados para este técnico.

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- TABLA DE SERVICIOS RÁPIDOS -->
        <div class="card shadow-sm reporte-card mb-4">

            <div class="seccion-header">
                <i class="bi bi-tools me-2"></i>
                Servicios Rápidos del Técnico
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover tabla-reporte">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Equipo</th>
                                <th>Problema</th>
                                <th>Resultado</th>
                                <th>Tiempo invertido</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($servicios as $servicio)

                                <tr>

                                    <td>
                                        <strong>#{{ $servicio->id }}</strong>
                                    </td>

                                    <td>{{ $servicio->nombre_usuario }}</td>

                                    <td>{{ $servicio->tipo_equipo }}</td>

                                    <td>{{ $servicio->problema }}</td>

                                    <td>

                                        @if($servicio->resultado == 'resuelto')

                                            <span class="estado-badge bg-success text-white">
                                                Resuelto
                                            </span>

                                        @elseif($servicio->resultado == 'parcial')

                                            <span class="estado-badge text-dark"
                                                  style="background: #FFC107;">
                                                Parcial
                                            </span>

                                        @else

                                            <span class="estado-badge bg-danger text-white">
                                                Pendiente
                                            </span>

                                        @endif

                                    </td>

                                    <td>{{ $servicio->tiempo_invertido }}</td>

                                    <td>
                                        {{ $servicio->created_at->format('d/m/Y H:i') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center tabla-vacia">

                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                        No hay servicios rápidos registrados para este técnico.

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @else

        <!-- MENSAJE INICIAL -->
        <div class="card shadow-sm reporte-card">

            <div class="card-body text-center py-5">

                <i class="bi bi-bar-chart-line"
                   style="font-size: 55px; color: #0755A0;"></i>

                <h5 class="mt-3 reporte-titulo">
                    Consulta el rendimiento de tus técnicos
                </h5>

                <p class="text-muted mb-0">
                    Selecciona un técnico y establece un periodo de fechas
                    para generar el reporte de sus actividades.
                </p>

            </div>

        </div>

    @endif

</div>

</x-app-layout>
