<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Autor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'autores';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'apellido'];

    /**
     * Los atributos que deben ocultarse para las matrices.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
    ];

    /**
     * Verifica si existe el id en la tabla de autores
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `AutoresExiste`(?)", [$id]));
    }

    /**
     * Los "Libro"(Tabla: libros) que pertenecen al "Autor"(Tabla: autores)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'libros_x_autores', 'autor_id', 'libro_id');
    }

    /**
     * Obtener todos los "Libro tienen autores"(Tabla: libros_x_autores) del "Autor"(Tabla: autores)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function librosTienenAutor(): HasMany
    {
        return $this->hasMany(LibrosHasAutor::class, 'autor_id', 'id');
    }

    /**
     * Obtener todas los autores para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2Autores`()");
    }
}
