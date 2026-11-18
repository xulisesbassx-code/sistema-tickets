
<x-app-layout>

<div class="container py-4">

    <style>
        .usuario-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .usuario-header {
            background: #0755A0;
            color: #FFFFFF;
            padding: 20px 25px;
        }

        .usuario-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .seccion-titulo {
            color: #0755A0;
            font-size: 16px;
            font-weight: 700;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #F2F5F9;
        }

        .form-label {
            color: #334155;
            font-weight: 600;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            border: 1px solid #DCE3EC;
            border-radius: 8px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0755A0;
            box-shadow: 0 0 0 0.2rem rgba(7, 85, 160, 0.12);
        }

        .btn-guardar {
            background: #F36B21;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-guardar:hover {
            background: #D95712;
            color: #FFFFFF;
        }

        .btn-cancelar {
            background: #0755A0;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-cancelar:hover {
            background: #06447F;
            color: #FFFFFF;
        }

        .rol-info {
            background: #F2F5F9;
            border-radius: 10px;
            padding: 15px;
            color: #475569;
            font-size: 13px;
        }
    </style>

    <div class="card shadow-sm usuario-card">

        <!-- ENCABEZADO -->
        <div class="usuario-header">

            <h4>
                <i class="bi bi-person-plus-fill me-2"></i>
                Nuevo Usuario
            </h4>

            <p class="mb-0 mt-2" style="opacity: .85;">
                Registra una nueva cuenta y configura su acceso al sistema.
            </p>

        </div>

        <div class="card-body p-4">

            <form action="{{ route('usuarios.store') }}" method="POST">

                @csrf

                <!-- DATOS PERSONALES -->
                <div class="mb-4">

                    <h5 class="seccion-titulo">
                        <i class="bi bi-person-fill me-2"></i>
                        Información del Usuario
                    </h5>

                    <div class="mb-3">

                        <label class="form-label">
                            Nombre completo
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Ingresa el nombre del usuario"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="ejemplo@empresa.com"
                            required
                        >

                    </div>

                </div>

                <!-- ACCESO -->
                <div class="mb-4">

                    <h5 class="seccion-titulo">
                        <i class="bi bi-shield-lock-fill me-2"></i>
                        Datos de Acceso
                    </h5>

                    <div class="mb-3">

                        <label class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Ingresa una contraseña"
                            required
                        >

                        <small class="text-muted">
                            La contraseña será utilizada para iniciar sesión en el sistema.
                        </small>

                    </div>

                </div>

                <!-- ROL -->
                <div class="mb-4">

                    <h5 class="seccion-titulo">
                        <i class="bi bi-person-badge-fill me-2"></i>
                        Asignación de Rol
                    </h5>

                    <div class="mb-3">

                        <label class="form-label">
                            Rol del usuario
                        </label>

                        <select
                            name="rol"
                            class="form-select"
                            required
                        >

                            <option value="usuario"
                                {{ old('rol', 'usuario') == 'usuario' ? 'selected' : '' }}>
                                Usuario
                            </option>

                            <option value="tecnico"
                                {{ old('rol') == 'tecnico' ? 'selected' : '' }}>
                                Técnico
                            </option>

                            <option value="admin"
                                {{ old('rol') == 'admin' ? 'selected' : '' }}>
                                Administrador
                            </option>

                        </select>

                    </div>

                    <div class="rol-info">

                        <strong>
                            <i class="bi bi-info-circle me-1"></i>
                            Información sobre los roles
                        </strong>

                        <ul class="mb-0 mt-2 ps-3">

                            <li>
                                <strong>Usuario:</strong>
                                puede registrar y consultar sus solicitudes.
                            </li>

                            <li>
                                <strong>Técnico:</strong>
                                puede atender y gestionar los tickets asignados.
                            </li>

                            <li>
                                <strong>Administrador:</strong>
                                cuenta con acceso a la administración del sistema.
                            </li>

                        </ul>

                    </div>

                </div>

                <!-- BOTONES -->
                <div class="d-flex flex-wrap justify-content-end gap-2 pt-3 border-top">

                    <a href="{{ route('usuarios.index') }}"
                       class="btn btn-cancelar">

                        <i class="bi bi-x-circle me-1"></i>
                        Cancelar

                    </a>

                    <button type="submit" class="btn btn-guardar">

                        <i class="bi bi-save me-1"></i>
                        Guardar Usuario

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>
