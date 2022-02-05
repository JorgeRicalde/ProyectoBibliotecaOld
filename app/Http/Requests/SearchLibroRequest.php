<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchLibroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "filtro" => ['required', 'integer', 'between:1,3'],
            "buscar" => ['required', 'string', 'min:4']
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
            'filtro' => 'Filtro',
            'buscar' => 'Buscar',
        ];
    }
}
