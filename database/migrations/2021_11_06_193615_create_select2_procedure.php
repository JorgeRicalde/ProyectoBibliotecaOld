<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSelect2Procedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS Select2EstadosDeLosUsuarios");
        DB::unprepared("CREATE PROCEDURE Select2EstadosDeLosUsuarios() BEGIN SELECT id AS id, estado_del_usuario AS text FROM estados_de_los_usuarios; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2EstadosDeLosEjemplares");
        DB::unprepared("CREATE PROCEDURE Select2EstadosDeLosEjemplares() BEGIN SELECT id AS id, estado_del_ejemplar AS text FROM estados_de_los_ejemplares; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2EstadosFisicosDeLosEjemplares");
        DB::unprepared("CREATE PROCEDURE Select2EstadosFisicosDeLosEjemplares() BEGIN SELECT id AS id, estado_fisico_del_ejemplar AS text FROM estados_fisicos_de_los_ejemplares; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2TiposDeSanciones");
        DB::unprepared("CREATE PROCEDURE Select2TiposDeSanciones() BEGIN SELECT id AS id, CONCAT(tipo_de_sancion,' - ',cantidad_de_dias,' dias') AS text FROM tipos_de_sanciones; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2EstadosDeLasSanciones");
        DB::unprepared("CREATE PROCEDURE Select2EstadosDeLasSanciones() BEGIN SELECT id AS id, estado_de_la_sancion AS text FROM estados_de_las_sanciones; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2SubClasificaciones");
        DB::unprepared("CREATE PROCEDURE Select2SubClasificaciones() BEGIN SELECT sub_clasificaciones.id AS id, CONCAT(sub_clasificaciones.sub_clasificacion,' - ',clasificaciones.clasificacion) AS text FROM sub_clasificaciones INNER JOIN clasificaciones ON sub_clasificaciones.clasificacion_id = clasificaciones.id; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2EstadosDeLosPrestamos");
        DB::unprepared("CREATE PROCEDURE Select2EstadosDeLosPrestamos() BEGIN SELECT id AS id, estado_del_prestamo AS text FROM estados_de_los_prestamos; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2Idiomas");
        DB::unprepared("CREATE PROCEDURE Select2Idiomas() BEGIN SELECT id AS id, idioma AS text FROM idiomas; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2Generos");
        DB::unprepared("CREATE PROCEDURE Select2Generos() BEGIN SELECT id AS id, genero AS text FROM generos; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2Editoriales");
        DB::unprepared("CREATE PROCEDURE Select2Editoriales() BEGIN SELECT id AS id, editorial AS text FROM editoriales; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2Clasificaciones");
        DB::unprepared("CREATE PROCEDURE Select2Clasificaciones() BEGIN SELECT id AS id, clasificacion AS text FROM clasificaciones; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2Autores");
        DB::unprepared("CREATE PROCEDURE Select2Autores() BEGIN SELECT id AS id , CONCAT(nombre, ' ' , apellido) AS text FROM autores; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2Libros");
        DB::unprepared("CREATE PROCEDURE Select2Libros() BEGIN SELECT id AS id , titulo AS text FROM libros; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2LibrosPaginado");
        DB::unprepared("CREATE PROCEDURE Select2LibrosPaginado(IN titulo VARCHAR(255),IN saltar INT, IN tomar INT) BEGIN PREPARE stmt FROM CONCAT('SELECT id AS id , titulo AS text FROM libros WHERE titulo LIKE \"%',titulo,'%\" LIMIT ',saltar,',',tomar); EXECUTE stmt; DEALLOCATE PREPARE stmt; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS Select2Roles");
        DB::unprepared("CREATE PROCEDURE Select2Roles() BEGIN SELECT id AS id, name AS text FROM roles; END");
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
