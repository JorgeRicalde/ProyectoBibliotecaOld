<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genero_id = $this->faker->randomElement([1, 2]);
        $genero = ($genero_id == 1) ? 'male' : 'female';
        return [
            'name' => $this->faker->firstName($genero),
            'last_name' => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'dni' => $this->faker->unique()->dni(),
            'celular' => $this->faker->randomNumber(9, true),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'imagen' => 'http://127.0.0.1:8000/images/usuarios/default-user.png',
            'remember_token' => null,
            'estado_del_usuario_id' => 1,
            'genero_id' => $genero_id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
