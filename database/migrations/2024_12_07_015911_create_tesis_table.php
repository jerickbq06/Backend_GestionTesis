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
        Schema::create('tesis', function (Blueprint $table) {
            $table->id('id_tesis');
            $table->string('titulo', 100);
            $table->unsignedBigInteger('id_estudiante');
            $table->unsignedBigInteger('id_docente_tutor');
            $table->timestamps();
            // Definir las llaves foráneas
            $table->foreign('id_estudiante')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_docente_tutor')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tesis');
    }
};
