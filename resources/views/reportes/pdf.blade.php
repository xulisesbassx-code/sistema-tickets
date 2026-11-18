
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #17365D;
            font-size: 20px;
            margin-bottom: 5px;
        }

        h2 {
            color: #17365D;
            font-size: 13px;
            margin-top: 22px;
        }

        .empresa {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }

        .info {
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .info p {
            margin: 4px 0;
        }

        .resumen {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .resumen td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .numero {
            font-size: 17px;
            font-weight: bold;
            color: #17365D;
        }

        table.detalle {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .detalle th {
            background: #17365D;
            color: white;
            padding: 7px;
            text-align: left;
        }

        .detalle td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        .detalle tr:nth-child(even) {
            background: #f2f4f7;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>
<body>

    <h1>REPORTE DE SOPORTE TÉCNICO</h1>
    <div class="empresa">GRUPO IT</div>

    <div class="info">
        <p><strong>Técnico:</strong> {{ $tecnico->name }}</p>
        <p><strong>Periodo:</strong>
            {{ $fechaInicio ?: 'Sin fecha inicial' }}
            al
            {{ $fechaFin ?: 'Sin fecha final' }}
        </p>
        <p><strong>Fecha de generación:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <h2>Resumen de actividades</h2>

    <table class="resumen">
        <tr>
            <td>
                <div class="numero">{{ $ticketsResueltos }}</div>
                Tickets resueltos
            </td>
            <td>
                <div class="numero">{{ $ticketsAbiertos }}</div>
                Tickets abiertos
            </td>
            <td>
                <div class="numero">{{ $serviciosRapidos }}</div>
                Servicios rápidos
            </td>
            <td>
                <div class="numero">{{ $totalAtenciones }}</div>
                Total de atenciones
            </td>
        </tr>
    </table>

    <h2>Tickets del técnico</h2>

    <table class="detalle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Título</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->usuario->name ?? 'N/A' }}</td>
                    <td>{{ $ticket->titulo }}</td>
                    <td>{{ $ticket->estado }}</td>
                    <td>{{ $ticket->prioridad }}</td>
                    <td>{{ $ticket->created_at?->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay tickets registrados en este periodo.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Servicios rápidos</h2>

    <table class="detalle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Equipo</th>
                <th>Problema</th>
                <th>Resultado</th>
                <th>Tiempo</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->id }}</td>
                    <td>{{ $servicio->nombre_usuario }}</td>
                    <td>{{ $servicio->tipo_equipo }}</td>
                    <td>{{ $servicio->problema }}</td>
                    <td>{{ $servicio->resultado }}</td>
                    <td>{{ $servicio->tiempo_invertido }}</td>
                    <td>{{ $servicio->created_at?->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay servicios rápidos registrados en este periodo.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Grupo IT | Sistema de Gestión de Tickets de Soporte Técnico
    </div>

</body>
</html>
