<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'categoria',
        'prioridad',
        'estado',
        'tecnico_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    public function historial()
{
    return $this->hasMany(HistorialTicket::class);
}
    
}