<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">

            <h3>Editar Ticket</h3>

        </div>

        <div class="card-body">

            <form action="{{ route('tickets.update', $ticket) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Título</label>

                    <input type="text"
                           name="titulo"
                           class="form-control"
                           value="{{ $ticket->titulo }}"
                           required>

                </div>

                <div class="mb-3">

                    <label>Descripción</label>

                    <textarea name="descripcion"
                              class="form-control"
                              rows="5"
                              required>{{ $ticket->descripcion }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Categoría</label>

                    <select name="categoria"
                            class="form-control">

                        <option value="hardware"
                            {{ $ticket->categoria == 'hardware' ? 'selected' : '' }}>
                            Hardware
                        </option>

                        <option value="software"
                            {{ $ticket->categoria == 'software' ? 'selected' : '' }}>
                            Software
                        </option>

                        <option value="impresora"
                            {{ $ticket->categoria == 'impresora' ? 'selected' : '' }}>
                            Impresora
                        </option>

                        <option value="red"
                            {{ $ticket->categoria == 'red' ? 'selected' : '' }}>
                            Red
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Estado</label>

                    <select name="estado"
                            class="form-control">

                        <option value="nuevo"
                            {{ $ticket->estado == 'nuevo' ? 'selected' : '' }}>
                            Nuevo
                        </option>

                        <option value="proceso"
                            {{ $ticket->estado == 'proceso' ? 'selected' : '' }}>
                            En proceso
                        </option>

                        <option value="revision"
                            {{ $ticket->estado == 'revision' ? 'selected' : '' }}>
                            En revisión
                        </option>

                        <option value="resuelto"
                            {{ $ticket->estado == 'resuelto' ? 'selected' : '' }}>
                            Resuelto
                        </option>

                        <option value="cerrado"
                            {{ $ticket->estado == 'cerrado' ? 'selected' : '' }}>
                            Cerrado
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Prioridad</label>

                    <select name="prioridad"
                            class="form-control">

                        <option value="baja"
                            {{ $ticket->prioridad == 'baja' ? 'selected' : '' }}>
                            Baja
                        </option>

                        <option value="media"
                            {{ $ticket->prioridad == 'media' ? 'selected' : '' }}>
                            Media
                        </option>

                        <option value="alta"
                            {{ $ticket->prioridad == 'alta' ? 'selected' : '' }}>
                            Alta
                        </option>

                        <option value="critica"
                            {{ $ticket->prioridad == 'critica' ? 'selected' : '' }}>
                            Crítica
                        </option>

                    </select>

                </div>

                <button class="btn btn-success">

                    Actualizar Ticket

                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>