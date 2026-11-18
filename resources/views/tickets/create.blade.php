
<x-app-layout>

<style>
    .create-ticket-page {
        padding: 30px 0 50px;
        color: #243247;
    }

    .create-header {
        margin-bottom: 25px;
    }

    .create-header h2 {
        color: #17365d;
        font-size: 26px;
        font-weight: 750;
        margin-bottom: 6px;
    }

    .create-header p {
        color: #718096;
        font-size: 14px;
        margin: 0;
    }

    .create-ticket-card {
        background: #fff;
        border: 1px solid #e5eaf0;
        border-radius: 14px;
        box-shadow: 0 5px 20px rgba(20, 45, 75, .06);
        overflow: hidden;
    }

    .create-card-header {
        background: #0755a0;
        color: white;
        padding: 20px 25px;
    }

    .create-card-header h5 {
        font-size: 17px;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .create-card-header p {
        font-size: 13px;
        margin: 0;
        opacity: .85;
    }

    .create-card-body {
        padding: 28px;
    }

    .create-ticket-page label {
        display: block;
        color: #35465d;
        font-size: 13px;
        font-weight: 650;
        margin-bottom: 8px;
    }

    .create-ticket-page .form-control {
        border: 1px solid #dce3eb;
        border-radius: 8px;
        padding: 11px 13px;
        font-size: 14px;
        color: #34445a;
        box-shadow: none;
    }

    .create-ticket-page .form-control:focus {
        border-color: #0755a0;
        box-shadow: 0 0 0 3px rgba(7, 85, 160, .10);
    }

    .create-ticket-page textarea {
        resize: vertical;
        min-height: 140px;
    }

    .field-description {
        color: #8793a3;
        font-size: 12px;
        margin-top: 6px;
    }

    .required-mark {
        color: #dc3545;
    }

    .create-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        border-top: 1px solid #edf0f4;
        margin-top: 25px;
        padding-top: 22px;
    }

    .btn-create {
        background: #0755a0;
        color: white;
        border: 1px solid #0755a0;
        border-radius: 8px;
        padding: 11px 22px;
        font-size: 14px;
        font-weight: 650;
        transition: .2s;
    }

    .btn-create:hover {
        background: #06447f;
        color: white;
    }

    .btn-cancel {
        background: #edf1f5;
        color: #45566c;
        border: 1px solid #dce3eb;
        border-radius: 8px;
        padding: 11px 20px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #e1e7ee;
        color: #26384d;
    }

    .create-info {
        background: #f0f6fd;
        border: 1px solid #d9e8f8;
        border-left: 4px solid #0755a0;
        border-radius: 8px;
        padding: 15px 18px;
        margin-top: 20px;
    }

    .create-info strong {
        color: #0755a0;
        font-size: 13px;
    }

    .create-info p {
        color: #53647a;
        font-size: 12px;
        margin: 5px 0 0;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .create-ticket-page {
            padding: 20px 0 35px;
        }

        .create-card-body {
            padding: 20px;
        }

        .create-actions {
            flex-direction: column-reverse;
        }

        .create-actions button,
        .create-actions a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container create-ticket-page">

    <div class="create-header">
        <h2>Crear Ticket</h2>
        <p>Registra una nueva solicitud de soporte técnico.</p>
    </div>

    <div class="row justify-content-center">

        <div class="col-lg-9 col-xl-8">

            <div class="create-ticket-card">

                <div class="create-card-header">
                    <h5>Nueva solicitud de soporte</h5>
                    <p>Completa la información para registrar tu incidencia.</p>
                </div>

                <div class="create-card-body">

                    <form action="{{ route('tickets.store') }}" method="POST">

                        @csrf

                        <div class="mb-4">

                            <label>
                                Título de la solicitud
                                <span class="required-mark">*</span>
                            </label>

                            <input
                                type="text"
                                name="titulo"
                                class="form-control"
                                placeholder="Ej. Equipo de cómputo no enciende"
                                value="{{ old('titulo') }}"
                                required
                            >

                            <div class="field-description">
                                Escribe un título breve que identifique el problema.
                            </div>

                        </div>

                        <div class="mb-4">

                            <label>
                                Descripción del problema
                                <span class="required-mark">*</span>
                            </label>

                            <textarea
                                name="descripcion"
                                class="form-control"
                                rows="5"
                                placeholder="Describe detalladamente el problema que estás presentando..."
                                required
                            >{{ old('descripcion') }}</textarea>

                            <div class="field-description">
                                Incluye los detalles necesarios para facilitar el diagnóstico.
                            </div>

                        </div>

                        <div class="mb-4">

                            <label>
                                Categoría del incidente
                                <span class="required-mark">*</span>
                            </label>

                            <select name="categoria" class="form-control" required>

                                <option value="hardware" {{ old('categoria', 'hardware') == 'hardware' ? 'selected' : '' }}>
                                    Hardware
                                </option>

                                <option value="software" {{ old('categoria') == 'software' ? 'selected' : '' }}>
                                    Software
                                </option>

                                <option value="impresora" {{ old('categoria') == 'impresora' ? 'selected' : '' }}>
                                    Impresora
                                </option>

                                <option value="red" {{ old('categoria') == 'red' ? 'selected' : '' }}>
                                    Red
                                </option>

                                <option value="otro" {{ old('categoria') == 'otro' ? 'selected' : '' }}>
                                    Otro
                                </option>

                            </select>

                            <div class="field-description">
                                Selecciona el área a la que pertenece tu problema.
                            </div>

                        </div>

                        <div class="create-info">

                            <strong>Información importante</strong>

                            <p>
                                Una vez registrada tu solicitud, el equipo de soporte técnico
                                podrá revisar el incidente y dar seguimiento a su atención.
                            </p>

                        </div>

                        <div class="create-actions">

                            <a href="{{ route('tickets.index') }}" class="btn-cancel">
                                Cancelar
                            </a>

                            <button type="submit" class="btn-create">
                                Crear Ticket
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>
