<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Genero extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'generos';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['genero'];

    /**
     * Verifica si existe el id en la tabla de generos
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `GenerosExiste`(?)", [$id]));
    }

    /**
     * Obtener todos los "Usuarios"(Tabla: usuarios) del "Género"(Tabla: generos)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'genero_id', 'id');
    }

    /**
     * Obtener todos los generos para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2Generos`()");
    }
}
