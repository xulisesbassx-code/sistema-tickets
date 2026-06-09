<x-app-layout>

<div class="container mt-4">

    <h2 class="mb-4">
        Estadísticas del Sistema
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <canvas id="ticketsChart"></canvas>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('ticketsChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Nuevo',
            'Proceso',
            'Revisión',
            'Resuelto',
            'Cerrado'
        ],

        datasets: [{

            label: 'Tickets',

            data: [
                {{ $nuevo }},
                {{ $proceso }},
                {{ $revision }},
                {{ $resuelto }},
                {{ $cerrado }}
            ]

        }]

    }

});

</script>

</x-app-layout>