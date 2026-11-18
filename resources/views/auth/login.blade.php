
<x-guest-layout>

    <style>
        body {
            background: #f1f5f9;
        }

        .login-wrapper {
            min-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 18px;
            padding: 40px;
            box-shadow: 0 15px 45px rgba(7, 85, 160, 0.12);
            border: 1px solid #e5eaf0;
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo {
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            background: #0755A0;
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -1px;
            border-bottom: 4px solid #F36B21;
        }

        .login-title {
            color: #0755A0;
            font-size: 25px;
            font-weight: 800;
            margin: 0;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-top: 7px;
        }

        .login-label {
            display: block;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .login-input {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            padding: 12px 14px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .login-input:focus {
            border-color: #0755A0;
            box-shadow: 0 0 0 3px rgba(7, 85, 160, 0.12);
            outline: none;
        }

        .login-button {
            background: #0755A0;
            color: white;
            border: none;
            border-radius: 9px;
            padding: 12px 22px;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .login-button:hover {
            background: #06447f;
            box-shadow: 0 5px 15px rgba(7, 85, 160, 0.2);
        }

        .login-link {
            color: #0755A0;
            font-size: 13px;
            text-decoration: none;
        }

        .login-link:hover {
            color: #F36B21;
            text-decoration: underline;
        }

        .login-footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 30px;
        }

        .login-divider {
            height: 3px;
            width: 45px;
            background: #F36B21;
            margin: 18px auto 0;
            border-radius: 10px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 28px 22px;
            }
        }
    </style>

    <div class="login-wrapper">
        <div class="login-card">

            <!-- Encabezado -->
            <div class="login-header">
                <div class="login-logo">
                    IT
                </div>

                <h1 class="login-title">GRUPO IT</h1>

                <p class="login-subtitle">
                    Sistema de Gestión de Tickets
                </p>

                <div class="login-divider"></div>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="login-label">
                        Correo electrónico
                    </label>

                    <x-text-input
                        id="email"
                        class="login-input"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="usuario@empresa.com"
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <label for="password" class="login-label">
                        Contraseña
                    </label>

                    <x-text-input
                        id="password"
                        class="login-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Ingresa tu contraseña"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mt-5">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-blue-700 shadow-sm focus:ring-blue-600"
                            name="remember"
                        >

                        <span class="ms-2 text-sm text-gray-600">
                            Recordar mi sesión
                        </span>
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-4 mt-6">

                    <x-primary-button class="login-button w-full justify-center">
                        Iniciar sesión
                    </x-primary-button>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="login-link"
                               href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    @endif

                </div>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                Sistema interno de soporte técnico
                <br>
                © {{ date('Y') }} Grupo IT
            </div>

        </div>
    </div>

</x-guest-layout>
