<x-app-layout>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">

        <h2>Usuarios</h2>

        <a href="{{ route('usuarios.create') }}"
           class="btn btn-primary">
            Nuevo Usuario
        </a>

    </div>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            @foreach($usuarios as $usuario)

            <tr>

                <td>{{ $usuario->id }}</td>

                <td>{{ $usuario->name }}</td>

                <td>{{ $usuario->email }}</td>

                <td>{{ $usuario->rol }}</td>

                <td>

                    <a href="{{ route('usuarios.edit', $usuario) }}"
                       class="btn btn-warning btn-sm">

                        Editar

                    </a>

                    <form
                        action="{{ route('usuarios.destroy', $usuario) }}"
                        method="POST"
                        style="display:inline;"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Eliminar usuario?')"
                        >
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</x-app-layout>
