<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class SubClasificacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sub_clasificaciones';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['sub_clasificacion', 'codigo_dewey', 'clasificacion_id'];

    /**
     * Verifica si existe el id en la tabla de sub_clasificaciones
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `SubClasificacionesExiste`(?)", [$id]));
    }

    /**
     * Los "Libro"(Tabla: libros) que pertenecen a la "Subclasificación"(Tabla: sub_clasificaciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'libros_x_sub_clasificaciones', 'sub_clasificacion_id', 'libro_id');
    }

    /**
     * Obtener la "Clasificación"(Tabla: clasificaciones) asociada con la "Subclasificación"(Tabla: sub_clasificaciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clasificacion(): HasOne
    {
        return $this->hasOne(Clasificacion::class, 'id', 'clasificacion_id');
    }

    /**
     * Obtener todas las SubClasificaciones para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2SubClasificaciones`()");
    }
}
