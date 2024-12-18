<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropuestaTesis extends Model
{
    //
    protected $table = 'propuesta_tesis';
    protected $primaryKey = 'id_propuesta_tesis';
    protected $fillable = ['titulo', 'descripcion', 'ambito'];
    protected $hidden = ['created_at', 'updated_at'];

    
}
