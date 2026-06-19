<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between">

            <h4>
                Servicio Rápido #{{ $servicios_rapido->id }}
            </h4>

            <a href="{{ route('servicios-rapidos.index') }}"
               class="btn btn-secondary">

                Volver

            </a>

        </div>

        <div class="card-body">

            <h5 class="mb-3">
                Datos del Solicitante
            </h5>

            <div class="row">

                <div class="col-md-3">

                    <strong>Nombre:</strong>

                    <br>

                    {{ $servicios_rapido->nombre_usuario }}

                </div>

                <div class="col-md-3">

                    <strong>Departamento:</strong>

                    <br>

                    {{ $servicios_rapido->departamento ?? 'N/A' }}

                </div>

                <div class="col-md-3">

                    <strong>Extensión:</strong>

                    <br>

                    {{ $servicios_rapido->extension ?? 'N/A' }}

                </div>

                <div class="col-md-3">

                    <strong>Ubicación:</strong>

                    <br>

                    {{ $servicios_rapido->ubicacion ?? 'N/A' }}

                </div>

            </div>

            <hr>

            <h5>
                Equipo
            </h5>

            <p>

                <strong>Tipo:</strong>

                {{ $servicios_rapido->tipo_equipo }}

            </p>

            <hr>

            <h5>
                Problema Reportado
            </h5>

            <div class="alert alert-danger">

                {{ $servicios_rapido->problema }}

            </div>

            <h5>
                Diagnóstico
            </h5>

            <div class="alert alert-warning">

                {{ $servicios_rapido->diagnostico ?? 'No registrado' }}

            </div>

            <h5>
                Solución Aplicada
            </h5>

            <div class="alert alert-success">

                {{ $servicios_rapido->solucion }}

            </div>

            <hr>

            <div class="row">

                <div class="col-md-4">

                    <strong>Resultado:</strong>

                    <br>

                    @if($servicios_rapido->resultado == 'resuelto')

                        <span class="badge bg-success">
                            Resuelto
                        </span>

                    @elseif($servicios_rapido->resultado == 'parcial')

                        <span class="badge bg-warning text-dark">
                            Parcial
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Pendiente
                        </span>

                    @endif

                </div>

                <div class="col-md-4">

                    <strong>Tiempo invertido:</strong>

                    <br>

                    {{ $servicios_rapido->tiempo_invertido }}

                </div>

                <div class="col-md-4">

                    <strong>Técnico:</strong>

                    <br>

                    {{ $servicios_rapido->tecnico->name ?? 'N/A' }}

                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-6">

                    <strong>Fecha de registro:</strong>

                    <br>

                    {{ $servicios_rapido->created_at->format('d/m/Y H:i') }}

                </div>

                <div class="col-md-6">

                    <strong>Última actualización:</strong>

                    <br>

                    {{ $servicios_rapido->updated_at->format('d/m/Y H:i') }}

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
