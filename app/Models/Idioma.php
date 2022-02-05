<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Idioma extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'idiomas';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['idioma'];

    /**
     * Verifica si existe el id en la tabla de idiomas
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `IdiomasExiste`(?)", [$id]));
    }

    /**
     * Obtener todos los "Libro"(Tabla: libros) que pertenecen al "Idioma"(Tabla: idiomas)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libros(): HasMany
    {
        return $this->hasMany(Libro::class, 'idioma_id', 'id');
    }

    /**
     * Obtener todos los idiomas para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2Idiomas`()");
    }
}
