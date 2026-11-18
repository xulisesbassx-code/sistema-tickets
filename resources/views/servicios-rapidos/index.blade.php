
<x-app-layout>

<style>
    .quick-services-page {
        background: #F2F5F9;
        min-height: 100vh;
        padding: 30px 0;
    }

    .quick-services-title {
        color: #0755A0;
        font-weight: 700;
        margin: 0;
    }

    .quick-services-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        background: #FFFFFF;
    }

    .quick-services-header {
        background: #0755A0;
        color: #FFFFFF;
        padding: 18px 22px;
        font-weight: 600;
    }

    .quick-services-body {
        padding: 22px;
    }

    .btn-new-service {
        background: #F36B21;
        color: #FFFFFF;
        border: none;
        padding: 11px 18px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-new-service:hover {
        background: #D95712;
        color: #FFFFFF;
    }

    .quick-services-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 13px;
        white-space: nowrap;
    }

    .quick-services-table thead th {
        background: #EAF2FA;
        color: #0755A0;
        font-weight: 700;
        padding: 15px 12px;
        border-bottom: 2px solid #0755A0;
        vertical-align: middle;
    }

    .quick-services-table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #E2E8F0;
    }

    .quick-services-table tbody tr:hover {
        background: #F2F7FC;
    }

    .service-id {
        color: #0755A0;
        font-weight: 700;
    }

    .service-status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-resolved {
        background: #DCFCE7;
        color: #15803D;
    }

    .status-partial {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-pending {
        background: #FEE2E2;
        color: #B91C1C;
    }

    .btn-service-action {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        margin: 2px;
    }

    .btn-service-view {
        background: #0755A0;
        color: #FFFFFF;
    }

    .btn-service-view:hover {
        background: #06447F;
        color: #FFFFFF;
    }

    .btn-service-edit {
        background: #FFF0E6;
        color: #D95712;
        border: 1px solid #F36B21;
    }

    .btn-service-edit:hover {
        background: #F36B21;
        color: #FFFFFF;
    }

    .btn-service-delete {
        background: #FEE2E2;
        color: #B91C1C;
        border: 1px solid #FECACA;
    }

    .btn-service-delete:hover {
        background: #DC2626;
        color: #FFFFFF;
    }

    .service-empty {
        padding: 35px !important;
        text-align: center;
        color: #64748B !important;
    }

    .table-responsive {
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .quick-services-body {
            padding: 14px;
        }

        .quick-services-heading {
            align-items: flex-start !important;
            gap: 15px;
            flex-direction: column;
        }
    }
</style>

<div class="quick-services-page">

    <div class="container">

        <!-- ENCABEZADO -->

        <div class="d-flex justify-content-between align-items-center mb-4 quick-services-heading">

            <div>
                <h2 class="quick-services-title">
                    <i class="bi bi-lightning-charge-fill me-2"></i>
                    Servicios Rápidos
                </h2>

                <p class="text-muted mb-0 mt-1">
                    Registro y seguimiento de atenciones directas
                </p>
            </div>

            <a href="{{ route('servicios-rapidos.create') }}"
               class="btn btn-new-service">

                <i class="bi bi-plus-circle me-1"></i>
                Nuevo Servicio

            </a>

        </div>

        <!-- TABLA DE SERVICIOS -->

        <div class="card quick-services-card shadow-sm">

            <div class="quick-services-header">

                <i class="bi bi-clipboard-data me-2"></i>
                Registro de Atenciones Directas

            </div>

            <div class="quick-services-body">

                <div class="table-responsive">

                    <table class="table quick-services-table mb-0">

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Solicitante</th>
                                <th>Departamento</th>
                                <th>Equipo</th>
                                <th>Resultado</th>
                                <th>Técnico</th>
                                <th class="text-center">Acciones</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($servicios as $servicio)

                                <tr>

                                    <td class="service-id">
                                        #{{ $servicio->id }}
                                    </td>

                                    <td>
                                        {{ $servicio->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $servicio->nombre_usuario }}
                                    </td>

                                    <td>
                                        {{ $servicio->departamento }}
                                    </td>

                                    <td>
                                        {{ $servicio->tipo_equipo }}
                                    </td>

                                    <td>

                                        @if($servicio->resultado == 'resuelto')

                                            <span class="service-status status-resolved">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Resuelto
                                            </span>

                                        @elseif($servicio->resultado == 'parcial')

                                            <span class="service-status status-partial">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                Parcial
                                            </span>

                                        @else

                                            <span class="service-status status-pending">
                                                <i class="bi bi-clock me-1"></i>
                                                Pendiente
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $servicio->tecnico->name ?? 'N/A' }}
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route('servicios-rapidos.show', $servicio) }}"
                                           class="btn-service-action btn-service-view">

                                            <i class="bi bi-eye me-1"></i>
                                            Ver

                                        </a>

                                        <a href="{{ route('servicios-rapidos.edit', $servicio) }}"
                                           class="btn-service-action btn-service-edit">

                                            <i class="bi bi-pencil-square me-1"></i>
                                            Editar

                                        </a>

                                        @if(auth()->user()->rol == 'admin')

                                            <form action="{{ route('servicios-rapidos.destroy', $servicio) }}"
                                                  method="POST"
                                                  style="display:inline;">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn-service-action btn-service-delete"
                                                        onclick="return confirm('¿Eliminar este servicio?')">

                                                    <i class="bi bi-trash me-1"></i>
                                                    Eliminar

                                                </button>

                                            </form>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="service-empty">

                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                                        <strong>No hay servicios registrados.</strong>

                                        <p class="mb-0 mt-1">
                                            Los servicios rápidos aparecerán aquí cuando sean registrados.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
