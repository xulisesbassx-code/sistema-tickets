<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">
            <h3>Editar Ticket</h3>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tickets.update', $ticket) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input
                        type="text"
                        name="titulo"
                        class="form-control"
                        value="{{ old('titulo', $ticket->titulo) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea
                        name="descripcion"
                        class="form-control"
                        rows="5"
                        required
                    >{{ old('descripcion', $ticket->descripcion) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría</label>

                    <select name="categoria" class="form-select">

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

                        <option value="otro"
                            {{ $ticket->categoria == 'otro' ? 'selected' : '' }}>
                            Otro
                        </option>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estado</label>

                    <select name="estado" class="form-select">

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
                    <label class="form-label">Prioridad</label>

                    <select name="prioridad" class="form-select">

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

                <div class="mb-3">
                    <label class="form-label">Técnico asignado</label>

                    <select name="tecnico_id" class="form-select">

                        <option value="">
                            Sin asignar
                        </option>

                        @foreach($tecnicos as $tecnico)

                            <option
                                value="{{ $tecnico->id }}"
                                {{ $ticket->tecnico_id == $tecnico->id ? 'selected' : '' }}
                            >
                                {{ $tecnico->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-success">
                        Actualizar Ticket
                    </button>

                    <a href="{{ route('tickets.index') }}"
                       class="btn btn-secondary">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>