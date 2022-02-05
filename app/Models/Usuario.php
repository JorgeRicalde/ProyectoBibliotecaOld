<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    public $timestamps = false;

    protected $table = 'usuarios';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email',
        'password', 'dni', 'celular',  'imagen',
        'estado_del_usuario_id', 'genero_id',
    ];

    /**
     * Los atributos que deben ocultarse para las matrices.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'roles',
        'permissions'
    ];

    /**
     * Los atributos que se deben convertir en tipos nativos.
     *
     * @var array
     */
    protected $casts = [];

    public function nombreCompleto(): string
    {
        return $this->name . ' ' . $this->last_name;
    }

    public function adminlte_image(): string
    {
        return $this->imagen;
    }

    public function adminlte_desc(): string
    {
        return '';
    }

    public function adminlte_profile_url(): string
    {
        return 'profile/username';
    }

    /**
     * Hace un Hash de $newPassword y lo cambia
     *
     * @return $this
     */
    public function setPassword(string $newPassword): Usuario
    {
        $this->password = Hash::make($newPassword);
        return $this;
    }

    /**
     * Crea un array con un mensaje para el metodo Store
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeStore(): array
    {
        return ["mensaje" => "Se creo el usuario con el nombre: " . $this->nombreCompleto()];
    }

    /**
     * Crea un array con un mensaje para el metodo Update
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeUpdate(): array
    {

        return ["mensaje" => "Se actualizaron los datos de: " . $this->nombreCompleto()];
    }

    /**
     * Verifica si existe el id en la tabla de usuarios
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `UsuariosExiste`(?)", [$id]));
    }

    /**
     * Crea un array con todos los usuarios y su informacion
     *
     */
    public static function cantidadListarUsuarios(string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarUsuarios`(?)", [$texto])[0]->cantidad;
    }

    /**
     * Crea un array con todos los usuarios y su informacion
     *
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarUsuarios(array $data): array
    {
        return DB::select("CALL `DataTablesListarUsuarios`(?, ?, ?, ?, ?)", [$data["texto"],  $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Crea un array con todos los usuarios habilitados y su informacion
     *
     */
    public static function cantidadListarUsuariosHabilitados(string $texto): int
    {
        return DB::select("CALL `DataTablesCantidadListarUsuariosHabilitados`(?)", [$texto])[0]->cantidad;
    }

    /**
     * Crea un array con todos los usuarios habilitados y su informacion
     *
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarUsuariosHabilitados(array $data): array
    {
        return DB::select(" CALL `DataTablesListarUsuariosHabilitados`(?, ?, ?, ?, ?)", [$data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Verifica si el usuario esta habilitado
     *
     */
    public static function estaHabilitado(int $user_id): bool
    {
        return boolval(DB::select("SELECT id FROM usuarios WHERE id = ? AND estado_del_usuario_id = 1", [$user_id]));
    }

    /**
     * Obtener el "Género"(Tabla: generos) que posee el "Usuario"(Tabla: usuarios)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class, 'genero_id', 'id');
    }

    /**
     * Obtener todos los "Préstamos"(Tabla: prestamos) realizados por el "Usuario"(Tabla: usuarios)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamosRealizados(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'bibliotecario_id', 'id');
    }

    /**
     * Obtener todos los "Préstamos"(Tabla: prestamos) del "Usuario"(Tabla: usuarios)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'lector_id', 'id');
    }

    /**
     * Obtener todas las "Reservaciones"(Tabla: reservaciones) del "Usuario"(Tabla: usuarios)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class, 'lector_id', 'id');
    }

    /**
     * Obtener todas las "Sanciones"(Tabla: sanciones) que tiene el "Usuario"(Tabla: usuarios)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sanciones()
    {
        return $this->hasMany(Sancion::class, 'user_id', 'id');
    }

    /**
     * Obtener el "Estado del Usuario"(Tabla: estados_de_los_usuarios) que tiene el "Usuario"(Tabla: usuarios)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoUsuario(): BelongsTo
    {
        return $this->belongsTo(EstadoDelUsuario::class, 'estado_del_usuario_id', 'id');
    }
}
