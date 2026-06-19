<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">

            <h4>
                Editar Servicio #{{ $servicios_rapido->id }}
            </h4>

        </div>

        <div class="card-body">

            <form action="{{ route('servicios-rapidos.update', $servicios_rapido) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Nombre Usuario
                    </label>

                    <input
                        type="text"
                        name="nombre_usuario"
                        class="form-control"
                        value="{{ $servicios_rapido->nombre_usuario }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Departamento
                    </label>

                    <input
                        type="text"
                        name="departamento"
                        class="form-control"
                        value="{{ $servicios_rapido->departamento }}"
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Problema
                    </label>

                    <textarea
                        name="problema"
                        class="form-control"
                        rows="3"
                        required>{{ $servicios_rapido->problema }}</textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Diagnóstico
                    </label>

                    <textarea
                        name="diagnostico"
                        class="form-control"
                        rows="3">{{ $servicios_rapido->diagnostico }}</textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Solución
                    </label>

                    <textarea
                        name="solucion"
                        class="form-control"
                        rows="4"
                        required>{{ $servicios_rapido->solucion }}</textarea>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">
                            Resultado
                        </label>

                        <select
                            name="resultado"
                            class="form-select">

                            <option value="resuelto"
                                {{ $servicios_rapido->resultado == 'resuelto' ? 'selected' : '' }}>
                                Resuelto
                            </option>

                            <option value="parcial"
                                {{ $servicios_rapido->resultado == 'parcial' ? 'selected' : '' }}>
                                Parcial
                            </option>

                            <option value="pendiente"
                                {{ $servicios_rapido->resultado == 'pendiente' ? 'selected' : '' }}>
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
                            value="{{ $servicios_rapido->tiempo_invertido }}"
                        >

                    </div>

                </div>

                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-success">

                        Guardar Cambios

                    </button>

                    <a href="{{ route('servicios-rapidos.index') }}"
                       class="btn btn-secondary">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>
