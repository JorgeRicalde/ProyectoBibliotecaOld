<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Select2Request extends FormRequest
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
            'pagina' => ['required', 'integer', 'min:0'],
            'tomar' => ['required', 'integer', 'min:10'],
            'saltar' => ['required', 'integer', 'min:0'],
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
            'pagina' => 'Pagina',
            'tomar' => 'Tomar',
            'saltar' => 'Saltar',
        ];
    }
}
