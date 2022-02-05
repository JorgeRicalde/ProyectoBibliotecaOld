<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrestamoRequest extends FormRequest
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
            'id' => ['required', 'integer', 'prestamo_existe'],
            'dias_de_prestamo' => ['sometimes', 'integer', 'between:1,14'],
            'estado_del_prestamo_id' => ['sometimes', 'integer', 'estado_del_prestamo_existe'],
            'ejemplar_id' => ['sometimes', 'integer', 'ejemplar_esta_disponible_prestamo:' . $this->id],
            'lector_id' => ['sometimes', 'integer', 'usuario_existe'],
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
            'id' => "ID",
            'dias_de_prestamo' => 'Dias de Prestamo',
            'estado_del_prestamo_id' => 'Estado del Prestamo',
            'ejemplar_id' => 'Ejemplar',
            'lector_id' => 'Lector',
            'estado_fisico_del_ejemplar_id' => 'Estado Fisico de la Ejemplar',
        ];
    }

    /**
     * Esta funcion se ejecuta despues de la validacion
     *
     * @return void
     */
    public function passedValidation()
    {
        $this->combinar = [];
        if ($this->input("estado_del_prestamo_id") == 1) {
            $this->combinar['fecha_devolucion'] = null;
            $this->combinar['estado_del_ejemplar_id'] = 2;
        } else {
            $this->combinar['fecha_devolucion'] = Carbon::now();
            $this->combinar['estado_del_ejemplar_id'] = 1;
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
