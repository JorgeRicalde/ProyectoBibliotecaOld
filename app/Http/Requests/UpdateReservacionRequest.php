<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservacionRequest extends FormRequest
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
            'id' => ['required', 'integer', 'reservacion_existe'],
            'dias_de_prestamo' => ['required', 'integer', 'between:1,14'],
            'ejemplar_id' => ['required', 'integer', 'ejemplar_esta_disponible_reservacion:' . $this->id],
            'lector_id' => ['required', 'integer', 'usuario_esta_habilitado'],
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
            'dias_de_prestamo' => 'Dias de Prestamo',
            'ejemplar_id' => 'Ejemplar',
            'lector_id' => 'Lector',
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
