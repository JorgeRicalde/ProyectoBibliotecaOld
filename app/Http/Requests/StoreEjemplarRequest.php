<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEjemplarRequest extends FormRequest
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
            'libro_id' => ['required', 'integer', 'libro_existe'],
            'estado_del_ejemplar_id' => ['required', 'integer', 'estado_del_ejemplar_existe'],
            'estado_fisico_del_ejemplar_id' => ['sometimes', 'array'],
            'estado_fisico_del_ejemplar_id.*' => ['sometimes',  'integer', 'estado_fisico_de_la_ejemplar_existe'],
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
            'libro_id' => 'Libro ID',
            'estado_del_ejemplar_id' => 'Estado de la Ejemplar',
            'estado_fisico_del_ejemplar_id' => 'Estado Fisico de la Ejemplar',
        ];
    }
}
