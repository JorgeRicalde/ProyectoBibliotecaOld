<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataTablesRequest extends FormRequest
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
            'columna' => ['required', 'string', 'max:50', 'letras_tildes_espacios'],
            'sentido' => ['required', 'string', 'max:5',  'in:asc,desc'],
            'texto' => ['string', 'max:50',  'caracteres_busqueda'],
            'saltar' => ['required', 'integer', 'min:0'],
            'tomar' => ['required', 'integer', 'between:0,100'],
            'draw' => ['required', 'integer', 'min:0'],
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
            'id' => 'ID',
            'columna' => 'Columna',
            'sentido' => 'Sentido',
            'texto' => 'Valor de Busqueda',
            'saltar' => 'Saltar',
            'tomar' => 'Tomar',
        ];
    }
}
