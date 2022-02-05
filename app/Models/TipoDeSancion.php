<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class TipoDeSancion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tipos_de_sanciones';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['tipo_de_sancion', 'cantidad_de_dias'];

    /**
     * Verifica si existe el id en la tabla de tipos_de_sanciones
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `TiposSancionesExiste`(?)", [$id]));
    }

    /**
     * Obtener todas las "Sanciones"(Tabla: sanciones) del "Tipo de Sanción"(Tabla: tipos_de_sanciones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sanciones(): HasMany
    {
        return $this->hasMany(Sancion::class, 'tipo_de_sancion_id', 'id');
    }

    /**
     * Obtener todos los Tipos de Sancion para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2TiposDeSanciones`()");
    }
}
