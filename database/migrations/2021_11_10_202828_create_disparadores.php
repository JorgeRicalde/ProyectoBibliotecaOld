<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDisparadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS AfterEjemplaresInsert');
        DB::unprepared("CREATE TRIGGER AfterEjemplaresInsert AFTER INSERT ON ejemplares FOR EACH ROW BEGIN CALL LibrosAumentarCantidadEjemplares(NEW.libro_id); CALL EjemplaresXEstadosFisicosNuevo(NEW.id); END");

        DB::unprepared('DROP TRIGGER IF EXISTS AfterPrestamosInsert');
        DB::unprepared("CREATE TRIGGER AfterPrestamosInsert AFTER INSERT ON prestamos FOR EACH ROW BEGIN CASE WHEN NEW.estado_del_prestamo_id = 1 THEN CALL EjemplaresMarcarComoPrestado(NEW.ejemplar_id); WHEN NEW.estado_del_prestamo_id = 2 THEN CALL EjemplaresMarcarComoDisponible(NEW.ejemplar_id); WHEN NEW.estado_del_prestamo_id = 3 THEN CALL EjemplaresMarcarComoDisponible(NEW.ejemplar_id); END CASE; END");

        /* Para generar datos
        DB::unprepared('DROP TRIGGER IF EXISTS AfterPrestamosInsert');
        DB::unprepared("CREATE TRIGGER AfterPrestamosInsert AFTER INSERT ON
        prestamos FOR EACH ROW BEGIN DECLARE v_tipo_de_sancion_id INT; DECLARE v_estado_fisico_del_ejemplar_id INT; DECLARE v_id INT; DECLARE v_ejemplar_id INT; DECLARE v_fecha_inicio DATE; DECLARE v_fecha_fin DATE; DECLARE v_fecha_sancion DATETIME; DECLARE v_lector_id INT; DECLARE v_estado_de_la_sancion_id INT; CASE WHEN NEW.estado_del_prestamo_id = 1 THEN CALL EjemplaresMarcarComoPrestado(NEW.ejemplar_id); WHEN NEW.estado_del_prestamo_id = 2 THEN CALL EjemplaresMarcarComoDisponible(NEW.ejemplar_id); WHEN NEW.estado_del_prestamo_id = 3 THEN CALL EjemplaresMarcarComoDisponible(NEW.ejemplar_id); END CASE; IF(RAND() < 0.01) THEN SET v_tipo_de_sancion_id := FLOOR(RAND() *(5) +1); SET v_estado_fisico_del_ejemplar_id := v_tipo_de_sancion_id +1; SET v_id = NEW.id; SET v_ejemplar_id = NEW.ejemplar_id; SET v_fecha_inicio = DATE(NEW.fecha_devolucion); SET v_fecha_fin = DATE_ADD(v_fecha_inicio, INTERVAL 3 DAY); SET v_fecha_sancion := DATE_ADD( v_fecha_inicio, INTERVAL(RAND() *(18 -9 +1) +9) HOUR); SET v_lector_id = NEW.lector_id; SET v_estado_de_la_sancion_id := 1; INSERT INTO sanciones( id, fecha_inicio, fecha_fin, fecha_sancion, lector_id, estado_de_la_sancion_id, tipo_de_sancion_id ) VALUES( v_id, v_fecha_inicio, v_fecha_fin, v_fecha_sancion, v_lector_id, v_estado_de_la_sancion_id, v_tipo_de_sancion_id ); IF( SELECT COUNT(*) FROM ejemplares_x_estados_fisicos_de_los_ejemplares WHERE ejemplar_id = v_ejemplar_id AND estado_fisico_del_ejemplar_id = v_estado_fisico_del_ejemplar_id LIMIT 1 ) = 0 THEN INSERT INTO ejemplares_x_estados_fisicos_de_los_ejemplares SET ejemplar_id = v_ejemplar_id, estado_fisico_del_ejemplar_id = v_estado_fisico_del_ejemplar_id; END IF; END IF; END");
        */

        DB::unprepared('DROP TRIGGER IF EXISTS AfterPrestamosUpdate');
        DB::unprepared("CREATE TRIGGER AfterPrestamosUpdate AFTER UPDATE ON prestamos FOR EACH ROW BEGIN IF NEW.ejemplar_id <> OLD.ejemplar_id THEN CALL EjemplaresMarcarComoDisponible(OLD.ejemplar_id); CALL EjemplaresMarcarComoReservado(NEW.ejemplar_id); END IF; IF NEW.estado_del_prestamo_id <> OLD.estado_del_prestamo_id THEN CASE WHEN NEW.estado_del_prestamo_id = 1 THEN CALL EjemplaresMarcarComoPrestado(NEW.ejemplar_id); WHEN NEW.estado_del_prestamo_id = 2 THEN CALL EjemplaresMarcarComoDisponible(NEW.ejemplar_id); WHEN NEW.estado_del_prestamo_id = 3 THEN CALL EjemplaresMarcarComoDisponible(NEW.ejemplar_id); END CASE; END IF; END");

        DB::unprepared('DROP TRIGGER IF EXISTS AfterSancionesInsert');
        DB::unprepared("CREATE TRIGGER AfterSancionesInsert AFTER INSERT ON sanciones FOR EACH ROW BEGIN CASE WHEN NEW.estado_de_la_sancion_id = 1 THEN CALL UsuariosSancionar(NEW.lector_id); WHEN NEW.estado_de_la_sancion_id = 2 THEN CALL UsuariosHabilitar(NEW.lector_id); WHEN NEW.estado_de_la_sancion_id = 3 THEN CALL UsuariosHabilitar(NEW.lector_id); END CASE; END");

        DB::unprepared('DROP TRIGGER IF EXISTS AfterSancionesUpdate');
        DB::unprepared("CREATE TRIGGER AfterSancionesUpdate AFTER UPDATE ON sanciones FOR EACH ROW BEGIN IF NEW.lector_id <> OLD.lector_id THEN CALL UsuariosHabilitar(OLD.lector_id); CALL UsuariosSancionar(NEW.lector_id); END IF; IF NEW.estado_de_la_sancion_id <> OLD.estado_de_la_sancion_id THEN CASE WHEN NEW.estado_de_la_sancion_id = 1 THEN CALL UsuariosSancionar(NEW.lector_id); WHEN NEW.estado_de_la_sancion_id = 2 THEN CALL UsuariosHabilitar(NEW.lector_id); WHEN NEW.estado_de_la_sancion_id = 3 THEN CALL UsuariosHabilitar(NEW.lector_id); END CASE; END IF; END");

        DB::unprepared('DROP TRIGGER IF EXISTS AfterReservacionesInsert');
        DB::unprepared("CREATE TRIGGER AfterReservacionesInsert AFTER INSERT ON reservaciones FOR EACH ROW BEGIN CALL EjemplaresMarcarComoReservado(NEW.ejemplar_id); END");

        DB::unprepared('DROP TRIGGER IF EXISTS AfterReservacionesUpdate');
        DB::unprepared("CREATE TRIGGER AfterReservacionesUpdate AFTER UPDATE ON reservaciones FOR EACH ROW BEGIN IF NEW.ejemplar_id <> OLD.ejemplar_id THEN CALL EjemplaresMarcarComoDisponible(OLD.ejemplar_id); CALL EjemplaresMarcarComoReservado(NEW.ejemplar_id); END IF; END");

        DB::unprepared('DROP EVENT IF EXISTS DeshabilitarSanciones');
        DB::unprepared("CREATE EVENT DeshabilitarSanciones ON SCHEDULE EVERY 1 DAY STARTS '2021-11-21 00:30:00' ON COMPLETION PRESERVE ENABLE DO UPDATE sanciones SET estado_de_la_sancion_id = 2 WHERE estado_de_la_sancion_id = 1 AND CURRENT_DATE() > fecha_fin");
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
