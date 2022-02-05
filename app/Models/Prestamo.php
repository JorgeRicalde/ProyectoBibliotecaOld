<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Prestamo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'prestamos';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['dias_de_prestamo', 'fecha_prestamo', 'fecha_devolucion', 'estado_del_prestamo_id', 'ejemplar_id', 'lector_id', 'bibliotecario_id'];

    /**
     * Crea un array con un mensaje para el metodo Store
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeStore(): array
    {
        return ["mensaje" => "Se registo el Prestamo"];
    }

    /**
     * Crea un array con un mensaje para el metodo Update
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeUpdate(): array
    {
        return ["mensaje" => "Se actualizaron los datos del Prestamo"];
    }

    /**
     * Verifica si existe el id en la tabla de prestamos
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `PrestamosExiste`(?)", [$id]));
    }

    /**
     * Retorna un el Historial de Prestamos de un Lector
     *
     */
    public static function prestamosHistorialDeUnLector(int $lector_id, string $fecha_desde, string $fecha_hasta): array
    {
        return DB::select("CALL `PrestamosHistorialDeUnLector`(?, ?, ?)", [$lector_id, $fecha_desde, $fecha_hasta]);
    }

    /**
     * Retorna un Reporte de Prestamos por Año y Trimestre
     *
     */
    public static function prestamosReportePorAnyoTrimestre(int $anyo, int $trimestre): array
    {
        return DB::select("CALL `PrestamosReportePorAnyoTrimestre`(?, ?)", [$anyo, $trimestre]);
    }

    /**
     * Retorna un Reporte de Prestamos por Año y Mes
     *
     */
    public static function prestamosReportePorAnyoMes(int $anyo, int $mes): array
    {
        return DB::select("CALL `PrestamosReportePorAnyoMes`(?, ?)", [$anyo, $mes]);
    }

    /**
     * Retorna la cantidad de resultados de Listar Prestamos Sin Sancion
     *
     */
    public static function buscarPrestamoPorID(string $prestamo_id): array
    {
        return DB::select("CALL `PrestamosBuscarPorID`(?)", [$prestamo_id]);
    }

    /**
     * Retorna la cantidad de resultados de Listar Prestamos Sin Sancion
     *
     */
    public static function cantidadListarPrestamosSinSancion(string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarPrestamosSinSancion`(?)", [$texto])[0]->cantidad;
    }

    /**
     * Crea un array que contiene la informacion de todos los prestamos sin sancion
     *
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarPrestamosSinSancion(array $data): array
    {
        return DB::select("CALL `DataTablesListarPrestamosSinSancion`(?, ?, ?, ?, ?)", [$data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }


    /**
     * Retorna la cantidad de resultados de Listar Prestamos
     *
     */
    public static function cantidadListarPrestamos(string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarPrestamos`(?)", [$texto])[0]->cantidad;
    }

    /**
     * Crea un array que contiene la informacion de todos los prestamos
     *
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarPrestamos(array $data): array
    {
        return DB::select("CALL `DataTablesListarPrestamos`(?, ?, ?, ?, ?)", [$data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Verifica si la ejemplar se encuentra en el prestamo
     *
     */
    public static function estaElEjemplarEnElPrestamo(int $ejemplar_id, int $prestamo_id): bool
    {
        return boolval(DB::select('SELECT id FROM prestamos WHERE ejemplar_id = ? AND id = ? LIMIT 1', [$ejemplar_id, $prestamo_id]));
    }

    /**
     * Obtener la "Ejemplar"(Tabla: ejemplares) del Libro que se Presto(Tabla: prestamos)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ejemplar(): BelongsTo
    {
        return $this->belongsTo(Ejemplar::class, 'ejemplar_id', 'id');
    }

    /**
     * Obtener la "Sanción"(Tabla: sanciones) asociada al "Préstamo"(Tabla: prestamos)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sancion(): HasOne
    {
        return $this->hasOne(Usuario::class, 'id', 'id');
    }

    /**
     * Obtenga el "Estado del Préstamo"(Tabla: estados_de_los_prestamos) que tiene el "Préstamo"(Tabla: prestamos)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoDelPrestamo(): BelongsTo
    {
        return $this->belongsTo(EstadoDelPrestamo::class, 'estado_del_prestamo_id', 'id');
    }


    /**
     * Obtener el "Bibliotecario"(Tabla: usuarios) que realizo del "Préstamo"(Tabla: prestamos)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuarioBibliotecario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'bibliotecario_id', 'id');
    }

    /**
     * Obtener el "Lector"(Tabla: usuarios) que pidio del "Préstamo"(Tabla: prestamos)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuarioLector(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'lector_id', 'id');
    }
}
