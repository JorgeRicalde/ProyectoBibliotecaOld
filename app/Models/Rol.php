<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Rol extends Role
{
    use HasFactory;

    protected $table = 'roles';

    /**
     * Verifica si existe el id en la tabla de roles
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `RolesExiste`(?)", [$id]));
    }

    /**
     * Obtener todos los Roles para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2Roles`()");
    }
}
