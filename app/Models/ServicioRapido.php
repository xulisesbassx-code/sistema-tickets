<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioRapido extends Model
{
    protected $table = 'servicios_rapidos';

    protected $fillable = [

        'tecnico_id',

        'nombre_usuario',

        'departamento',

        'extension',

        'ubicacion',

        'tipo_equipo',

        'problema',

        'diagnostico',

        'solucion',

        'resultado',

        'tiempo_invertido'
    ];

    public function tecnico()
    {
        return $this->belongsTo(
            User::class,
            'tecnico_id'
        );
    }
}
