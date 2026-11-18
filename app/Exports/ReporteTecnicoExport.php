<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReporteTecnicoExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    protected $tickets;
    protected $servicios;

    public function __construct($tickets, $servicios)
    {
        $this->tickets = $tickets;
        $this->servicios = $servicios;
    }

    public function collection()
    {
        $datos = collect();

        foreach ($this->tickets as $ticket) {
            $datos->push([
                'Tipo' => 'Ticket',
                'ID' => $ticket->id,
                'Usuario' => $ticket->usuario->name ?? 'N/A',
                'Equipo' => 'N/A',
                'Descripcion' => $ticket->titulo,
                'Estado' => $ticket->estado,
                'Prioridad' => $ticket->prioridad,
                'Tiempo invertido' => 'N/A',
                'Fecha' => $ticket->created_at->format('d/m/Y H:i'),
            ]);
        }

        foreach ($this->servicios as $servicio) {
            $datos->push([
                'Tipo' => 'Servicio rápido',
                'ID' => $servicio->id,
                'Usuario' => $servicio->nombre_usuario,
                'Equipo' => $servicio->tipo_equipo,
                'Descripcion' => $servicio->problema,
                'Estado' => $servicio->resultado,
                'Prioridad' => 'N/A',
                'Tiempo invertido' => $servicio->tiempo_invertido,
                'Fecha' => $servicio->created_at->format('d/m/Y H:i'),
            ]);
        }

        return $datos;
    }

    public function headings(): array
    {
        return [
            'Tipo de atención',
            'ID',
            'Usuario',
            'Equipo',
            'Descripción',
            'Estado o resultado',
            'Prioridad',
            'Tiempo invertido',
            'Fecha',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0755A0'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 10,
            'C' => 25,
            'D' => 22,
            'E' => 40,
            'F' => 22,
            'G' => 15,
            'H' => 20,
            'I' => 22,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $ultimaFila = $sheet->getHighestRow();

                // Altura del encabezado
                $sheet->getRowDimension(1)->setRowHeight(30);

                // Congelar encabezados
                $sheet->freezePane('A2');

                // Activar filtros
                $sheet->setAutoFilter('A1:I' . $ultimaFila);

                // Alineación y bordes generales
                if ($ultimaFila >= 2) {
                    $sheet->getStyle('A2:I' . $ultimaFila)->applyFromArray([
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => 'D9E2F3'],
                            ],
                        ],
                    ]);

                    // Filas alternadas
                    for ($fila = 2; $fila <= $ultimaFila; $fila++) {
                        if ($fila % 2 == 0) {
                            $sheet->getStyle("A{$fila}:I{$fila}")
                                ->getFill()
                                ->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB('F2F5F9');
                        }

                        $sheet->getRowDimension($fila)->setRowHeight(25);

                        // Colores de estado o resultado
                        $estado = strtolower((string) $sheet->getCell("F{$fila}")->getValue());

                        $colorEstado = match ($estado) {
                            'resuelto' => 'D1FAE5',
                            'parcial', 'revision' => 'DBEAFE',
                            'proceso' => 'FEF3C7',
                            'nuevo' => 'FEE2E2',
                            'cerrado' => 'E5E7EB',
                            default => null,
                        };

                        if ($colorEstado) {
                            $sheet->getStyle("F{$fila}")->getFill()
                                ->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB($colorEstado);
                        }

                        // Colores de prioridad
                        $prioridad = strtolower((string) $sheet->getCell("G{$fila}")->getValue());

                        $colorPrioridad = match ($prioridad) {
                            'critica' => 'FECACA',
                            'alta' => 'FED7AA',
                            'media' => 'DBEAFE',
                            'baja' => 'D1FAE5',
                            default => null,
                        };

                        if ($colorPrioridad) {
                            $sheet->getStyle("G{$fila}")->getFill()
                                ->setFillType(Fill::FILL_SOLID)
                                ->getStartColor()
                                ->setRGB($colorPrioridad);
                        }
                    }
                }

                // Centrar columnas específicas
                $sheet->getStyle('A:B')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('F:I')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Fuente general
                $sheet->getStyle('A1:I' . $ultimaFila)
                    ->getFont()
                    ->setName('Arial');
            },
        ];
    }
}
