
<x-app-layout>

<style>
    .quick-create-page {
        background: #F2F5F9;
        min-height: 100vh;
        padding: 30px 0;
    }

    .quick-create-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        background: #FFFFFF;
    }

    .quick-create-header {
        background: #0755A0;
        color: #FFFFFF;
        padding: 22px 26px;
    }

    .quick-create-header h4 {
        margin: 0;
        font-weight: 700;
    }

    .quick-create-body {
        padding: 30px;
    }

    .quick-section-title {
        color: #0755A0;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 11px;
        border-bottom: 2px solid #EAF2FA;
    }

    .quick-section-title i {
        color: #F36B21;
    }

    .quick-form-label {
        color: #334155;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .quick-create-body .form-control,
    .quick-create-body .form-select {
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 11px 13px;
        color: #334155;
    }

    .quick-create-body .form-control:focus,
    .quick-create-body .form-select:focus {
        border-color: #0755A0;
        box-shadow: 0 0 0 0.2rem rgba(7, 85, 160, 0.15);
    }

    .quick-create-body textarea {
        resize: vertical;
    }

    .quick-field {
        margin-bottom: 20px;
    }

    .quick-form-divider {
        border-color: #E2E8F0;
        margin: 28px 0;
    }

    .quick-help-text {
        color: #64748B;
        font-size: 12px;
        margin-top: 5px;
    }

    .quick-create-actions {
        border-top: 1px solid #E2E8F0;
        padding-top: 24px;
        margin-top: 25px;
    }

    .btn-save-service {
        background: #F36B21;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 11px 22px;
        font-weight: 600;
    }

    .btn-save-service:hover {
        background: #D95712;
        color: #FFFFFF;
    }

    .btn-cancel-service {
        background: #FFFFFF;
        color: #0755A0;
        border: 1px solid #0755A0;
        border-radius: 8px;
        padding: 11px 22px;
        font-weight: 600;
    }

    .btn-cancel-service:hover {
        background: #EAF2FA;
        color: #0755A0;
    }

    @media (max-width: 768px) {
        .quick-create-body {
            padding: 20px;
        }

        .quick-create-header {
            padding: 18px;
        }
    }
</style>

<div class="quick-create-page">

    <div class="container">

        <div class="card quick-create-card shadow-sm">

            <!-- ENCABEZADO -->

            <div class="quick-create-header">

                <h4>
                    <i class="bi bi-lightning-charge-fill me-2"></i>
                    Registrar Servicio Rápido
                </h4>

                <small class="opacity-75">
                    Registro de atenciones técnicas directas
                </small>

            </div>

            <div class="quick-create-body">

                <form action="{{ route('servicios-rapidos.store') }}"
                      method="POST">

                    @csrf

                    <!-- DATOS DEL SOLICITANTE -->

                    <h5 class="quick-section-title">
                        <i class="bi bi-person-circle me-2"></i>
                        Datos del Solicitante
                    </h5>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="quick-field">

                                <label class="quick-form-label">
                                    Nombre del Usuario
                                </label>

                                <input
                                    type="text"
                                    name="nombre_usuario"
                                    class="form-control"
                                    value="{{ old('nombre_usuario') }}"
                                    placeholder="Nombre completo del solicitante"
                                    required
                                >

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="quick-field">

                                <label class="quick-form-label">
                                    Departamento
                                </label>

                                <input
                                    type="text"
                                    name="departamento"
                                    class="form-control"
                                    value="{{ old('departamento') }}"
                                    placeholder="Departamento"
                                >

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="quick-field">

                                <label class="quick-form-label">
                                    Extensión
                                </label>

                                <input
                                    type="text"
                                    name="extension"
                                    class="form-control"
                                    value="{{ old('extension') }}"
                                    placeholder="Número de extensión"
                                >

                            </div>

                        </div>

                    </div>

                    <div class="quick-field">

                        <label class="quick-form-label">
                            Ubicación
                        </label>

                        <input
                            type="text"
                            name="ubicacion"
                            class="form-control"
                            value="{{ old('ubicacion') }}"
                            placeholder="Ejemplo: Cubículo 12"
                        >

                    </div>

                    <!-- INFORMACIÓN DEL EQUIPO -->

                    <hr class="quick-form-divider">

                    <h5 class="quick-section-title">
                        <i class="bi bi-pc-display me-2"></i>
                        Información del Equipo
                    </h5>

                    <div class="quick-field">

                        <label class="quick-form-label">
                            Tipo de Equipo
                        </label>

                        <select
                            name="tipo_equipo"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Seleccione un equipo...
                            </option>

                            <option value="PC"
                                {{ old('tipo_equipo') == 'PC' ? 'selected' : '' }}>
                                PC
                            </option>

                            <option value="Laptop"
                                {{ old('tipo_equipo') == 'Laptop' ? 'selected' : '' }}>
                                Laptop
                            </option>

                            <option value="Impresora"
                                {{ old('tipo_equipo') == 'Impresora' ? 'selected' : '' }}>
                                Impresora
                            </option>

                            <option value="Escaner"
                                {{ old('tipo_equipo') == 'Escaner' ? 'selected' : '' }}>
                                Escáner
                            </option>

                            <option value="Telefono IP"
                                {{ old('tipo_equipo') == 'Telefono IP' ? 'selected' : '' }}>
                                Teléfono IP
                            </option>

                            <option value="Servidor"
                                {{ old('tipo_equipo') == 'Servidor' ? 'selected' : '' }}>
                                Servidor
                            </option>

                            <option value="Otro"
                                {{ old('tipo_equipo') == 'Otro' ? 'selected' : '' }}>
                                Otro
                            </option>

                        </select>

                    </div>

                    <!-- ATENCIÓN REALIZADA -->

                    <hr class="quick-form-divider">

                    <h5 class="quick-section-title">
                        <i class="bi bi-tools me-2"></i>
                        Atención Realizada
                    </h5>

                    <div class="quick-field">

                        <label class="quick-form-label">
                            Problema Reportado
                        </label>

                        <textarea
                            name="problema"
                            class="form-control"
                            rows="3"
                            placeholder="Describe el problema que reportó el usuario..."
                            required
                        >{{ old('problema') }}</textarea>

                    </div>

                    <div class="quick-field">

                        <label class="quick-form-label">
                            Diagnóstico
                        </label>

                        <textarea
                            name="diagnostico"
                            class="form-control"
                            rows="3"
                            placeholder="Describe el diagnóstico técnico..."
                        >{{ old('diagnostico') }}</textarea>

                    </div>

                    <div class="quick-field">

                        <label class="quick-form-label">
                            Solución Aplicada
                        </label>

                        <textarea
                            name="solucion"
                            class="form-control"
                            rows="4"
                            placeholder="Describe las acciones realizadas para solucionar el problema..."
                            required
                        >{{ old('solucion') }}</textarea>

                    </div>

                    <!-- RESULTADO Y TIEMPO -->

                    <div class="row">

                        <div class="col-md-6">

                            <div class="quick-field">

                                <label class="quick-form-label">
                                    Resultado
                                </label>

                                <select
                                    name="resultado"
                                    class="form-select"
                                    required
                                >

                                    <option value="resuelto"
                                        {{ old('resultado', 'resuelto') == 'resuelto' ? 'selected' : '' }}>
                                        Resuelto
                                    </option>

                                    <option value="parcial"
                                        {{ old('resultado') == 'parcial' ? 'selected' : '' }}>
                                        Parcial
                                    </option>

                                    <option value="pendiente"
                                        {{ old('resultado') == 'pendiente' ? 'selected' : '' }}>
                                        Pendiente
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="quick-field">

                                <label class="quick-form-label">
                                    Tiempo Invertido
                                </label>

                                <select
                                    name="tiempo_invertido"
                                    class="form-select"
                                    required
                                >

                                    <option value="5 min"
                                        {{ old('tiempo_invertido') == '5 min' ? 'selected' : '' }}>
                                        5 min
                                    </option>

                                    <option value="10 min"
                                        {{ old('tiempo_invertido') == '10 min' ? 'selected' : '' }}>
                                        10 min
                                    </option>

                                    <option value="15 min"
                                        {{ old('tiempo_invertido') == '15 min' ? 'selected' : '' }}>
                                        15 min
                                    </option>

                                    <option value="30 min"
                                        {{ old('tiempo_invertido') == '30 min' ? 'selected' : '' }}>
                                        30 min
                                    </option>

                                    <option value="45 min"
                                        {{ old('tiempo_invertido') == '45 min' ? 'selected' : '' }}>
                                        45 min
                                    </option>

                                    <option value="60 min"
                                        {{ old('tiempo_invertido') == '60 min' ? 'selected' : '' }}>
                                        60 min
                                    </option>

                                    <option value="Mas de 1 hora"
                                        {{ old('tiempo_invertido') == 'Mas de 1 hora' ? 'selected' : '' }}>
                                        Más de 1 hora
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <!-- BOTONES -->

                    <div class="quick-create-actions d-flex gap-2 flex-wrap">

                        <button
                            type="submit"
                            class="btn btn-save-service"
                        >

                            <i class="bi bi-check-circle me-1"></i>
                            Guardar Servicio

                        </button>

                        <a href="{{ route('servicios-rapidos.index') }}"
                           class="btn btn-cancel-service">

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
