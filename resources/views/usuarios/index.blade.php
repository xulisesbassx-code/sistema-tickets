
<x-app-layout>

<div class="container py-4">

    <style>
        .usuarios-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .usuarios-header {
            background: #0755A0;
            color: #FFFFFF;
            padding: 20px 25px;
        }

        .usuarios-header h2 {
            margin: 0;
            font-weight: 700;
        }

        .btn-nuevo {
            background: #F36B21;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-nuevo:hover {
            background: #D95712;
            color: #FFFFFF;
        }

        .tabla-usuarios {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .tabla-usuarios thead th {
            background: #F2F5F9;
            color: #0755A0;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 700;
            padding: 15px;
            border-bottom: 2px solid #DCE3EC;
            white-space: nowrap;
        }

        .tabla-usuarios tbody td {
            padding: 14px 15px;
            color: #334155;
        }

        .tabla-usuarios tbody tr:hover {
            background: #F8FAFC;
        }

        .rol-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .rol-admin {
            background: #E8DDFB;
            color: #6639A6;
        }

        .rol-tecnico {
            background: #DCEEFF;
            color: #0755A0;
        }

        .rol-usuario {
            background: #E2F5E9;
            color: #198754;
        }

        .btn-editar {
            background: #0755A0;
            color: #FFFFFF;
            border: none;
            border-radius: 6px;
            padding: 6px 11px;
            font-size: 13px;
            text-decoration: none;
        }

        .btn-editar:hover {
            background: #06447F;
            color: #FFFFFF;
        }

        .btn-eliminar {
            background: #DC3545;
            color: #FFFFFF;
            border: none;
            border-radius: 6px;
            padding: 6px 11px;
            font-size: 13px;
        }

        .btn-eliminar:hover {
            background: #BB2D3B;
            color: #FFFFFF;
        }

        .tabla-responsive {
            overflow-x: auto;
        }
    </style>

    <div class="card shadow-sm usuarios-card">

        <!-- ENCABEZADO -->
        <div class="usuarios-header d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>
                <h2>
                    <i class="bi bi-people-fill me-2"></i>
                    Usuarios
                </h2>

                <small style="opacity: .85;">
                    Administración de usuarios y roles del sistema
                </small>
            </div>

            <a href="{{ route('usuarios.create') }}" class="btn-nuevo">
                <i class="bi bi-person-plus-fill me-1"></i>
                Nuevo Usuario
            </a>

        </div>

        <!-- TABLA -->
        <div class="card-body p-0">

            <div class="tabla-responsive">

                <table class="table tabla-usuarios table-hover">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($usuarios as $usuario)

                            <tr>

                                <td>
                                    <strong>#{{ $usuario->id }}</strong>
                                </td>

                                <td>
                                    <i class="bi bi-person-circle me-2 text-secondary"></i>
                                    {{ $usuario->name }}
                                </td>

                                <td>
                                    {{ $usuario->email }}
                                </td>

                                <td>

                                    @if($usuario->rol == 'admin')

                                        <span class="rol-badge rol-admin">
                                            <i class="bi bi-shield-fill-check me-1"></i>
                                            Administrador
                                        </span>

                                    @elseif($usuario->rol == 'tecnico')

                                        <span class="rol-badge rol-tecnico">
                                            <i class="bi bi-tools me-1"></i>
                                            Técnico
                                        </span>

                                    @else

                                        <span class="rol-badge rol-usuario">
                                            <i class="bi bi-person me-1"></i>
                                            Usuario
                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                        <a href="{{ route('usuarios.edit', $usuario) }}"
                                           class="btn-editar">

                                            <i class="bi bi-pencil-square me-1"></i>
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
                                                type="submit"
                                                class="btn-eliminar"
                                                onclick="return confirm('¿Eliminar usuario?')"
                                            >
                                                <i class="bi bi-trash me-1"></i>
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-5">

                                    <i class="bi bi-people text-secondary"
                                       style="font-size: 35px;"></i>

                                    <p class="mt-2 mb-0 text-secondary">
                                        No hay usuarios registrados.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white text-muted small">
            <i class="bi bi-info-circle me-1"></i>
            Los usuarios registrados se muestran con su rol correspondiente.
        </div>

    </div>

</div>

</x-app-layout>
