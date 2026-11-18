
<x-app-layout>

<div class="container py-4">

    <style>
        .editar-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .editar-header {
            background: #0755A0;
            color: #FFFFFF;
            padding: 20px 25px;
        }

        .editar-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .seccion-titulo {
            color: #0755A0;
            font-size: 16px;
            font-weight: 700;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #F2F5F9;
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

        .btn-guardar {
            background: #F36B21;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-guardar:hover {
            background: #D95712;
            color: #FFFFFF;
        }

        .btn-cancelar {
            background: #0755A0;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-cancelar:hover {
            background: #06447F;
            color: #FFFFFF;
        }

        .form-text {
            color: #64748B;
        }
    </style>

    <div class="card shadow-sm editar-card">

        <!-- ENCABEZADO -->
        <div class="editar-header">

            <h4>
                <i class="bi bi-pencil-square me-2"></i>
                Editar Servicio #{{ $servicios_rapido->id }}
            </h4>

            <p class="mb-0 mt-2" style="opacity: .85;">
                Modifica la información del servicio rápido registrado.
            </p>

        </div>

        <div class="card-body p-4">

            <form action="{{ route('servicios-rapidos.update', $servicios_rapido) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- DATOS DEL SERVICIO -->
                <div class="mb-4">

                    <h5 class="seccion-titulo">
                        <i class="bi bi-person-fill me-2"></i>
                        Datos del Solicitante
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Nombre de usuario
                            </label>

                            <input
                                type="text"
                                name="nombre_usuario"
                                class="form-control"
                                value="{{ old('nombre_usuario', $servicios_rapido->nombre_usuario) }}"
                                required
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Departamento
                            </label>

                            <input
                                type="text"
                                name="departamento"
                                class="form-control"
                                value="{{ old('departamento', $servicios_rapido->departamento) }}"
                            >

                        </div>

                    </div>

                </div>

                <!-- PROBLEMA -->
                <div class="mb-4">

                    <h5 class="seccion-titulo">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Problema Reportado
                    </h5>

                    <label class="form-label">
                        Descripción del problema
                    </label>

                    <textarea
                        name="problema"
                        class="form-control"
                        rows="3"
                        required
                    >{{ old('problema', $servicios_rapido->problema) }}</textarea>

                </div>

                <!-- DIAGNÓSTICO -->
                <div class="mb-4">

                    <h5 class="seccion-titulo">
                        <i class="bi bi-search me-2"></i>
                        Diagnóstico Técnico
                    </h5>

                    <label class="form-label">
                        Diagnóstico
                    </label>

                    <textarea
                        name="diagnostico"
                        class="form-control"
                        rows="3"
                    >{{ old('diagnostico', $servicios_rapido->diagnostico) }}</textarea>

                </div>

                <!-- SOLUCIÓN -->
                <div class="mb-4">

                    <h5 class="seccion-titulo">
                        <i class="bi bi-check-circle me-2"></i>
                        Solución Aplicada
                    </h5>

                    <label class="form-label">
                        Descripción de la solución
                    </label>

                    <textarea
                        name="solucion"
                        class="form-control"
                        rows="4"
                        required
                    >{{ old('solucion', $servicios_rapido->solucion) }}</textarea>

                </div>

                <!-- RESULTADO -->
                <div class="mb-4">

                    <h5 class="seccion-titulo">
                        <i class="bi bi-clipboard-check me-2"></i>
                        Resultado del Servicio
                    </h5>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Resultado
                            </label>

                            <select
                                name="resultado"
                                class="form-select"
                            >

                                <option value="resuelto"
                                    {{ old('resultado', $servicios_rapido->resultado) == 'resuelto' ? 'selected' : '' }}>
                                    Resuelto
                                </option>

                                <option value="parcial"
                                    {{ old('resultado', $servicios_rapido->resultado) == 'parcial' ? 'selected' : '' }}>
                                    Parcial
                                </option>

                                <option value="pendiente"
                                    {{ old('resultado', $servicios_rapido->resultado) == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Tiempo invertido
                            </label>

                            <input
                                type="text"
                                name="tiempo_invertido"
                                class="form-control"
                                value="{{ old('tiempo_invertido', $servicios_rapido->tiempo_invertido) }}"
                            >

                        </div>

                    </div>

                </div>

                <!-- BOTONES -->
                <div class="d-flex flex-wrap gap-2 justify-content-end pt-3 border-top">

                    <a href="{{ route('servicios-rapidos.index') }}"
                       class="btn btn-cancelar">

                        <i class="bi bi-x-circle me-1"></i>
                        Cancelar

                    </a>

                    <button type="submit" class="btn btn-guardar">

                        <i class="bi bi-save me-1"></i>
                        Guardar Cambios

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>
