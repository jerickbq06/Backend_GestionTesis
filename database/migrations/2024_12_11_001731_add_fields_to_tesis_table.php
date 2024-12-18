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
        Schema::table('tesis', function (Blueprint $table) {
            //
            $table->text('descripcion')->nullable();
            $table->enum('ambito', ['investigacion', 'desarrollo web', 'desarrollo movil', 'desarrollo videojuegos', 'inteligencia artificial'])->default('investigacion');
            $table->boolean('grupal')->default(false);
            $table->enum('estado', ['aprobado', 'rechazado', 'en espera'])->default('en espera');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tesis', function (Blueprint $table) {
            $table->dropColumn(['descripcion', 'ambito', 'grupal', 'estado']);
        });
    }
};
