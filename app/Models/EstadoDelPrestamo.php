<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class EstadoDelPrestamo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'estados_de_los_prestamos';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['estado_del_prestamo'];

    /**
     * Verifica si existe el id en la tabla de estados_de_los_prestamos
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `EstadosPrestamosExiste`(?)", [$id]));
    }

    /**
     * Obtenga todos los "Préstamos"(Tabla: prestamos) del "Estado del Préstamo"(Tabla: estados_de_los_prestamos)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'estado_del_prestamo_id', 'id');
    }

    /**
     * Obtener todos los Estados de Prestamo para un select2
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2EstadosDeLosPrestamos`()");
    }
}
