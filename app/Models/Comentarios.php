<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    //
    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentario';
    protected $fillable = ['comentario', 'id_tesis', 'id_usuario'];
    protected $hidden = ['created_at', 'updated_at'];

    public function tesis()
    {
        return $this->belongsTo(Tesis::class, 'id_tesis', 'id_tesis');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
