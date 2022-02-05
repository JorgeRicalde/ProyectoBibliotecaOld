<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class EstadoFisicoDelEjemplar extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'estados_fisicos_de_los_ejemplares';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['estado_fisico_del_ejemplar', 'descripcion'];

    /**
     * Verifica si existe el id en la tabla de estados_fisicos_de_los_ejemplares
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `EstadosFisicosEjemplaresExiste`(?)", [$id]));
    }

    /**
     * Las "Ejemplars"(Tabla: ejemplares) que pertenecen al "Estado Fisico de la Ejemplar"(Tabla: estados_fisicos_de_los_ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ejemplares(): BelongsToMany
    {
        return $this->belongsToMany(Ejemplar::class, 'ejemplares_x_estados_fisicos_de_los_ejemplares', 'estado_fisico_del_ejemplar_id', 'ejemplar_id');
    }

    /**
     * Obtener todas las "Ejemplars Tienen Estados Fisicos de las Ejemplars"(Tabla: ejemplares_x_estados_fisicos_de_los_ejemplares) del "Estado Fisico de la Ejemplar"(Tabla: estados_fisicos_de_los_ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejemplaresTienenEstadosFisicosDeLasEjemplars(): HasMany
    {
        return $this->hasMany(CopiesHasEstadoFisicoDelEjemplar::class, 'estado_fisico_del_ejemplar_id', 'id');
    }

    /**
     * Obtener todos los Estados Fisicos de la Ejemplar para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2EstadosFisicosDeLosEjemplares`()");
    }
}
