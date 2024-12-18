<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Roles extends Model
{
    //
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['nombre_rol'];

    public function usuarios(): HasMany {
        return $this->hasMany(Usuario::class, 'id_rol', 'id_rol');
    }
}
