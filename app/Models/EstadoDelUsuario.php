<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class EstadoDelUsuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'estados_de_los_usuarios';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['estado_del_usuario'];

    /**
     * Verifica si existe el id en la tabla de estados_de_los_usuarios
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `EstadosUsuariosExiste`(?)", [$id]));
    }

    /**
     * Obtener todos los "Usuarios"(Tabla: usuarios) del "Estado del Usuario"(Tabla: estados_de_los_usuarios)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'estado_del_usuario_id', 'id');
    }

    /**
     * Obtener todos los Estados de Usuario para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2EstadosDeLosUsuarios`()");
    }
}
