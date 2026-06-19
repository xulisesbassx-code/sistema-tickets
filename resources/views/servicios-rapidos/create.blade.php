<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">

            <h4>
                Registrar Servicio Rápido
            </h4>

        </div>

        <div class="card-body">

            <form action="{{ route('servicios-rapidos.store') }}"
                  method="POST">

                @csrf

                <h5 class="mb-3">
                    Datos del Solicitante
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre del Usuario
                        </label>

                        <input
                            type="text"
                            name="nombre_usuario"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Departamento
                        </label>

                        <input
                            type="text"
                            name="departamento"
                            class="form-control"
                        >

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Extensión
                        </label>

                        <input
                            type="text"
                            name="extension"
                            class="form-control"
                        >

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Ubicación
                    </label>

                    <input
                        type="text"
                        name="ubicacion"
                        class="form-control"
                        placeholder="Ejemplo: Cubículo 12"
                    >

                </div>

                <hr>

                <h5 class="mb-3">
                    Información del Equipo
                </h5>

                <div class="mb-3">

                    <label class="form-label">
                        Tipo de Equipo
                    </label>

                    <select
                        name="tipo_equipo"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione...
                        </option>

                        <option value="PC">
                            PC
                        </option>

                        <option value="Laptop">
                            Laptop
                        </option>

                        <option value="Impresora">
                            Impresora
                        </option>

                        <option value="Escaner">
                            Escáner
                        </option>

                        <option value="Telefono IP">
                            Teléfono IP
                        </option>

                        <option value="Servidor">
                            Servidor
                        </option>

                        <option value="Otro">
                            Otro
                        </option>

                    </select>

                </div>

                <hr>

                <h5 class="mb-3">
                    Atención Realizada
                </h5>

                <div class="mb-3">

                    <label class="form-label">
                        Problema Reportado
                    </label>

                    <textarea
                        name="problema"
                        class="form-control"
                        rows="3"
                        required
                    ></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Diagnóstico
                    </label>

                    <textarea
                        name="diagnostico"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Solución Aplicada
                    </label>

                    <textarea
                        name="solucion"
                        class="form-control"
                        rows="4"
                        required
                    ></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Resultado
                        </label>

                        <select
                            name="resultado"
                            class="form-select"
                            required
                        >

                            <option value="resuelto">
                                Resuelto
                            </option>

                            <option value="parcial">
                                Parcial
                            </option>

                            <option value="pendiente">
                                Pendiente
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tiempo Invertido
                        </label>

                        <select
                            name="tiempo_invertido"
                            class="form-select"
                            required
                        >

                            <option value="5 min">5 min</option>
                            <option value="10 min">10 min</option>
                            <option value="15 min">15 min</option>
                            <option value="30 min">30 min</option>
                            <option value="45 min">45 min</option>
                            <option value="60 min">60 min</option>
                            <option value="Mas de 1 hora">
                                Más de 1 hora
                            </option>

                        </select>

                    </div>

                </div>

                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-success"
                    >

                        Guardar Servicio

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
