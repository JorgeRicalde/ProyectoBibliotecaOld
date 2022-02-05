<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Libro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'libros';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'titulo_slug', 'anyo_de_lanzamiento', 'imagen', 'idioma_id', 'editorial_id'];

    /**
     * Los atributos que deben ocultarse para las matrices.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Crea un array con un mensaje para el metodo Store
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeStore(): array
    {
        return ["mensaje" => "Se creo el libro con el titulo: " . $this->titulo];
    }

    /**
     * Crea un array con un mensaje para el metodo Update
     *
     * @return array Un array que contiene el mensaje en el campo "mensaje"
     */
    public function mensajeUpdate(): array
    {
        return ["mensaje" => "Se actualizaron los datos del libro: " . $this->titulo];
    }

    /**
     * Verifica si existe el id en la tabla de libros
     *
     */
    public static function existe(int $id): bool
    {
        return boolval(DB::select("CALL `LibrosExiste`(?)", [$id]));
    }

    /**
     * Crea un array que contiene la informacion de un libro al buscar por su Slug
     *
     */
    public static function buscarPorSlug(string $titulo_slug): array
    {
        return DB::select("SELECT libros.id, libros.titulo, libros.titulo_slug, libros.anyo_de_lanzamiento, libros.imagen, libros.editorial_id, editoriales.editorial, libros.idioma_id, idiomas.idioma, GROUP_CONCAT(DISTINCT autores.id) AS autor_id, GROUP_CONCAT(DISTINCT CONCAT(autores.nombre, ' ', autores.apellido) SEPARATOR ', ') AS autores, GROUP_CONCAT(DISTINCT sub_clasificaciones.id) AS sub_clasificacion_id, GROUP_CONCAT(DISTINCT sub_clasificaciones.sub_clasificacion SEPARATOR ', ') AS sub_clasificaciones FROM libros INNER JOIN editoriales ON editoriales.id = libros.editorial_id INNER JOIN idiomas ON idiomas.id = libros.idioma_id LEFT JOIN libros_x_autores ON libros.id = libros_x_autores.libro_id LEFT JOIN autores ON autores.id = libros_x_autores.autor_id LEFT JOIN libros_x_sub_clasificaciones ON libros_x_sub_clasificaciones.libro_id = libros.id LEFT JOIN sub_clasificaciones ON sub_clasificaciones.id = libros_x_sub_clasificaciones.sub_clasificacion_id WHERE titulo_slug LIKE ? GROUP BY id, titulo, titulo_slug, anyo_de_lanzamiento, imagen, editorial_id, editorial, idioma_id, idioma LIMIT 1", [$titulo_slug]);
    }

    /**
     * Crea un array que contiene la informacion de un libro al buscar por su Titulo
     *
     */
    public static function buscarPorTitulo(string $titulo): array
    {
        return DB::select("SELECT libros.id, libros.titulo, libros.titulo_slug, libros.anyo_de_lanzamiento, libros.imagen, libros.editorial_id, editoriales.editorial, libros.idioma_id, idiomas.idioma, GROUP_CONCAT(DISTINCT autores.id) AS autor_id, GROUP_CONCAT(DISTINCT CONCAT(autores.nombre, ' ', autores.apellido) SEPARATOR ', ') AS autores, GROUP_CONCAT(DISTINCT sub_clasificaciones.id) AS sub_clasificacion_id, GROUP_CONCAT(DISTINCT sub_clasificaciones.sub_clasificacion SEPARATOR ', ') AS sub_clasificaciones FROM libros INNER JOIN editoriales ON editoriales.id = libros.editorial_id INNER JOIN idiomas ON idiomas.id = libros.idioma_id LEFT JOIN libros_x_autores ON libros.id = libros_x_autores.libro_id LEFT JOIN autores ON autores.id = libros_x_autores.autor_id LEFT JOIN libros_x_sub_clasificaciones ON libros_x_sub_clasificaciones.libro_id = libros.id LEFT JOIN sub_clasificaciones ON sub_clasificaciones.id = libros_x_sub_clasificaciones.sub_clasificacion_id  WHERE titulo LIKE ? GROUP BY id, titulo, titulo_slug, anyo_de_lanzamiento, imagen, editorial_id, editorial, idioma_id, idioma", ["%{$titulo}%"]);
    }

    /**
     * Crea un array que contiene la informacion de los libros al buscar por el nombre del autor
     *
     */
    public static function buscarPorAutor(string $nombreAutor): array
    {
        return DB::select("SELECT libros.id, libros.titulo, libros.titulo_slug, libros.anyo_de_lanzamiento, libros.imagen, libros.editorial_id, editoriales.editorial, libros.idioma_id, idiomas.idioma, GROUP_CONCAT(DISTINCT autores.id) AS autor_id, GROUP_CONCAT(DISTINCT CONCAT(autores.nombre, ' ', autores.apellido) SEPARATOR ', ') AS autores, GROUP_CONCAT(DISTINCT sub_clasificaciones.id) AS sub_clasificacion_id, GROUP_CONCAT(DISTINCT sub_clasificaciones.sub_clasificacion SEPARATOR ', ') AS sub_clasificaciones FROM libros INNER JOIN editoriales ON editoriales.id = libros.editorial_id INNER JOIN idiomas ON idiomas.id = libros.idioma_id LEFT JOIN libros_x_autores ON libros.id = libros_x_autores.libro_id LEFT JOIN autores ON autores.id = libros_x_autores.autor_id LEFT JOIN libros_x_sub_clasificaciones ON libros_x_sub_clasificaciones.libro_id = libros.id LEFT JOIN sub_clasificaciones ON sub_clasificaciones.id = libros_x_sub_clasificaciones.sub_clasificacion_id GROUP BY id, titulo, titulo_slug, anyo_de_lanzamiento, imagen, editorial_id, editorial, idioma_id, idioma HAVING autores LIKE ? ", ["%{$nombreAutor}%"]);
    }

    /**
     * Crea un array que contiene la informacion de los libros al buscar por la Sub Clasificación
     *
     */
    public static function buscarPorSubClasificacion(string $subClasificacion): array
    {
        return DB::select("SELECT libros.id, libros.titulo, libros.titulo_slug, libros.anyo_de_lanzamiento, libros.imagen, libros.editorial_id, editoriales.editorial, libros.idioma_id, idiomas.idioma, GROUP_CONCAT(DISTINCT autores.id) AS autor_id, GROUP_CONCAT(DISTINCT CONCAT(autores.nombre, ' ', autores.apellido) SEPARATOR ', ') AS autores, GROUP_CONCAT(DISTINCT sub_clasificaciones.id) AS sub_clasificacion_id, GROUP_CONCAT(DISTINCT sub_clasificaciones.sub_clasificacion SEPARATOR ', ') AS sub_clasificaciones FROM libros INNER JOIN editoriales ON editoriales.id = libros.editorial_id INNER JOIN idiomas ON idiomas.id = libros.idioma_id LEFT JOIN libros_x_autores ON libros.id = libros_x_autores.libro_id LEFT JOIN autores ON autores.id = libros_x_autores.autor_id LEFT JOIN libros_x_sub_clasificaciones ON libros_x_sub_clasificaciones.libro_id = libros.id LEFT JOIN sub_clasificaciones ON sub_clasificaciones.id = libros_x_sub_clasificaciones.sub_clasificacion_id GROUP BY id, titulo, titulo_slug, anyo_de_lanzamiento, imagen, editorial_id, editorial, idioma_id, idioma HAVING sub_clasificaciones LIKE ? ", ["%{$subClasificacion}%"]);
    }

    /**
     * Retorna la cantidad de resultados de Listar Libros
     *
     */
    public static function cantidadListarLibros(string $texto)
    {
        return DB::select("CALL `DataTablesCantidadListarLibros`(?)", [$texto])[0]->cantidad;
    }

    /**
     * Crea un array que contiene la informacion de todos los libros
     *
     * @param array $data Un array con los campos: 'texto', 'columna', 'sentido', 'saltar', 'tomar'
     */
    public static function listarLibros(array $data): array
    {
        return DB::select("CALL `DataTablesListarLibros`(?, ?, ?, ?, ?)", [$data["texto"], $data["columna"], $data["sentido"], $data["saltar"], $data["tomar"]]);
    }

    /**
     * Los "Autor"(Tabla: autores) que pertenecen al "Libro"(Tabla: libros).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'libros_x_autores', 'libro_id', 'autor_id');
    }

    /**
     * Obtener todos los "Libro tienen autores"(Tabla: libros_x_autores) del "Libro"(Tabla: libros)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function librosTienenAutor(): HasMany
    {
        return $this->hasMany(LibrosHasAutor::class, 'libro_id', 'id');
    }

    /**
     * Las "Subclasificaciones"(Tabla: sub_clasificaciones) que pertenecen al "Libro"(Tabla: libros)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subClasificaciones(): BelongsToMany
    {
        return $this->belongsToMany(SubClasificacion::class, 'libros_x_sub_clasificaciones', 'libro_id', 'sub_clasificacion_id');
    }

    /**
     * Obtener todos los "libros tienen Subclasificaciones"(Tabla: libros_x_sub_clasificaciones) del "Libro"(Tabla: libros)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function librosTienenSubClasificaciones(): HasMany
    {
        return $this->hasMany(LibrosHasSubClasificacion::class, 'libro_id', 'id');
    }

    /**
     * Obtener todas las "Ejemplars"(Tabla: ejemplares) del "Libro"(Tabla: libros)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejemplares(): HasMany
    {
        return $this->hasMany(Ejemplar::class, 'libro_id', 'id');
    }

    /**
     * Obtener la "Editorial"(Tabla: editoriales) propietaria del "Libro"(Tabla: libros)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editorial(): BelongsTo
    {
        return $this->belongsTo(Editorial::class, 'editorial_id', 'id');
    }

    /**
     * Obtener el "Idioma"(Tabla: idiomas) que posee el "Libro"(Tabla: libros)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function idioma(): BelongsTo
    {
        return $this->belongsTo(Idioma::class, 'idioma_id', 'id');
    }

    /**
     * Obtener todas los libros para un select2 paginado
     *
     */
    public static function select2(): array
    {
        return DB::select("CALL `Select2Libros`()");
    }

    /**
     * Obtener todas los libros para un select2 paginado
     *
     */
    public static function select2Paginado(string $titulo, int $saltar, int $tomar): array
    {
        return DB::select(
            "CALL `Select2LibrosPaginado`(?,?,?)",
            [$titulo, $saltar, $tomar]
        );
    }
}
