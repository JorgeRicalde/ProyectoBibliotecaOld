<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class EstadoDeLaSancion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'estados_de_las_sanciones';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['estado_de_la_sancion'];

    /**
     * Verifica si existe el id en la tabla de estados_de_las_sanciones
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `EstadosSancionesExiste`(?)", [$id]));
    }

    /**
     * Obtener todas las "Sanciones"(Tabla: sanciones) del "Estado de la Sancion"(Tabla: estados_de_los_prestamos)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sanciones(): HasMany
    {
        return $this->hasMany(Sancion::class, 'estado_de_la_sancion_id', 'id');
    }

    /**
     * Obtener todos los Estados de Usuario para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2EstadosDeLasSanciones`()");
    }
}
