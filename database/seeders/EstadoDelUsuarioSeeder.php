<?php

namespace Database\Seeders;

use App\Models\EstadoDelUsuario;
use Illuminate\Database\Seeder;

class EstadoDelUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoDelUsuario::insert(
            [
                ["estado_del_usuario" => "Habilitado"],
                ["estado_del_usuario" => "Sancionado"],
                ["estado_del_usuario" => "Deshabilitado"]
            ]
        );
    }
}
