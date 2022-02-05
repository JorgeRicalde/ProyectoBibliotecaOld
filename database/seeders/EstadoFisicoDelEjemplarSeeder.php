<?php

namespace Database\Seeders;

use App\Models\EstadoFisicoDelEjemplar;
use Illuminate\Database\Seeder;

class EstadoFisicoDelEjemplarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoFisicoDelEjemplar::insert(
            [
                ["estado_fisico_del_ejemplar" => "Buen Estado"],
                ["estado_fisico_del_ejemplar" => "Manchado"],
                ["estado_fisico_del_ejemplar" => "Rayado"],
                ["estado_fisico_del_ejemplar" => "Mojado"],
                ["estado_fisico_del_ejemplar" => "Arrugado"],
                ["estado_fisico_del_ejemplar" => "Faltan Hojas"]
            ]
        );
    }
}
