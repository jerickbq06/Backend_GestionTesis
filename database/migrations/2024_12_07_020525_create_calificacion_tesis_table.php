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
        Schema::create('calificacion_tesis', function (Blueprint $table) {
            $table->id('id_calificacion_tesis');
            $table->foreignId('id_tesis')->constrained('tesis', 'id_tesis');
            $table->foreignId('id_estudiante')->constrained('usuarios', 'id_usuario');
            $table->integer('calificacion');
            $table->string('observaciones', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion_tesis');
    }
};
