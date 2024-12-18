<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nombres_usuario' => 'Administrador',
            'email' => 'admin@admin.com',
            'telefono_usuario' => '0963714754',
            'direccion_usuario' => 'ULEAM',
            'password' => Hash::make('admin123'), // Encripta la contraseña
            'id_rol' => 4, // Relación con el rol
        ]);
    }
}

