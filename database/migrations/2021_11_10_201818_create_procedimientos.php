<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProcedimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS EjemplaresBuscarPorID");
        DB::unprepared("CREATE PROCEDURE EjemplaresBuscarPorID(IN p_id INT) BEGIN SELECT ejemplares.id, ejemplares.libro_id, CONCAT(ejemplares.libro_id,'-',ejemplares.id,' ',libros.titulo) AS libro, ejemplares.estado_del_ejemplar_id, estados_de_los_ejemplares.estado_del_ejemplar, GROUP_CONCAT(DISTINCT estados_fisicos_de_los_ejemplares.id) AS estado_fisico_del_ejemplar_id, GROUP_CONCAT(DISTINCT estados_fisicos_de_los_ejemplares.estado_fisico_del_ejemplar SEPARATOR ', ') AS estado_fisico_del_ejemplar FROM ejemplares INNER JOIN estados_de_los_ejemplares ON estados_de_los_ejemplares.id = ejemplares.estado_del_ejemplar_id INNER JOIN libros ON libros.id = ejemplares.libro_id LEFT JOIN ejemplares_x_estados_fisicos_de_los_ejemplares ON ejemplares_x_estados_fisicos_de_los_ejemplares.ejemplar_id = ejemplares.id LEFT JOIN estados_fisicos_de_los_ejemplares ON estados_fisicos_de_los_ejemplares.id = ejemplares_x_estados_fisicos_de_los_ejemplares.estado_fisico_del_ejemplar_id WHERE ejemplares.id = p_id GROUP BY id, libro_id, libro, estado_del_ejemplar_id, estado_del_ejemplar; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS PrestamosBuscarPorID");
        DB::unprepared("CREATE PROCEDURE PrestamosBuscarPorID(IN p_id INT) BEGIN SELECT prestamos.id, prestamos.dias_de_prestamo, prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.estado_del_prestamo_id, estados_de_los_prestamos.estado_del_prestamo, prestamos.ejemplar_id, GROUP_CONCAT( DISTINCT ejemplares_x_estados_fisicos_de_los_ejemplares.estado_fisico_del_ejemplar_id ) AS estado_fisico_del_ejemplar_id, GROUP_CONCAT(DISTINCT estados_fisicos_de_los_ejemplares.estado_fisico_del_ejemplar SEPARATOR ', ') AS estado_fisico_del_ejemplar, ejemplares.libro_id, CONCAT(ejemplares.libro_id,'-',ejemplares.id,' ',libros.titulo) AS libro, prestamos.lector_id, CONCAT( reader.name, ' ', reader.last_name ) AS lector, prestamos.bibliotecario_id, CONCAT( librarian.name, ' ', librarian.last_name ) AS bibliotecario FROM prestamos INNER JOIN estados_de_los_prestamos ON estados_de_los_prestamos.id = prestamos.estado_del_prestamo_id INNER JOIN usuarios AS reader ON reader.id = prestamos.lector_id INNER JOIN usuarios AS librarian ON librarian.id = prestamos.bibliotecario_id INNER JOIN ejemplares ON ejemplares.id = prestamos.ejemplar_id INNER JOIN libros ON libros.id = ejemplares.libro_id LEFT JOIN ejemplares_x_estados_fisicos_de_los_ejemplares ON ejemplares_x_estados_fisicos_de_los_ejemplares.ejemplar_id = ejemplares.id LEFT JOIN estados_fisicos_de_los_ejemplares ON estados_fisicos_de_los_ejemplares.id = ejemplares_x_estados_fisicos_de_los_ejemplares.estado_fisico_del_ejemplar_id WHERE prestamos.id = p_id; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS PrestamosReportePorAnyoTrimestre");
        DB::unprepared("CREATE PROCEDURE PrestamosReportePorAnyoTrimestre(IN p_anyo INT, IN p_trimestre INT) BEGIN SELECT libros.id, libros.titulo AS libro, libros.cantidad_de_ejemplares, COUNT(prestamos.id) AS cantidad_de_prestamos FROM libros INNER JOIN ejemplares ON ejemplares.libro_id = libros.id INNER JOIN prestamos ON prestamos.ejemplar_id = ejemplares.id WHERE YEAR(prestamos.fecha_prestamo) = p_anyo AND QUARTER(prestamos.fecha_prestamo) = p_trimestre GROUP BY id, libro, cantidad_de_ejemplares; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS PrestamosReportePorAnyoMes");
        DB::unprepared("CREATE PROCEDURE PrestamosReportePorAnyoMes(IN p_anyo INT, IN p_mes INT) BEGIN SELECT libros.id, libros.titulo AS libro, libros.cantidad_de_ejemplares, COUNT(prestamos.id) AS cantidad_de_prestamos FROM libros INNER JOIN ejemplares ON ejemplares.libro_id = libros.id INNER JOIN prestamos ON prestamos.ejemplar_id = ejemplares.id WHERE YEAR(prestamos.fecha_prestamo) = p_anyo AND MONTH(prestamos.fecha_prestamo) = p_mes GROUP BY id, libro, cantidad_de_ejemplares; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS SancionesReportePorAnyoMes");
        DB::unprepared("CREATE PROCEDURE SancionesReportePorAnyoMes(IN p_anyo INT, IN p_mes INT) BEGIN SELECT sanciones.id, sanciones.lector_id, CONCAT(usuarios.name, ' ',usuarios.last_name) AS lector, usuarios.dni, usuarios.celular, sanciones.fecha_inicio, sanciones.fecha_fin, sanciones.estado_de_la_sancion_id, estados_de_las_sanciones.estado_de_la_sancion, sanciones.tipo_de_sancion_id, tipos_de_sanciones.tipo_de_sancion FROM sanciones INNER JOIN estados_de_las_sanciones ON estados_de_las_sanciones.id = sanciones.estado_de_la_sancion_id INNER JOIN tipos_de_sanciones ON tipos_de_sanciones.id = sanciones.tipo_de_sancion_id INNER JOIN usuarios ON usuarios.id = sanciones.lector_id WHERE YEAR(sanciones.fecha_inicio) = p_anyo AND MONTH(sanciones.fecha_inicio) = p_mes; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS SancionesReportePorAnyoTrimestre");
        DB::unprepared("CREATE PROCEDURE SancionesReportePorAnyoTrimestre(IN p_anyo INT, IN p_trimestre INT) BEGIN SELECT sanciones.id, sanciones.lector_id, CONCAT(usuarios.name, ' ',usuarios.last_name) AS lector, usuarios.dni, usuarios.celular, sanciones.fecha_inicio, sanciones.fecha_fin, sanciones.estado_de_la_sancion_id, estados_de_las_sanciones.estado_de_la_sancion, sanciones.tipo_de_sancion_id, tipos_de_sanciones.tipo_de_sancion FROM sanciones INNER JOIN estados_de_las_sanciones ON estados_de_las_sanciones.id = sanciones.estado_de_la_sancion_id INNER JOIN tipos_de_sanciones ON tipos_de_sanciones.id = sanciones.tipo_de_sancion_id INNER JOIN usuarios ON usuarios.id = sanciones.lector_id WHERE YEAR(sanciones.fecha_inicio) = p_anyo AND QUARTER(sanciones.fecha_inicio) = p_trimestre; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS SancionesHistorialDeUnLector");
        DB::unprepared("CREATE PROCEDURE SancionesHistorialDeUnLector(IN p_lector_id INT, IN p_fecha_desde DATE, IN p_fecha_hasta DATE) BEGIN SELECT sanciones.id, sanciones.fecha_inicio, sanciones.fecha_fin, sanciones.fecha_sancion, prestamos.fecha_prestamo, sanciones.estado_de_la_sancion_id, estados_de_las_sanciones.estado_de_la_sancion, sanciones.tipo_de_sancion_id, tipos_de_sanciones.tipo_de_sancion, prestamos.ejemplar_id, ejemplares.libro_id, libros.imagen, CONCAT(ejemplares.libro_id,'-',ejemplares.id,' ',libros.titulo) AS libro FROM sanciones INNER JOIN estados_de_las_sanciones ON estados_de_las_sanciones.id = sanciones.estado_de_la_sancion_id INNER JOIN tipos_de_sanciones ON tipos_de_sanciones.id = sanciones.tipo_de_sancion_id INNER JOIN prestamos ON prestamos.id = sanciones.id INNER JOIN ejemplares ON ejemplares.id = prestamos.ejemplar_id INNER JOIN libros ON libros.id = ejemplares.libro_id WHERE sanciones.lector_id = p_lector_id AND DATE(sanciones.fecha_inicio) BETWEEN p_fecha_desde AND p_fecha_hasta; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS PrestamosHistorialDeUnLector");
        DB::unprepared("CREATE PROCEDURE PrestamosHistorialDeUnLector(IN p_lector_id INT, IN p_fecha_desde DATE, IN p_fecha_hasta DATE) BEGIN SELECT prestamos.id, prestamos.dias_de_prestamo, prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.estado_del_prestamo_id, estados_de_los_prestamos.estado_del_prestamo, prestamos.bibliotecario_id, CONCAT(bibliotecarios.name, ' ', bibliotecarios.last_name) AS bibliotecario, prestamos.ejemplar_id, ejemplares.libro_id, libros.imagen, CONCAT(ejemplares.libro_id,'-',ejemplares.id,' ',libros.titulo) AS libro FROM prestamos INNER JOIN estados_de_los_prestamos ON estados_de_los_prestamos.id = prestamos.estado_del_prestamo_id INNER JOIN usuarios AS bibliotecarios ON bibliotecarios.id = prestamos.bibliotecario_id INNER JOIN ejemplares ON ejemplares.id = prestamos.ejemplar_id INNER JOIN libros ON libros.id = ejemplares.libro_id WHERE prestamos.lector_id = p_lector_id AND DATE(prestamos.fecha_prestamo) BETWEEN p_fecha_desde AND p_fecha_hasta; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EjemplaresActualizarEstado");
        DB::unprepared("CREATE PROCEDURE EjemplaresActualizarEstado(p_ejemplar_id INT, p_estado_del_ejemplar_id INT) BEGIN UPDATE ejemplares SET estado_del_ejemplar_id = p_estado_del_ejemplar_id WHERE id = p_ejemplar_id; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EjemplaresMarcarComoDisponible");
        DB::unprepared("CREATE PROCEDURE EjemplaresMarcarComoDisponible(p_ejemplar_id INT) BEGIN CALL EjemplaresActualizarEstado(p_ejemplar_id, 1); END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EjemplaresMarcarComoPrestado");
        DB::unprepared("CREATE PROCEDURE EjemplaresMarcarComoPrestado(p_ejemplar_id INT) BEGIN CALL EjemplaresActualizarEstado(p_ejemplar_id, 2); END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EjemplaresMarcarComoReservado");
        DB::unprepared("CREATE PROCEDURE EjemplaresMarcarComoReservado(p_ejemplar_id INT) BEGIN CALL EjemplaresActualizarEstado(p_ejemplar_id, 3); END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EjemplaresMarcarComoNoDisponible");
        DB::unprepared("CREATE PROCEDURE EjemplaresMarcarComoNoDisponible(p_ejemplar_id INT) BEGIN CALL EjemplaresActualizarEstado(p_ejemplar_id, 4); END");

        DB::unprepared("DROP PROCEDURE IF EXISTS UsuariosActualizarEstado");
        DB::unprepared("CREATE PROCEDURE UsuariosActualizarEstado(p_user_id INT, p_estado_del_usuario_id INT) BEGIN UPDATE usuarios SET estado_del_usuario_id = p_estado_del_usuario_id WHERE id = p_user_id; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS UsuariosHabilitar");
        DB::unprepared("CREATE PROCEDURE UsuariosHabilitar(p_user_id INT) BEGIN CALL UsuariosActualizarEstado(p_user_id, 1); END");

        DB::unprepared("DROP PROCEDURE IF EXISTS UsuariosSancionar");
        DB::unprepared("CREATE PROCEDURE UsuariosSancionar(p_user_id INT) BEGIN CALL UsuariosActualizarEstado(p_user_id, 2); END");

        DB::unprepared("DROP PROCEDURE IF EXISTS UsuariosDeshabilitar");
        DB::unprepared("CREATE PROCEDURE UsuariosDeshabilitar(p_user_id INT) BEGIN CALL UsuariosActualizarEstado(p_user_id, 3); END");

        DB::unprepared("DROP PROCEDURE IF EXISTS LibrosAumentarCantidadEjemplares");
        DB::unprepared("CREATE PROCEDURE LibrosAumentarCantidadEjemplares(IN p_libro_id INT) BEGIN UPDATE libros SET cantidad_de_ejemplares = cantidad_de_ejemplares + 1 WHERE id = p_libro_id; END");

        DB::unprepared("DROP PROCEDURE IF EXISTS EjemplaresXEstadosFisicosNuevo");
        DB::unprepared("CREATE PROCEDURE EjemplaresXEstadosFisicosNuevo(IN p_ejemplar_id INT) BEGIN INSERT INTO ejemplares_x_estados_fisicos_de_los_ejemplares SET ejemplar_id = p_ejemplar_id, estado_fisico_del_ejemplar_id = 1; END");
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
