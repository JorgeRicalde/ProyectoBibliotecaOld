<?php

namespace Database\Seeders;

use App\Models\EstadoDeLaSancion;
use Illuminate\Database\Seeder;

class EstadoDeLaSancionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoDeLaSancion::insert(
            [
                ["estado_de_la_sancion" => "Activo"],
                ["estado_de_la_sancion" => "Terminado"],
                ["estado_de_la_sancion" => "Cancelado"]
            ]
        );
    }
}
