<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class EstadoDelEjemplar extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'estados_de_los_ejemplares';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['estado_del_ejemplar'];

    /**
     * Verifica si existe el id en la tabla de estados_de_los_ejemplares
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `EstadosEjemplaresExiste`(?)", [$id]));
    }

    /**
     * Obtener todas las "Ejemplars"(Tabla: ejemplares) del "Estado de la Ejemplar"(Tabla: estados_de_los_ejemplares)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejemplares(): HasMany
    {
        return $this->hasMany(Ejemplar::class, 'estado_del_ejemplar_id', 'id');
    }

    /**
     * Obtener todos los Estados de la Ejemplar para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2EstadosDeLosEjemplares`()");
    }
}
