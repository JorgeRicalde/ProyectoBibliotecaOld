<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class StoreUsuarioRequest extends FormRequest
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
            'name' => ['required', 'max:100', 'letras_tildes_espacios'],
            'last_name' => ['required', 'max:100', 'letras_tildes_espacios'],
            'email' => ['required', 'email', 'unique:usuarios,email'],
            'password' => ['required', 'between:5,20'],
            'dni' => ['sometimes',  'vacio_o_solo_numeros_entre:8,10', 'unique:usuarios,dni'],
            'celular' => ['sometimes', 'vacio_o_solo_numeros_tamanyo:9'],
            'imagen' => ['max:2048', 'mimes:jpg,jpeg,png'],
            'estado_del_usuario_id' => ['required', 'integer', 'estado_del_usuario_existe'],
            'genero_id' => ['required',  'integer', 'genero_existe'],
            'role_id' => ['required',  'integer', 'rol_existe'],
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
            'name' => 'Nombres',
            'last_name' => 'Apellidos',
            'email' => 'Correo',
            'password' => 'Contraseña',
            'dni' => 'DNI',
            'celular' => 'Celular',
            'imagen' => 'Foto del Usuario',
            'estado_del_usuario_id' => 'Estado del Usuario',
            'genero_id' => 'Genero',
            'role_id' => 'Rol',
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

        if ($imagen = $this->file("imagen")) {
            $imgNombre = time() . '-' . Str::random(8) . '.webp';
            $rutaLocal = public_path("images/usuarios/{$imgNombre}");
            Image::make($imagen)->resize(500, 500)->save($rutaLocal)->destroy();
        }

        $this->combinar["password"] = Hash::make($this->password);
        $this->combinar["imagen"] = asset('images/usuarios/' . ($imgNombre ?? 'default-user.png'));
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
