<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Reservacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'reservaciones';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['dias_de_prestamo', 'fecha_de_reservacion', 'ejemplar_id', 'lector_id'];

    /**
     * Crea un array con un mensaje para el metodo Store
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeStore(): array
    {
        return ["mensaje" => "Se registo la reserva"];
    }

    /**
     * Crea un array con un mensaje para el metodo Update
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeUpdate(): array
    {
        return ["mensaje" => "Se actualizaron los datos de la reserva"];
    }

    /**
     * Verifica si existe el id en la tabla de reservaciones
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `ReservacionesExiste`(?)", [$id]));
    }

    /**
     * Retorna la cantidad de resultados de Listar Reservaciones
     *
     */
    public static function cantidadListarReservaciones(string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarReservaciones`(?)", [$texto])[0]->cantidad;
    }

    /**
     * Crear un array con todas las reservaciones
     *
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarReservaciones(array $data): array
    {
        return DB::select("CALL `DataTablesListarReservaciones`(?, ?, ?, ?, ?)", [$data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Retorna la cantidad de resultados de Listar Reservaciones
     *
     */
    public static function cantidadListarReservacionesDeUnUsuario(int $usuario_id, string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarReservacionesDeUnUsuario`(?, ?)", [$usuario_id, $texto])[0]->cantidad;
    }

    /**
     * Crear un array con todas las reservaciones de un usuario
     *
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarReservacionesDeUnUsuario(int $usuario_id, array $data): array
    {
        return DB::select("CALL `DataTablesListarReservacionesDeUnUsuario`(?, ?, ?, ?, ?, ?)", [$usuario_id, $data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Verifica si la ejemplar se encuentra en la reserva
     *
     */
    public static function estaElEjemplarEnLaReserva(int $ejemplar_id, int $reservacion_id): bool
    {
        return boolval(DB::select('SELECT id FROM reservaciones WHERE ejemplar_id = ? AND id = ? LIMIT 1', [$ejemplar_id, $reservacion_id]));
    }

    /**
     * Obtener la "Ejemplar"(Tabla: ejemplares) asociada a la "Reserva"(Tabla: reservaciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejemplar(): HasOne
    {
        return $this->hasOne(Ejemplar::class, 'id', 'ejemplar_id');
    }

    /**
     * Obtener el "Usuario"(Tabla: usuarios) que realizo la "Reserva"(Tabla: reservaciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario(): HasOne
    {
        return $this->hasOne(Usuario::class, 'id', 'lector_id');
    }
}
