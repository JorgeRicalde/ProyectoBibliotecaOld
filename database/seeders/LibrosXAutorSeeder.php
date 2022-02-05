<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\Libro;
use App\Models\Ejemplar;
use App\Models\SubClasificacion;
use Illuminate\Database\Seeder;

class LibrosXAutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $libros = Libro::all(['id']);
        $autores = Autor::all(['id']);
        $subClasificaciones = SubClasificacion::all(['id']);
        $libros->each(function (Libro $libro) use ($autores, $subClasificaciones) {
            $libro->autores()->attach($autores->random(rand(1, 3)));
            $libro->subClasificaciones()->attach($subClasificaciones->random(rand(1, 3)));
            Ejemplar::insertarVariosEjemplares(rand(10, 50), $libro["id"]);
        });
    }
}
