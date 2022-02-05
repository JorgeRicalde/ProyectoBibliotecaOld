<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadoFisicoDelEjemplarSeeder::class);
        $this->call(TipoDeSancionSeeder::class);
        $this->call(EstadoDeLaSancionSeeder::class);
        $this->call(EstadoDelUsuarioSeeder::class);
        $this->call(EstadoDelPrestamoSeeder::class);
        $this->call(EstadoDelEjemplarSeeder::class);
        $this->call(ClasificacionSeeder::class);
        $this->call(SubClasificacionSeeder::class);
        $this->call(EditorialSeeder::class);
        $this->call(IdiomaSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(AutorSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(LibroSeeder::class);
        $this->call(LibrosXAutorSeeder::class);
        $this->call(UsuarioSeeder::class);
    }
}
