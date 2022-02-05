<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UpdateLibroRequest extends FormRequest
{
    /**
     * Determine si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtener las reglas de validación que se aplican a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'libro_existe'],
            'titulo' => ['sometimes', 'max:255', 'unique:libros,titulo,' . $this->id],
            'titulo_slug' => ['sometimes', 'max:255', 'unique:libros,titulo_slug,' . $this->id],
            'anyo_de_lanzamiento' => ['sometimes', 'integer', 'between:1000,' . date('Y')],
            'cantidad_ejemplares' => ['sometimes', 'integer', 'between:0,200'],
            'imagen' => ['max:2048', 'mimes:jpg,jpeg,png'],
            'idioma_id' => ['sometimes', 'integer', 'idioma_existe'],
            'editorial_id' => ['sometimes', 'integer', 'editorial_existe'],
            'autor_id' => ['sometimes', 'array'],
            'autor_id.*' => ['sometimes',  'integer', 'autor_existe'],
            'sub_clasificacion_id' => ['sometimes', 'array',],
            'sub_clasificacion_id.*' => ['sometimes',  'integer', 'sub_clasificacion_existe'],
        ];
    }

    /**
     * Obtener los atributos personalizados para los errores del validador.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'id' => "ID",
            'titulo' => 'Titulo',
            'titulo_slug' => 'Libro Url',
            'anyo_de_lanzamiento' => 'Año de Lanzamiento',
            'imagen' => 'Imagen',
            'idioma_id' => 'Idioma',
            'editorial_id' => 'Editorial',
            'autor_id' => 'Autor',
            'sub_clasificacion_id' => 'Sub Clasificaciones',
        ];
    }

    /**
     * Esta funcion se ejecuta antes de la validacion
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->request->set("titulo_slug", Str::slug($this->titulo));
    }

    /**
     * Esta funcion se ejecuta despues de la validacion
     *
     * @return void
     */
    public function passedValidation()
    {
        $this->combinar = [];

        if ($imagen = $this->file("imagen")) {
            $imgNombre = time() . '-' . Str::random(8) . '.webp';
            $rutaLocal = public_path("images/libros/{$imgNombre}");
            Image::make($imagen)->resize(500, 500)->save($rutaLocal)->destroy();
            $this->combinar["imagen"] = asset('images/libros/' . ($imgNombre ?? 'default-book.png'));
        }
    }

    /**
     * Obtener los datos validados de la solicitud.
     *
     * @return array
     */
    public function validated()
    {
        return array_merge(parent::validated(), $this->combinar);
    }
}
