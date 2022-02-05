<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Ejemplar extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ejemplares';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['estado_del_ejemplar_id', 'libro_id'];

    /**
     * Crea un array con un mensaje para el metodo Store
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeStore(): array
    {
        return ["mensaje" => "Se registo la ejemplar"];
    }

    /**
     * Crea un array con un mensaje para el metodo Update
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeUpdate(): array
    {
        return ["mensaje" => "Se actualizaron los datos de la ejemplar"];
    }

    /**
     * Verifica si existe el id en la tabla de ejemplares
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `EjemplaresExiste`(?)", [$id]));
    }

    /**
     * Verifica si existe el id en la tabla de ejemplares
     *
     */
    public static function insertarVariosEjemplares(int $cantidad_ejemplares, int $libro_id): bool
    {
        $ejemplares = [];
        for ($i = 0; $i < $cantidad_ejemplares; $i++) {
            $ejemplares[$i] = ["estado_del_ejemplar_id" => 1, "libro_id" => $libro_id];
        }
        return Ejemplar::insert($ejemplares);
    }

    /**
     * Retorna la cantidad de resultados de Listar Ejemplares Del Libro Por ID
     *
     */
    public static function buscarEjemplarPorID(string $ejemplar_id): array
    {
        return DB::select("CALL `EjemplaresBuscarPorID`(?)", [$ejemplar_id]);
    }

    /**
     * Retorna la cantidad de resultados de Listar Ejemplares Del Libro Por ID
     *
     */
    public static function cantidadListarEjemplaresDelLibroPorID(string $libro_id, string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarEjemplaresDelLibroPorID`(?, ?)", [$libro_id, $texto])[0]->cantidad;
    }

    /**
     * Crea un array que contiene la informacion de las ejemplares de un libro
     *
     * @param string $libro_id
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarEjemplaresDelLibroPorID(string $libro_id, array $data): array
    {
        return DB::select("CALL `DataTablesListarEjemplaresDelLibroPorID`(?, ?, ?, ?, ?, ?)", [$libro_id, $data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Retorna la cantidad de resultados de Listar Ejemplares Del Libro Por ID
     *
     */
    public static function cantidadListarEjemplaresDisponiblesDelLibroPorID(string $libro_id, string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarEjemplaresDisponiblesDelLibroPorID`(?, ?)", [$libro_id, $texto])[0]->cantidad;
    }

    /**
     * Crea un array que contiene la informacion de las ejemplares disponibles de un libro
     *
     * @param string $libro_id
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarEjemplaresDisponiblesDelLibroPorID(string $libro_id, array $data): array
    {
        return DB::select("CALL `DataTablesListarEjemplaresDisponiblesDelLibroPorID`(?, ?, ?, ?, ?, ?)", [$libro_id, $data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Verifica que el ejemplar este disponible
     *
     */
    public static function estaDisponible(string $ejemplar_id): bool
    {
        return boolval(DB::select('SELECT id FROM ejemplares WHERE id = ? AND estado_del_ejemplar_id = 1 LIMIT 1', [$ejemplar_id]));
    }

    /**
     * Verifica que el ejemplar este disponible o reservado
     *
     */
    public static function estaDisponibleOReservado(string $ejemplar_id): bool
    {
        return boolval(DB::select('SELECT id FROM ejemplares WHERE id = ? AND (estado_del_ejemplar_id = 1 OR estado_del_ejemplar_id = 3) LIMIT 1', [$ejemplar_id]));
    }

    /**
     * Obtener el "Libro"(Tabla: libros) al que pertenece la "Ejemplar"(Tabla: ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class, 'libro_id', 'id');
    }

    /**
     * Obtener los "Estados Físicos de la Ejemplar"(Tabla: estados_fisicos_de_los_ejemplares) al que pertenece la "Ejemplar"(Tabla: ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function estadosFisicosDeLaEjemplar(): BelongsToMany
    {
        return $this->belongsToMany(EstadoFisicoDelEjemplar::class, 'ejemplares_x_estados_fisicos_de_los_ejemplares', 'ejemplar_id', 'estado_fisico_del_ejemplar_id');
    }

    /**
     * Obtener todas las "Ejemplars Tienen Estados Fisicos de las Ejemplars"(Tabla: ejemplares_x_estados_fisicos_de_los_ejemplares) para la "Ejemplar"(Tabla: ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejemplaresTieneEstadosFisicoDeLasEjemplars(): HasMany
    {
        return $this->hasMany(CopiesHasEstadoFisicoDelEjemplar::class, 'ejemplar_id', 'id');
    }

    /**
     * Obtener todos los "Préstamos"(Tabla: prestamos) donde se encuentre la "Ejemplar"(Tabla: ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'ejemplar_id', 'id');
    }

    /**
     * Obtener todas las "Reservaciones"(Tabla: reservaciones) donde se encuentre la "Ejemplar"(Tabla: ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservaciones(): HasMany
    {
        return $this->hasMany(Reservacion::class, 'ejemplar_id', 'id');
    }

    /**
     * Obtener el "Estado de La Ejemplar"(Tabla: estados_de_los_ejemplares) que posee la "Ejemplar"(Tabla: ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoDeLaEjemplar(): BelongsTo
    {
        return $this->belongsTo(EstadoDelEjemplar::class, 'estado_del_ejemplar_id', 'id');
    }
}
