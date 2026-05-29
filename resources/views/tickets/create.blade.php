<x-app-layout>

<div class="container mt-4">

    <h2>Crear Ticket</h2>

    <form action="{{ route('tickets.store') }}" method="POST">

        @csrf

        <div class="mb-3">

            <label>Título</label>

            <input type="text"
                   name="titulo"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Descripción</label>

            <textarea name="descripcion"
                      class="form-control"
                      rows="5"
                      required></textarea>

        </div>

        <div class="mb-3">

            <label>Categoría</label>

            <select name="categoria" class="form-control">

                <option value="hardware">Hardware</option>
                <option value="software">Software</option>
                <option value="impresora">Impresora</option>
                <option value="red">Red</option>
                <option value="otro">Otro</option>

            </select>

        </div>

        <button class="btn btn-success">

            Crear Ticket

        </button>

    </form>

</div>

</x-app-layout>