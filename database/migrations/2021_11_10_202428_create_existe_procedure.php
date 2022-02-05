<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateExisteProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ClasificacionesExiste");
        DB::unprepared("CREATE PROCEDURE ClasificacionesExiste(IN p_id INT) BEGIN SELECT id FROM clasificaciones WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EditorialesExiste");
        DB::unprepared("CREATE PROCEDURE EditorialesExiste(IN p_id INT) BEGIN SELECT id FROM editoriales WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EjemplaresExiste");
        DB::unprepared("CREATE PROCEDURE EjemplaresExiste(IN p_id INT) BEGIN SELECT id FROM ejemplares WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EstadosEjemplaresExiste");
        DB::unprepared("CREATE PROCEDURE EstadosEjemplaresExiste(IN p_id INT) BEGIN SELECT id FROM estados_de_los_ejemplares WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EstadosFisicosEjemplaresExiste");
        DB::unprepared("CREATE PROCEDURE EstadosFisicosEjemplaresExiste(IN p_id INT) BEGIN SELECT id FROM estados_fisicos_de_los_ejemplares WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EstadosPrestamosExiste");
        DB::unprepared("CREATE PROCEDURE EstadosPrestamosExiste(IN p_id INT) BEGIN SELECT id FROM estados_de_los_prestamos WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EstadosSancionesExiste");
        DB::unprepared("CREATE PROCEDURE EstadosSancionesExiste(IN p_id INT) BEGIN SELECT id FROM estados_de_las_sanciones WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EstadosUsuariosExiste");
        DB::unprepared("CREATE PROCEDURE EstadosUsuariosExiste(IN p_id INT) BEGIN SELECT id FROM estados_de_los_usuarios WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS GenerosExiste");
        DB::unprepared("CREATE PROCEDURE GenerosExiste(IN p_id INT) BEGIN SELECT id FROM generos WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS IdiomasExiste");
        DB::unprepared("CREATE PROCEDURE IdiomasExiste(IN p_id INT) BEGIN SELECT id FROM idiomas WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS LibrosExiste");
        DB::unprepared("CREATE PROCEDURE LibrosExiste(IN p_id INT) BEGIN SELECT id FROM libros WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS PrestamosExiste");
        DB::unprepared("CREATE PROCEDURE PrestamosExiste(IN p_id INT) BEGIN SELECT id FROM prestamos WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS ReservacionesExiste");
        DB::unprepared("CREATE PROCEDURE ReservacionesExiste(IN p_id INT) BEGIN SELECT id FROM reservaciones WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS RolesExiste");
        DB::unprepared("CREATE PROCEDURE RolesExiste(IN p_id INT) BEGIN SELECT id FROM roles WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS SancionesExiste");
        DB::unprepared("CREATE PROCEDURE SancionesExiste(IN p_id INT) BEGIN SELECT id FROM sanciones WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS SubClasificacionesExiste");
        DB::unprepared("CREATE PROCEDURE SubClasificacionesExiste(IN p_id INT) BEGIN SELECT id FROM sub_clasificaciones WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS TiposSancionesExiste");
        DB::unprepared("CREATE PROCEDURE TiposSancionesExiste(IN p_id INT) BEGIN SELECT id FROM tipos_de_sanciones WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS UsuariosExiste");
        DB::unprepared("CREATE PROCEDURE UsuariosExiste(IN p_id INT) BEGIN SELECT id FROM usuarios WHERE id = p_id LIMIT 1; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS AutoresExiste");
        DB::unprepared("CREATE PROCEDURE AutoresExiste(IN p_id INT) BEGIN SELECT id FROM autores WHERE id = p_id LIMIT 1; END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
