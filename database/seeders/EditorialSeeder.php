<?php

namespace Database\Seeders;

use App\Models\Editorial;
use Illuminate\Database\Seeder;

class EditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Editorial::insert(
            [
                ['editorial' => 'Santillana'],
                ['editorial' => 'Bruño'],
                ['editorial' => 'Norma'],
                ['editorial' => 'San Marcos'],
                ['editorial' => 'Acantilado'],
                ['editorial' => 'Aguilar'],
                ['editorial' => 'Alianza'],
                ['editorial' => 'Gredos'],
                ['editorial' => 'Tauros'],
                ['editorial' => 'Akal'],
                ['editorial' => 'Alba'],
                ['editorial' => 'Alfguara'],
                ['editorial' => 'Almadia'],
                ['editorial' => 'Anagrama'],
                ['editorial' => 'Alpha Decay'],
                ['editorial' => 'Ariel'],
                ['editorial' => 'Atalanta'],
                ['editorial' => 'Caja Negra'],
                ['editorial' => 'Catedra'],
                ['editorial' => 'Gustavo Gili'],
                ['editorial' => 'Herder'],
                ['editorial' => 'Impedimenta'],
                ['editorial' => 'Joaquin Mortiz'],
                ['editorial' => 'La esfera de los libros'],
                ['editorial' => 'Library of America'],
                ['editorial' => 'Lumen'],
                ['editorial' => 'Nevsky'],
                ['editorial' => 'Olañeta'],
                ['editorial' => 'Paidos'],
                ['editorial' => 'Penguin Libros'],
                ['editorial' => 'Phaidon'],
                ['editorial' => 'Planeta'],
                ['editorial' => 'Plaza y Janés'],
                ['editorial' => 'RM'],
                ['editorial' => 'Sajalín'],
                ['editorial' => 'Salamandra'],
                ['editorial' => 'Satori'],
                ['editorial' => 'Seix Barral'],
                ['editorial' => 'Sexto Piso'],
                ['editorial' => 'Siglo XXI'],
                ['editorial' => 'Siruela'],
                ['editorial' => 'Taschen'],
                ['editorial' => 'Trotta'],
                ['editorial' => 'Tusquets'],
                ['editorial' => 'Urano'],
                ['editorial' => 'Valdemar'],
                ['editorial' => 'Eureka']
            ]
        );
    }
}
