<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = Role::create(["name" => "Administrador"]);
        $director = Role::create(["name" => "Director"]);
        $bibliotecario = Role::create(["name" => "Bibliotecario"]);
        $profesor = Role::create(["name" => "Profesor"]);
        $estudiante = Role::create(["name" => "Estudiante"]);

        Permission::create(["name" => "dashboard"])->syncRoles([$administrador, $director, $bibliotecario, $profesor, $estudiante]);

        Permission::create(["name" => "usuario.index"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "usuario.store"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "usuario.update"])->syncRoles([$administrador, $bibliotecario]);

        Permission::create(["name" => "libro.index"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "libro.buscar"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "libro.ejemplares"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "libro.store"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "libro.search"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "libro.show"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "libro.update"])->syncRoles([$administrador, $bibliotecario]);

        Permission::create(["name" => "ejemplar.store"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "ejemplar.update"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "ejemplar.show"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);

        Permission::create(["name" => "prestamo.index"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "prestamo.store"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "prestamo.update"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "prestamo.show"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "prestamo.reporte"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "prestamo.historial"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "prestamo.mis-prestamos"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);

        Permission::create(["name" => "sancion.index"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "sancion.store"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "sancion.update"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "sancion.reporte"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "sancion.historial"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "sancion.mis-sanciones"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);

        Permission::create(["name" => "reservacion.index"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "reservacion.store"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "reservacion.update"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);

        Permission::create(["name" => "datatable.libros"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "datatable.prestamos"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "datatable.sanciones"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "datatable.usuarios"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "datatable.usuarios-habilitados"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "datatable.prestamos-sin-sancion"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "datatable.ejemplares"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "datatable.ejemplares-disponibles"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "datatable.reservaciones"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "datatable.mis-reservaciones"])->syncRoles([$administrador, $bibliotecario, $profesor, $estudiante]);
        Permission::create(["name" => "datatable.prestamos-reporte"])->syncRoles([$administrador, $bibliotecario]);
        Permission::create(["name" => "datatable.sanciones-reporte"])->syncRoles([$administrador, $bibliotecario]);
    }
}
