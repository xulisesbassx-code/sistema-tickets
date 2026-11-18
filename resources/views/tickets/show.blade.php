
<x-app-layout>

<style>
    .ticket-detail-page {
        background: #F2F5F9;
        min-height: 100vh;
        padding: 30px 0;
    }

    .ticket-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        background: #FFFFFF;
    }

    .ticket-card-header {
        background: #0755A0;
        color: #FFFFFF;
        padding: 20px 25px;
    }

    .ticket-card-header h4 {
        margin: 0;
        font-weight: 700;
    }

    .ticket-card-body {
        padding: 28px;
    }

    .ticket-title {
        color: #0755A0;
        font-weight: 700;
    }

    .section-title {
        color: #0755A0;
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 20px;
    }

    .info-item {
        background: #F2F5F9;
        border-radius: 10px;
        padding: 16px;
        height: 100%;
        border-left: 4px solid #0755A0;
    }

    .info-label {
        color: #64748B;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .info-value {
        color: #1E293B;
        font-weight: 600;
    }

    .ticket-divider {
        border-color: #E2E8F0;
        margin: 25px 0;
    }

    .btn-ticket-primary {
        background: #0755A0;
        color: #FFFFFF;
        border: none;
    }

    .btn-ticket-primary:hover {
        background: #06447F;
        color: #FFFFFF;
    }

    .btn-ticket-orange {
        background: #F36B21;
        color: #FFFFFF;
        border: none;
    }

    .btn-ticket-orange:hover {
        background: #D95712;
        color: #FFFFFF;
    }

    .btn-ticket-secondary {
        background: #FFFFFF;
        color: #0755A0;
        border: 1px solid #FFFFFF;
    }

    .btn-ticket-secondary:hover {
        background: #EAF2FA;
        color: #0755A0;
    }

    .ticket-badge {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-estado {
        background: #DBEAFE;
        color: #0755A0;
    }

    .badge-critica {
        background: #FEE2E2;
        color: #B91C1C;
    }

    .badge-alta {
        background: #FFEDD5;
        color: #C2410C;
    }

    .badge-media {
        background: #DBEAFE;
        color: #1D4ED8;
    }

    .badge-baja {
        background: #DCFCE7;
        color: #15803D;
    }

    .comment-card,
    .history-card {
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        background: #FFFFFF;
    }

    .comment-author {
        color: #0755A0;
        font-weight: 700;
    }

    .comment-date {
        color: #64748B;
        font-size: 12px;
    }

    .comment-message {
        color: #334155;
        white-space: pre-line;
    }

    .history-card {
        border-left: 4px solid #F36B21;
    }

    .form-control:focus {
        border-color: #0755A0;
        box-shadow: 0 0 0 0.2rem rgba(7, 85, 160, 0.15);
    }

    .empty-message {
        background: #EAF2FA;
        color: #0755A0;
        border: none;
        border-radius: 10px;
        padding: 16px;
    }

    @media (max-width: 768px) {
        .ticket-card-body {
            padding: 18px;
        }

        .ticket-card-header {
            padding: 16px;
        }
    }
</style>

<div class="ticket-detail-page">

    <div class="container">

        <!-- INFORMACIÓN DEL TICKET -->

        <div class="card ticket-card shadow-sm mb-5">

            <div class="ticket-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

                <h4>
                    <i class="bi bi-ticket-detailed me-2"></i>
                    Ticket #{{ $ticket->id }}
                </h4>

                <a href="{{ route('tickets.index') }}"
                   class="btn btn-ticket-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Volver
                </a>

            </div>

            <div class="ticket-card-body">

                <h3 class="ticket-title">
                    {{ $ticket->titulo }}
                </h3>

                <p class="text-muted mt-3 mb-4">
                    {{ $ticket->descripcion }}
                </p>

                <hr class="ticket-divider">

                <h5 class="section-title">
                    <i class="bi bi-info-circle me-2"></i>
                    Información General
                </h5>

                <div class="row g-3">

                    <div class="col-md-3">

                        <div class="info-item">

                            <div class="info-label">Categoría</div>

                            <div class="info-value">
                                {{ ucfirst($ticket->categoria) }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="info-item">

                            <div class="info-label">Estado</div>

                            <span class="ticket-badge badge-estado">
                                {{ ucfirst($ticket->estado) }}
                            </span>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="info-item">

                            <div class="info-label">Prioridad</div>

                            @if($ticket->prioridad == 'critica')
                                <span class="ticket-badge badge-critica">
                                    Crítica
                                </span>
                            @elseif($ticket->prioridad == 'alta')
                                <span class="ticket-badge badge-alta">
                                    Alta
                                </span>
                            @elseif($ticket->prioridad == 'media')
                                <span class="ticket-badge badge-media">
                                    Media
                                </span>
                            @else
                                <span class="ticket-badge badge-baja">
                                    Baja
                                </span>
                            @endif

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="info-item">

                            <div class="info-label">Fecha de creación</div>

                            <div class="info-value">
                                {{ $ticket->created_at->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    </div>

                </div>

                @if(auth()->user()->rol != 'usuario')

                    <hr class="ticket-divider">

                    <h5 class="section-title">
                        <i class="bi bi-people me-2"></i>
                        Datos de seguimiento
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-4">

                            <div class="info-item">

                                <div class="info-label">Usuario que reportó</div>

                                <div class="info-value">
                                    {{ $ticket->usuario->name ?? 'N/A' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-item">

                                <div class="info-label">Técnico asignado</div>

                                <div class="info-value">
                                    {{ $ticket->tecnico->name ?? 'Sin asignar' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-item">

                                <div class="info-label">Última actualización</div>

                                <div class="info-value">
                                    {{ $ticket->updated_at->format('d/m/Y H:i') }}
                                </div>

                            </div>

                        </div>

                    </div>

                @endif

                @if(auth()->user()->rol != 'usuario')

                    <hr class="ticket-divider">

                    <a href="{{ route('tickets.edit', $ticket) }}"
                       class="btn btn-ticket-orange">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar Ticket
                    </a>

                @endif

            </div>

        </div>


        <!-- COMENTARIOS -->

        <div class="mb-5">

            <h4 class="section-title">
                <i class="bi bi-chat-left-text me-2"></i>
                Comentarios del Ticket
            </h4>

            <div class="card ticket-card shadow-sm">

                <div class="ticket-card-body">

                    <form action="{{ route('comentarios.store', $ticket) }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Nuevo comentario
                            </label>

                            <textarea
                                name="mensaje"
                                class="form-control"
                                rows="3"
                                placeholder="Escribe un comentario..."
                                required
                            ></textarea>

                        </div>

                        <button class="btn btn-ticket-primary">

                            <i class="bi bi-send me-1"></i>
                            Agregar Comentario

                        </button>

                    </form>

                </div>

            </div>

            <div class="mt-3">

                @forelse($ticket->comentarios as $comentario)

                    <div class="comment-card shadow-sm mb-3">

                        <div class="p-3">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <strong class="comment-author">
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ $comentario->usuario->name }}
                                </strong>

                                <small class="comment-date">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $comentario->created_at->format('d/m/Y H:i') }}
                                </small>

                            </div>

                            <hr class="ticket-divider">

                            <p class="comment-message mb-0">
                                {{ $comentario->mensaje }}
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="empty-message">
                        <i class="bi bi-info-circle me-2"></i>
                        No hay comentarios registrados.
                    </div>

                @endforelse

            </div>

        </div>


        <!-- HISTORIAL -->

        @if(auth()->user()->rol != 'usuario')

            <div class="mb-4">

                <h4 class="section-title">
                    <i class="bi bi-clock-history me-2"></i>
                    Historial del Ticket
                </h4>

                @forelse($ticket->historial->sortByDesc('created_at') as $registro)

                    <div class="history-card shadow-sm mb-3">

                        <div class="p-3">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <strong class="text-dark">
                                    <i class="bi bi-arrow-right-circle me-1"
                                       style="color: #F36B21;"></i>
                                    {{ $registro->accion }}
                                </strong>

                                <small class="comment-date">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $registro->created_at->format('d/m/Y H:i') }}
                                </small>

                            </div>

                            <hr class="ticket-divider">

                            <p class="mb-2">
                                {{ $registro->descripcion }}
                            </p>

                            <small class="text-muted">
                                <i class="bi bi-person me-1"></i>
                                Realizado por:
                                {{ $registro->usuario->name ?? 'Sistema' }}
                            </small>

                        </div>

                    </div>

                @empty

                    <div class="alert alert-secondary">
                        No hay historial registrado para este ticket.
                    </div>

                @endforelse

            </div>

        @endif

    </div>

</div>

</x-app-layout>
