<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Editorial extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'editoriales';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['editorial'];

    /**
     * Verifica si existe el id en la tabla de editoriales
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `EditorialesExiste`(?)", [$id]));
    }

    /**
     * Obtener todos los "Libro"(Tabla: libros) de la "Editorial"(Tabla: editoriales)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libros(): HasMany
    {
        return $this->hasMany(Libro::class, 'editorial_id', 'id');
    }

    /**
     * Obtener todas los editoriales para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2Editoriales`()");
    }
}
