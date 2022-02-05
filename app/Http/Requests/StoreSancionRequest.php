<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSancionRequest extends FormRequest
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
            'id' => ['required', 'integer', 'prestamo_existe', 'sancion_no_existe'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date'],
            'lector_id' => ['required', 'integer', 'usuario_existe'],
            'estado_de_la_sancion_id' => ['required', 'integer', 'estado_de_la_sancion_existe'],
            'tipo_de_sancion_id' => ['required', 'integer', 'tipo_de_sancion_existe'],
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
            'id' => "Prestamo",
            'fecha_inicio' => 'Fecha de Inicio de la Sancion',
            'fecha_fin' => 'Fecha de Fin de la Sancion',
            'lector_id' => 'Lector',
            'estado_de_la_sancion_id' => 'Estado de la Sancion',
            'tipo_de_sancion_id' => 'Tipo de Sancion',
        ];
    }
}
