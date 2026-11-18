
<x-app-layout>

<div class="container py-4">

    <style>
        .servicio-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            background: #FFFFFF;
        }

        .servicio-header {
            background: #0755A0;
            color: #FFFFFF;
            padding: 20px 25px;
        }

        .servicio-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .seccion-titulo {
            color: #0755A0;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #F2F5F9;
        }

        .dato-card {
            background: #F2F5F9;
            border-radius: 10px;
            padding: 15px;
            height: 100%;
        }

        .dato-label {
            display: block;
            color: #64748B;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .dato-valor {
            color: #1E293B;
            font-size: 15px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .bloque-informacion {
            padding: 17px;
            border-radius: 10px;
            margin-bottom: 20px;
            white-space: pre-line;
        }

        .problema {
            background: #FFF1F0;
            border-left: 4px solid #DC3545;
            color: #842029;
        }

        .diagnostico {
            background: #FFF8E6;
            border-left: 4px solid #F36B21;
            color: #664D03;
        }

        .solucion {
            background: #EAF7EF;
            border-left: 4px solid #198754;
            color: #146C43;
        }

        .btn-volver {
            background: #F36B21;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-volver:hover {
            background: #D95712;
            color: #FFFFFF;
        }

        .seccion {
            margin-bottom: 28px;
        }

        @media (max-width: 576px) {
            .servicio-header {
                gap: 15px;
                align-items: flex-start !important;
                flex-direction: column;
            }
        }
    </style>

    <div class="card shadow-sm servicio-card">

        <!-- ENCABEZADO -->
        <div class="servicio-header d-flex justify-content-between align-items-center">

            <h4>
                <i class="bi bi-tools me-2"></i>
                Servicio Rápido #{{ $servicios_rapido->id }}
            </h4>

            <a href="{{ route('servicios-rapidos.index') }}"
               class="btn-volver">
                <i class="bi bi-arrow-left me-1"></i>
                Volver
            </a>

        </div>

        <div class="card-body p-4">

            <!-- DATOS DEL SOLICITANTE -->
            <div class="seccion">

                <h5 class="seccion-titulo">
                    <i class="bi bi-person-fill me-2"></i>
                    Datos del Solicitante
                </h5>

                <div class="row g-3">

                    <div class="col-md-3">
                        <div class="dato-card">
                            <span class="dato-label">Nombre</span>
                            <div class="dato-valor">
                                {{ $servicios_rapido->nombre_usuario }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dato-card">
                            <span class="dato-label">Departamento</span>
                            <div class="dato-valor">
                                {{ $servicios_rapido->departamento ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dato-card">
                            <span class="dato-label">Extensión</span>
                            <div class="dato-valor">
                                {{ $servicios_rapido->extension ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dato-card">
                            <span class="dato-label">Ubicación</span>
                            <div class="dato-valor">
                                {{ $servicios_rapido->ubicacion ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- EQUIPO -->
            <div class="seccion">

                <h5 class="seccion-titulo">
                    <i class="bi bi-pc-display me-2"></i>
                    Equipo
                </h5>

                <div class="dato-card">
                    <span class="dato-label">Tipo de equipo</span>
                    <div class="dato-valor">
                        {{ $servicios_rapido->tipo_equipo }}
                    </div>
                </div>

            </div>

            <!-- PROBLEMA -->
            <div class="seccion">

                <h5 class="seccion-titulo">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Problema Reportado
                </h5>

                <div class="bloque-informacion problema">
                    {{ $servicios_rapido->problema }}
                </div>

            </div>

            <!-- DIAGNÓSTICO -->
            <div class="seccion">

                <h5 class="seccion-titulo">
                    <i class="bi bi-search me-2"></i>
                    Diagnóstico
                </h5>

                <div class="bloque-informacion diagnostico">
                    {{ $servicios_rapido->diagnostico ?? 'No registrado' }}
                </div>

            </div>

            <!-- SOLUCIÓN -->
            <div class="seccion">

                <h5 class="seccion-titulo">
                    <i class="bi bi-check-circle me-2"></i>
                    Solución Aplicada
                </h5>

                <div class="bloque-informacion solucion">
                    {{ $servicios_rapido->solucion }}
                </div>

            </div>

            <!-- RESULTADO Y TÉCNICO -->
            <div class="seccion">

                <h5 class="seccion-titulo">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Resultado del Servicio
                </h5>

                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="dato-card">
                            <span class="dato-label">Resultado</span>

                            <div class="mt-2">

                                @if($servicios_rapido->resultado == 'resuelto')

                                    <span class="badge bg-success px-3 py-2">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Resuelto
                                    </span>

                                @elseif($servicios_rapido->resultado == 'parcial')

                                    <span class="badge text-dark px-3 py-2"
                                          style="background: #FFC107;">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        Parcial
                                    </span>

                                @else

                                    <span class="badge bg-danger px-3 py-2">
                                        <i class="bi bi-clock me-1"></i>
                                        Pendiente
                                    </span>

                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dato-card">
                            <span class="dato-label">Tiempo invertido</span>
                            <div class="dato-valor">
                                <i class="bi bi-clock me-1"></i>
                                {{ $servicios_rapido->tiempo_invertido }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dato-card">
                            <span class="dato-label">Técnico responsable</span>
                            <div class="dato-valor">
                                <i class="bi bi-person-gear me-1"></i>
                                {{ $servicios_rapido->tecnico->name ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- FECHAS -->
            <div class="seccion mb-0">

                <h5 class="seccion-titulo">
                    <i class="bi bi-calendar3 me-2"></i>
                    Información de Registro
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="dato-card">
                            <span class="dato-label">Fecha de registro</span>
                            <div class="dato-valor">
                                {{ $servicios_rapido->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="dato-card">
                            <span class="dato-label">Última actualización</span>
                            <div class="dato-valor">
                                {{ $servicios_rapido->updated_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
