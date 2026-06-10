<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">
            Nuevo Usuario
        </div>

        <div class="card-body">

            <form action="{{ route('usuarios.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Contraseña</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Rol</label>

                    <select
                        name="rol"
                        class="form-control"
                        required
                    >

                        <option value="usuario">
                            Usuario
                        </option>

                        <option value="tecnico">
                            Técnico
                        </option>

                        <option value="admin">
                            Administrador
                        </option>

                    </select>

                </div>

                <button class="btn btn-success">

                    Guardar Usuario

                </button>

                <a href="{{ route('usuarios.index') }}"
                   class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</div>

</x-app-layout>
