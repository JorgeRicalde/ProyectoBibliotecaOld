<?php

namespace Database\Seeders;

use App\Models\EstadoDelPrestamo;
use Illuminate\Database\Seeder;

class EstadoDelPrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoDelPrestamo::insert(
            [
                ["estado_del_prestamo" => "Prestado"],
                ["estado_del_prestamo" => "Entregado"],
                ["estado_del_prestamo" => "Cancelado"]
            ]
        );
    }
}
