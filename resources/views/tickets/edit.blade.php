
<x-app-layout>

<style>
    .edit-ticket-page {
        background: #F2F5F9;
        min-height: 100vh;
        padding: 30px 0;
    }

    .edit-ticket-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        background: #FFFFFF;
    }

    .edit-ticket-header {
        background: #0755A0;
        color: #FFFFFF;
        padding: 22px 26px;
    }

    .edit-ticket-header h3 {
        margin: 0;
        font-weight: 700;
    }

    .edit-ticket-body {
        padding: 30px;
    }

    .edit-section-title {
        color: #0755A0;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #EAF2FA;
    }

    .form-label {
        color: #334155;
        font-weight: 600;
        font-size: 14px;
    }

    .form-control,
    .form-select {
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 11px 13px;
        color: #334155;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0755A0;
        box-shadow: 0 0 0 0.2rem rgba(7, 85, 160, 0.15);
    }

    textarea.form-control {
        resize: vertical;
    }

    .edit-field-group {
        margin-bottom: 20px;
    }

    .edit-actions {
        border-top: 1px solid #E2E8F0;
        padding-top: 22px;
        margin-top: 25px;
    }

    .btn-update-ticket {
        background: #F36B21;
        color: #FFFFFF;
        border: none;
        padding: 11px 22px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-update-ticket:hover {
        background: #D95712;
        color: #FFFFFF;
    }

    .btn-cancel-ticket {
        background: #FFFFFF;
        color: #0755A0;
        border: 1px solid #0755A0;
        padding: 11px 22px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-cancel-ticket:hover {
        background: #EAF2FA;
        color: #0755A0;
    }

    .edit-ticket-alert {
        border-radius: 9px;
        border: none;
    }

    .edit-help-text {
        color: #64748B;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .edit-ticket-body {
            padding: 20px;
        }

        .edit-ticket-header {
            padding: 18px;
        }
    }
</style>

<div class="edit-ticket-page">

    <div class="container">

        <div class="card edit-ticket-card shadow-sm">

            <!-- ENCABEZADO -->

            <div class="edit-ticket-header d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>
                    <h3>
                        <i class="bi bi-pencil-square me-2"></i>
                        Editar Ticket
                    </h3>

                    <small class="opacity-75">
                        Modificación de la solicitud #{{ $ticket->id }}
                    </small>
                </div>

                <span class="badge bg-light text-primary px-3 py-2">
                    Ticket #{{ $ticket->id }}
                </span>

            </div>

            <div class="edit-ticket-body">

                <!-- ERRORES DE VALIDACIÓN -->

                @if ($errors->any())

                    <div class="alert alert-danger edit-ticket-alert">

                        <strong>
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            No se pudo actualizar el ticket.
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('tickets.update', $ticket) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <!-- INFORMACIÓN GENERAL -->

                    <h5 class="edit-section-title">
                        <i class="bi bi-file-text me-2"></i>
                        Información del Ticket
                    </h5>

                    <div class="edit-field-group">

                        <label class="form-label">
                            Título
                        </label>

                        <input
                            type="text"
                            name="titulo"
                            class="form-control"
                            value="{{ old('titulo', $ticket->titulo) }}"
                            placeholder="Escribe el título del ticket"
                            required
                        >

                    </div>

                    <div class="edit-field-group">

                        <label class="form-label">
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            class="form-control"
                            rows="5"
                            placeholder="Describe el problema reportado..."
                            required
                        >{{ old('descripcion', $ticket->descripcion) }}</textarea>

                    </div>

                    <div class="edit-field-group">

                        <label class="form-label">
                            Categoría
                        </label>

                        <select name="categoria" class="form-select">

                            <option value="hardware"
                                {{ old('categoria', $ticket->categoria) == 'hardware' ? 'selected' : '' }}>
                                Hardware
                            </option>

                            <option value="software"
                                {{ old('categoria', $ticket->categoria) == 'software' ? 'selected' : '' }}>
                                Software
                            </option>

                            <option value="impresora"
                                {{ old('categoria', $ticket->categoria) == 'impresora' ? 'selected' : '' }}>
                                Impresora
                            </option>

                            <option value="red"
                                {{ old('categoria', $ticket->categoria) == 'red' ? 'selected' : '' }}>
                                Red
                            </option>

                            <option value="otro"
                                {{ old('categoria', $ticket->categoria) == 'otro' ? 'selected' : '' }}>
                                Otro
                            </option>

                        </select>

                    </div>

                    <!-- SEGUIMIENTO -->

                    <h5 class="edit-section-title mt-4">
                        <i class="bi bi-clipboard-check me-2"></i>
                        Seguimiento del Ticket
                    </h5>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="edit-field-group">

                                <label class="form-label">
                                    Estado
                                </label>

                                <select name="estado" class="form-select">

                                    <option value="nuevo"
                                        {{ old('estado', $ticket->estado) == 'nuevo' ? 'selected' : '' }}>
                                        Nuevo
                                    </option>

                                    <option value="proceso"
                                        {{ old('estado', $ticket->estado) == 'proceso' ? 'selected' : '' }}>
                                        En proceso
                                    </option>

                                    <option value="revision"
                                        {{ old('estado', $ticket->estado) == 'revision' ? 'selected' : '' }}>
                                        En revisión
                                    </option>

                                    <option value="resuelto"
                                        {{ old('estado', $ticket->estado) == 'resuelto' ? 'selected' : '' }}>
                                        Resuelto
                                    </option>

                                    <option value="cerrado"
                                        {{ old('estado', $ticket->estado) == 'cerrado' ? 'selected' : '' }}>
                                        Cerrado
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="edit-field-group">

                                <label class="form-label">
                                    Prioridad
                                </label>

                                <select name="prioridad" class="form-select">

                                    <option value="baja"
                                        {{ old('prioridad', $ticket->prioridad) == 'baja' ? 'selected' : '' }}>
                                        Baja
                                    </option>

                                    <option value="media"
                                        {{ old('prioridad', $ticket->prioridad) == 'media' ? 'selected' : '' }}>
                                        Media
                                    </option>

                                    <option value="alta"
                                        {{ old('prioridad', $ticket->prioridad) == 'alta' ? 'selected' : '' }}>
                                        Alta
                                    </option>

                                    <option value="critica"
                                        {{ old('prioridad', $ticket->prioridad) == 'critica' ? 'selected' : '' }}>
                                        Crítica
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <!-- ASIGNACIÓN -->

                    <h5 class="edit-section-title mt-4">
                        <i class="bi bi-person-gear me-2"></i>
                        Asignación de Técnico
                    </h5>

                    <div class="edit-field-group">

                        <label class="form-label">
                            Técnico asignado
                        </label>

                        <select name="tecnico_id" class="form-select">

                            <option value="">
                                Sin asignar
                            </option>

                            @foreach($tecnicos as $tecnico)

                                <option
                                    value="{{ $tecnico->id }}"
                                    {{ old('tecnico_id', $ticket->tecnico_id) == $tecnico->id ? 'selected' : '' }}
                                >
                                    {{ $tecnico->name }}
                                </option>

                            @endforeach

                        </select>

                        <div class="edit-help-text">
                            Selecciona al técnico responsable de atender esta solicitud.
                        </div>

                    </div>

                    <!-- BOTONES -->

                    <div class="edit-actions d-flex gap-2 flex-wrap">

                        <button type="submit" class="btn btn-update-ticket">

                            <i class="bi bi-check-circle me-1"></i>
                            Actualizar Ticket

                        </button>

                        <a href="{{ route('tickets.index') }}"
                           class="btn btn-cancel-ticket">

                            <i class="bi bi-x-circle me-1"></i>
                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
