<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between">

            <h4>
                Ticket #{{ $ticket->id }}
            </h4>

            <a href="{{ route('tickets.index') }}"
               class="btn btn-secondary">

               Volver

            </a>

        </div>

        <div class="card-body">

            <h3>{{ $ticket->titulo }}</h3>

            <p class="mt-3">
                {{ $ticket->descripcion }}
            </p>

            <hr>

            <div class="row">

                <div class="col-md-3">

                    <strong>Categoría:</strong>

                    <br>

                    {{ $ticket->categoria }}

                </div>

                <div class="col-md-3">

                    <strong>Estado:</strong>

                    <br>

                    <span class="badge bg-primary">
                        {{ $ticket->estado }}
                    </span>

                </div>

                <div class="col-md-3">

                    <strong>Prioridad:</strong>

                    <br>

                    <span class="badge bg-danger">
                        {{ $ticket->prioridad }}
                    </span>

                </div>

                <div class="col-md-3">

                    <strong>Fecha:</strong>

                    <br>

                    {{ $ticket->created_at->format('d/m/Y H:i') }}

                </div>

            </div>

            <hr>

            <a href="{{ route('tickets.edit', $ticket) }}"
               class="btn btn-warning">

               Editar Ticket

            </a>

        </div>

    </div>

</div>

<hr>

<h4 class="mt-4">
    Comentarios
</h4>

<form action="{{ route('comentarios.store', $ticket) }}"
      method="POST"
      class="mb-4">

    @csrf

    <div class="mb-3">

        <textarea name="mensaje"
                  class="form-control"
                  rows="3"
                  placeholder="Escribe un comentario..."
                  required></textarea>

    </div>

    <button class="btn btn-primary">

        Agregar Comentario

    </button>

</form>

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

    No hay comentarios todavía.

</div>

@endforelse

</x-app-layout>