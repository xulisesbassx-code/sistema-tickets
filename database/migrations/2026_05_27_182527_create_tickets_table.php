<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {

            $table->id();

            $table->foreignId('usuario_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('titulo');

            $table->text('descripcion');

            $table->enum('categoria', [
                'hardware',
                'software',
                'impresora',
                'red',
                'otro'
            ]);

            $table->enum('prioridad', [
                'baja',
                'media',
                'alta',
                'critica'
            ])->default('media');

            $table->enum('estado', [
                'nuevo',
                'proceso',
                'revision',
                'resuelto',
                'cerrado'
            ])->default('nuevo');

            $table->foreignId('tecnico_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};