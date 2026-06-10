<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">
            Editar Usuario
        </div>

        <div class="card-body">

            <form
                action="{{ route('usuarios.update', $usuario) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $usuario->name }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ $usuario->email }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Rol</label>

                    <select
                        name="rol"
                        class="form-control"
                    >

                        <option
                            value="usuario"
                            {{ $usuario->rol == 'usuario' ? 'selected' : '' }}
                        >
                            Usuario
                        </option>

                        <option
                            value="tecnico"
                            {{ $usuario->rol == 'tecnico' ? 'selected' : '' }}
                        >
                            Técnico
                        </option>

                        <option
                            value="admin"
                            {{ $usuario->rol == 'admin' ? 'selected' : '' }}
                        >
                            Administrador
                        </option>

                    </select>

                </div>

                <button class="btn btn-primary">

                    Actualizar Usuario

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
