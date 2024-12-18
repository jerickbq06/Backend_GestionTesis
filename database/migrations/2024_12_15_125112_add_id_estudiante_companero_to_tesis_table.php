<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tesis', function (Blueprint $table) {
            if (!Schema::hasColumn('tesis', 'id_estudiante_companero')) {
                $table->bigInteger('id_estudiante_companero')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('tesis', function (Blueprint $table) {
            $table->dropColumn('id_estudiante_companero');
        });}
};
