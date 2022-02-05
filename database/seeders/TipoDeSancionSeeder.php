<?php

namespace Database\Seeders;

use App\Models\TipoDeSancion;
use Illuminate\Database\Seeder;

class TipoDeSancionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDeSancion::insert(
            [
                ["tipo_de_sancion" => "Libro manchado", "cantidad_de_dias" => 3],
                ["tipo_de_sancion" => "Libro rayado", "cantidad_de_dias" => 3],
                ["tipo_de_sancion" => "Libro mojado", "cantidad_de_dias" => 6],
                ["tipo_de_sancion" => "Libro arrugado", "cantidad_de_dias" => 9],
                ["tipo_de_sancion" => "Faltan hojas al libro", "cantidad_de_dias" => 12],
                ["tipo_de_sancion" => "No se devolvio el libro", "cantidad_de_dias" => 15],
                ["tipo_de_sancion" => "Libro perdido", "cantidad_de_dias" => 30]
            ]
        );
    }
}
