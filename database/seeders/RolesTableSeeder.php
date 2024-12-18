<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the roles
        $roles = [
            ['nombre_rol' => 'Estudiante'],
            ['nombre_rol' => 'Docente'],
            ['nombre_rol' => 'Decano'],
            ['nombre_rol' => 'Admin'],
        ];

        // Insert the roles into the "roles" table
        DB::table('roles')->insert($roles);
    }
}
