<?php

namespace Database\Seeders;

use App\Models\EstadoDelEjemplar;
use Illuminate\Database\Seeder;

class EstadoDelEjemplarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoDelEjemplar::insert(
            [
                ["estado_del_ejemplar" => "Disponible"],
                ["estado_del_ejemplar" => "Prestado"],
                ["estado_del_ejemplar" => "Reservado"],
                ["estado_del_ejemplar" => "No Disponible"]
            ]
        );
    }
}
