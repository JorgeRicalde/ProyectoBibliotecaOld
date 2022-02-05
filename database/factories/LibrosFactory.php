<?php

namespace Database\Factories;

use App\Models\Libro;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LibroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Libro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titulo = $this->faker->text(150);
        return [
            'titulo' => $titulo,
            'titulo_slug' => Str::slug($titulo, "-", "es"),
            'anyo_de_lanzamiento' => $this->faker->numberBetween(1990, 2020),
            'imagen' => $this->faker->imageUrl(300, 300),
            'idioma_id' => $this->faker->numberBetween(1, 3),
            'editorial_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
