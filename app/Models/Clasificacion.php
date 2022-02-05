<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Clasificacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'clasificaciones';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['clasificacion', 'codigo_dewey'];

    /**
     * Verifica si existe el id en la tabla de libros_x_sub_clasificaciones
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `ClasificacionesExiste`(?)", [$id]));
    }

    /**
     * Obtener todas las "Subclasificaciones"(Tabla: sub_clasificaciones) para la "Clasificación"(Tabla: clasificaciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subClasificaciones(): HasMany
    {
        return $this->hasMany(subClasificacions::class, 'clasificacion_id', 'id');
    }

    /**
     * Obtener todas los Clasificaciones para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2Clasificaciones`()");
    }
}
