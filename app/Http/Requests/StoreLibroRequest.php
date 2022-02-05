<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class StoreLibroRequest extends FormRequest
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
            'titulo' => ['required', 'max:255', 'unique:libros,titulo'],
            'titulo_slug' => ['required', 'max:255', 'unique:libros,titulo_slug'],
            'anyo_de_lanzamiento' => ['required', 'integer', 'between:1000,' . date('Y')],
            'cantidad_ejemplares' => ['required', 'integer', 'between:0,200'],
            'imagen' => ['max:2048',  'mimes:jpg,jpeg,png'],
            'idioma_id' => ['required', 'integer', 'idioma_existe'],
            'editorial_id' => ['required', 'integer', 'editorial_existe'],
            'autor_id' => ['sometimes', 'array'],
            'autor_id.*' => ['sometimes', 'integer', 'autor_existe'],
            'sub_clasificacion_id' => ['sometimes', 'array'],
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
        }
        $this->combinar["imagen"] = asset('images/libros/' . ($imgNombre ?? 'default-book.png'));
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
