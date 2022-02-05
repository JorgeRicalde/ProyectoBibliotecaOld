<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryRequest extends FormRequest
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
            'lector_id' => ['required', 'integer', 'usuario_existe'],
            'fecha_desde' => ['required', 'date'],
            'fecha_hasta' => ['required', 'date'],
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
            'lector_id' => 'Lector',
            'fecha_desde' => 'Fecha Desde',
            'fecha_hasta' => 'Fecha Hasta',
        ];
    }

    /**
     * Esta funcion se ejecuta antes de la validacion
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->request->set("lector_id", $this->user()->id);
    }
}
