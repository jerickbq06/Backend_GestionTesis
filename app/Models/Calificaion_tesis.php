<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificaion_tesis extends Model
{
    //
    protected $table = 'calificacion_tesis';
    protected $primaryKey = 'id_calificacion_tesis';
    protected $fillable = ['id_tesis', 'id_estudiante', 'calificacion', 'observaciones'];

    public function tesis()
    {
        return $this->belongsTo(Tesis::class, 'id_tesis', 'id_tesis');
    }
}
