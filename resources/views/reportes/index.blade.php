<x-app-layout>

<div class="container mt-4">

    <h2 class="mb-4">
        Reportes por Técnico
    </h2>

    <div class="card shadow mb-4">

        <div class="card-header">

            Filtros

        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('reportes') }}">

                <div class="row">

                    <div class="col-md-4">

                        <label class="form-label">

                            Técnico

                        </label>

                        <select
                            name="tecnico_id"
                            class="form-select">

                            <option value="">

                                Seleccione...

                            </option>

                            @foreach($tecnicos as $tecnico)

                                <option
                                    value="{{ $tecnico->id }}"
                                    {{ request('tecnico_id') == $tecnico->id ? 'selected' : '' }}>

                                    {{ $tecnico->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">

                            Fecha inicio

                        </label>

                        <input
                            type="date"
                            name="fecha_inicio"
                            class="form-control"
                            value="{{ request('fecha_inicio') }}">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">

                            Fecha fin

                        </label>

                        <input
                            type="date"
                            name="fecha_fin"
                            class="form-control"
                            value="{{ request('fecha_fin') }}">

                    </div>

                    <div class="col-md-2 d-grid">

                        <label>&nbsp;</label>

                        <button
                            class="btn btn-primary">

                            Buscar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>
@if(request()->filled('tecnico_id'))

<div class="row">

    <div class="col-md-3 mb-3">

        <div class="card bg-success text-white shadow">

            <div class="card-body">

                <h5>Tickets Resueltos</h5>

                <h2>{{ $ticketsResueltos }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-warning text-dark shadow">

            <div class="card-body">

                <h5>Tickets Abiertos</h5>

                <h2>{{ $ticketsAbiertos }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-info text-white shadow">

            <div class="card-body">

                <h5>Servicios Rápidos</h5>

                <h2>{{ $serviciosRapidos }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card bg-dark text-white shadow">

            <div class="card-body">

                <h5>Total Atenciones</h5>

                <h2>{{ $totalAtenciones }}</h2>

            </div>

        </div>

    </div>

</div>

@endif

</div>

</x-app-layout>
