<?php

namespace Database\Seeders;

use App\Models\Ejemplar;
use App\Models\Prestamo;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'name' => "Jorge Luis",
            'last_name' => "Ricalde Yurivilca",
            'dni' => '70485433',
            'celular' => '922304010',
            'email' => 'jorgeluisricalde@gmail.com',
            'email_verified_at' => null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'imagen' => 'http://127.0.0.1:8000/images/usuarios/default-user.png',
            'remember_token' => null,
            'estado_del_usuario_id' => 1,
            'genero_id' => 1
        ])->assignRole(1)->createToken('auth_token');
        $usuarios = Usuario::factory(200)->create();
        $roles = Role::all();
        foreach ($usuarios as $user) {
            $user->assignRole($roles->random(1));
        }/* Para generar datos
        $ejemplares = Ejemplar::all(['id']);
        $cantidadUsuarios = $usuarios->count() - 1;
        $cantidadEjemplares = $ejemplares->count() - 1;
        $fechaInicio = Carbon::parse("2017-01-01 09:00:00");
        $fechaFin = Carbon::parse("2021-11-26 18:00:00");
        while ($fechaInicio->lt($fechaFin)) {
            $fechaActual = $fechaInicio->copy();
            $data = [];
            for ($i = 0; $i < 60; $i++) {
                $dias = rand(1, 14);
                $fechaDevolucion = $fechaActual->copy()->addDays($dias)->toDateTimeString();
                $data[$i] = [
                    'dias_de_prestamo' => $dias,
                    'fecha_prestamo' => $fechaActual->toDateTimeString(),
                    'fecha_devolucion' => $fechaDevolucion,
                    'estado_del_prestamo_id' => 2,
                    'ejemplar_id' => $ejemplares[rand(0, $cantidadEjemplares)]["id"],
                    'lector_id' => $usuarios[rand(0, $cantidadUsuarios)]["id"],
                    'bibliotecario_id' => 1,
                ];
                $fechaActual->addMinutes(10);
            }
            Prestamo::insert($data);
            unset($data);
            $fechaInicio->addDays(1);
        }*/
    }
}
