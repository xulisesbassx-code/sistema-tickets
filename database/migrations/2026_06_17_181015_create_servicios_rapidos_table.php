<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
   {
    Schema::create('servicios_rapidos', function (Blueprint $table) {

        $table->id();

        $table->foreignId('tecnico_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->string('nombre_usuario');

        $table->string('departamento')
              ->nullable();

        $table->string('extension')
              ->nullable();

        $table->string('ubicacion')
              ->nullable();

        $table->string('tipo_equipo');

        $table->text('problema');

        $table->text('diagnostico')
              ->nullable();

        $table->text('solucion');

        $table->enum('resultado', [
            'resuelto',
            'parcial',
            'pendiente'
        ]);

        $table->string('tiempo_invertido');

        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('servicios_rapidos');
    }
};
