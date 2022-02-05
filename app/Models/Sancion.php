<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Sancion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sanciones';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['fecha_inicio', 'fecha_fin',  'fecha_sancion', 'lector_id', 'estado_de_la_sancion_id', 'tipo_de_sancion_id', 'id'];

    /**
     * Crea un array con un mensaje para el metodo Store
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeStore(): array
    {
        return ["mensaje" => "Se registro la Sancion"];
    }

    /**
     * Crea un array con un mensaje para el metodo Update
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeUpdate(): array
    {
        return ["mensaje" => "Se actualizaron los datos del Sancion"];
    }

    /**
     * Verifica si existe el id en la tabla de sanciones
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `SancionesExiste`(?)", [$id]));
    }

    /**
     * Retorna el Historial de sanciones de un lector
     *
     */
    public static function sancionesHistorialDeUnLector(int $lector_id, string $fecha_desde, string $fecha_hasta): array
    {
        return DB::select("CALL `SancionesHistorialDeUnLector`(?, ?, ?)", [$lector_id, $fecha_desde, $fecha_hasta]);
    }

    /**
     * Retorna un Reporte de Sanciones por Año y Trimestre
     *
     */
    public static function sancionesReportePorAnyoTrimestre(int $anyo, int $trimestre): array
    {
        return DB::select("CALL `SancionesReportePorAnyoTrimestre`(?, ?)", [$anyo, $trimestre]);
    }

    /**
     * Retorna un Reporte de Sanciones por Año y Mes
     *
     */
    public static function sancionesReportePorAnyoMes(int $anyo, int $mes): array
    {
        return DB::select("CALL `SancionesReportePorAnyoMes`(?, ?)", [$anyo, $mes]);
    }

    /**
     * Retorna la cantidad de resultados de Listar Sanciones
     *
     */
    public static function cantidadListarSanciones(string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarSanciones`(?)", [$texto])[0]->cantidad;
    }

    /**
     * Crea un array que contiene la informacion de todas las sanciones
     *
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarSanciones(array $data): array
    {
        return DB::select("CALL `DataTablesListarSanciones`(?, ?, ?, ?, ?)", [$data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Obtener el "Préstamo"(Tabla: prestamos) al que pertenece la "Sanción"(Tabla: sanciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class, 'id', 'id');
    }

    /**
     * Obtener el "Estado de la Sancion"(Tabla: estados_de_las_sanciones) que posee la "Sanción"(Tabla: sanciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoDeLaSancion(): BelongsTo
    {
        return $this->belongsTo(EstadoDeLaSancion::class, 'estado_de_la_sancion_id', 'id');
    }

    /**
     * Obtener los "Tipo de Sanción"(Tabla: tipos_de_sanciones) que posee la "Sanción"(Tabla: sanciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoDeSancion(): BelongsTo
    {
        return $this->belongsTo(TipoDeSancion::class, 'tipo_de_sancion_id', 'id');
    }

    /**
     * Obtener el "Usuario"(Tabla: usuarios) al que se le aplico de la "Sanción"(Tabla: sanciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'user_id', 'id');
    }
}
