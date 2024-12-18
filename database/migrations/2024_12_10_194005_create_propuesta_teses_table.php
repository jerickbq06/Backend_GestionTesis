<?php

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('propuesta_tesis', function (Blueprint $table) {
            $table->id('id_propuesta_tesis');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('ambito');
            $table->timestamps();
        });

        FacadesDB::statement("
            ALTER TABLE propuesta_tesis
            ADD CONSTRAINT ambito_check
            CHECK (ambito IN ('investigacion', 'desarrollo web', 'desarrollo movil', 'desarrollo videojuegos', 'inteligencia artificial'))
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        FacadesDB::statement("
            ALTER TABLE propuesta_tesis
            DROP CONSTRAINT IF EXISTS tipo_check
        ");

        Schema::dropIfExists('propuesta_teses');
    }
};
