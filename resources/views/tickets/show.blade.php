<x-app-layout>

<div class="container mt-4">

    <!-- INFORMACIÓN DEL TICKET -->

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>
                Ticket #{{ $ticket->id }}
            </h4>

            <a href="{{ route('tickets.index') }}"
               class="btn btn-secondary">
                Volver
            </a>

        </div>

        <div class="card-body">

            <h3>
                {{ $ticket->titulo }}
            </h3>

            <p class="mt-3">
                {{ $ticket->descripcion }}
            </p>

            <hr>

            <h5 class="mb-3">
                Información General
            </h5>

            <div class="row">

                <div class="col-md-3">

                    <strong>Categoría:</strong>

                    <br>

                    {{ ucfirst($ticket->categoria) }}

                </div>

                <div class="col-md-3">

                    <strong>Estado:</strong>

                    <br>

                    <span class="badge bg-primary">
                        {{ ucfirst($ticket->estado) }}
                    </span>

                </div>

                <div class="col-md-3">

                    <strong>Prioridad:</strong>

                    <br>

                    <span class="badge bg-danger">
                        {{ ucfirst($ticket->prioridad) }}
                    </span>

                </div>

                <div class="col-md-3">

                    <strong>Fecha de Creación:</strong>

                    <br>

                    {{ $ticket->created_at->format('d/m/Y H:i') }}

                </div>

            </div>

            <hr>

            @if(auth()->user()->rol != 'usuario')

<div class="row">

    <div class="col-md-4">

        <strong>Usuario que reportó:</strong>

        <br>

        {{ $ticket->usuario->name ?? 'N/A' }}

    </div>

    <div class="col-md-4">

        <strong>Técnico asignado:</strong>

        <br>

        {{ $ticket->tecnico->name ?? 'Sin asignar' }}

    </div>

    <div class="col-md-4">

        <strong>Última actualización:</strong>

        <br>

        {{ $ticket->updated_at->format('d/m/Y H:i') }}

    </div>

</div>

<hr>

@endif

            <hr>

           @if(auth()->user()->rol != 'usuario')

<a href="{{ route('tickets.edit', $ticket) }}"
   class="btn btn-warning">
    Editar Ticket
</a>

@endif
        </div>

    </div>

    <!-- COMENTARIOS -->

    <div class="mt-5">

        <h4>
            Comentarios del Ticket
        </h4>

        <div class="card shadow">

            <div class="card-body">

                <form action="{{ route('comentarios.store', $ticket) }}"
                      method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
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

                    <button class="btn btn-primary">

                        Agregar Comentario

                    </button>

                </form>

            </div>

        </div>

        <div class="mt-3">

            @forelse($ticket->comentarios as $comentario)

            <div class="card mb-3 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <strong>

                            {{ $comentario->usuario->name }}

                        </strong>

                        <small>

                            {{ $comentario->created_at->format('d/m/Y H:i') }}

                        </small>

                    </div>

                    <hr>

                    <p class="mb-0">

                        {{ $comentario->mensaje }}

                    </p>

                </div>

            </div>

            @empty

            <div class="alert alert-info">

                No hay comentarios registrados.

            </div>

            @endforelse

        </div>

    </div>
@if(auth()->user()->rol != 'usuario')
    <!-- HISTORIAL -->

    <div class="mt-5">

        <h4>
            Historial del Ticket
        </h4>

        @forelse($ticket->historial->sortByDesc('created_at') as $registro)

        <div class="card mb-2 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <strong>

                        {{ $registro->accion }}

                    </strong>

                    <small>

                        {{ $registro->created_at->format('d/m/Y H:i') }}

                    </small>

                </div>

                <hr>

                <p class="mb-1">

                    {{ $registro->descripcion }}

                </p>

                <small class="text-muted">

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

</div>
@endif
</x-app-layout>
