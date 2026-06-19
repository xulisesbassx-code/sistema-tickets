<x-app-layout>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            Servicios Rápidos
        </h2>

        <a href="{{ route('servicios-rapidos.create') }}"
           class="btn btn-success">

            Nuevo Servicio

        </a>

    </div>

    <div class="card shadow">

        <div class="card-header">

            Registro de Atenciones Directas

        </div>

        <div class="card-body">

            <table class="table table-hover table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Fecha</th>

                        <th>Solicitante</th>

                        <th>Departamento</th>

                        <th>Equipo</th>

                        <th>Resultado</th>

                        <th>Técnico</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($servicios as $servicio)

                    <tr>

                        <td>
                            {{ $servicio->id }}
                        </td>

                        <td>
                            {{ $servicio->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            {{ $servicio->nombre_usuario }}
                        </td>

                        <td>
                            {{ $servicio->departamento }}
                        </td>

                        <td>
                            {{ $servicio->tipo_equipo }}
                        </td>

                        <td>

                            @if($servicio->resultado == 'resuelto')

                                <span class="badge bg-success">
                                    Resuelto
                                </span>

                            @elseif($servicio->resultado == 'parcial')

                                <span class="badge bg-warning text-dark">
                                    Parcial
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Pendiente
                                </span>

                            @endif

                      <td>

    <a href="{{ route('servicios-rapidos.show', $servicio) }}"
       class="btn btn-info btn-sm">
        Ver
    </a>

    <a href="{{ route('servicios-rapidos.edit', $servicio) }}"
       class="btn btn-warning btn-sm">
        Editar
    </a>

    @if(auth()->user()->rol == 'admin')

    <form action="{{ route('servicios-rapidos.destroy', $servicio) }}"
          method="POST"
          style="display:inline;">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('¿Eliminar este servicio?')">

            Eliminar

        </button>

    </form>

    @endif

</td>


                            <a href="{{ route('servicios-rapidos.show', $servicio) }}"
                               class="btn btn-info btn-sm">

                                Ver

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center">

                            No hay servicios registrados.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>
