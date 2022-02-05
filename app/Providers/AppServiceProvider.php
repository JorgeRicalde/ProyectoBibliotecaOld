<?php

namespace App\Providers;

use App\Models\Autor;
use App\Models\Libro;
use App\Models\Clasificacion;
use App\Models\Ejemplar;
use App\Models\Editorial;
use App\Models\Genero;
use App\Models\Idioma;
use App\Models\Prestamo;
use App\Models\EstadoFisicoDelEjemplar;
use App\Models\Reservacion;
use App\Models\Sancion;
use App\Models\EstadoDelEjemplar;
use App\Models\EstadoDelPrestamo;
use App\Models\EstadoDeLaSancion;
use App\Models\EstadoDelUsuario;
use App\Models\Rol;
use App\Models\SubClasificacion;
use App\Models\TipoDeSancion;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('letras_tildes_espacios', function ($attribute, $value, $parameters) {
            return preg_match('/^[A-Za-zÁÉÍÓÚáéíóúñÑ_\- ]+$/u', $value);
        });

        Validator::extend('vacio_o_letras_tildes_espacios_numeros', function ($attribute, $value, $parameters) {
            return empty($value) || preg_match('/^[0-9A-Za-zÁÉÍÓÚáéíóúñÑ_\- ]+$/u', $value);
        });

        Validator::extend('caracteres_busqueda', function ($attribute, $value, $parameters) {
            return empty($value) || preg_match('/^[0-9A-Za-zÁÉÍÓÚáéíóúñÑ:_\- ]+$/u', $value);
        });

        Validator::extend('solo_numeros', function ($attribute, $value, $parameters) {
            return preg_match('/^[0-9]+$/u', $value);
        });

        Validator::extend('vacio_o_solo_numeros_entre', function ($attribute, $value, $parameters) {
            return empty($value) || preg_match('/^[0-9]{' . $parameters[0] . ',' . $parameters[1] . '}+$/u', $value);
        });

        Validator::replacer('vacio_o_solo_numeros_entre', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':min', ':max'], [$parameters[0], $parameters[1]], $message);
        });

        Validator::extend('vacio_o_solo_numeros_tamanyo', function ($attribute, $value, $parameters) {
            return empty($value) || preg_match('/^[0-9]{' . $parameters[0] . '}+$/u', $value);
        });

        Validator::replacer('vacio_o_solo_numeros_tamanyo', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':size',  $parameters[0], $message);
        });

        Validator::extend('ejemplar_esta_disponible_prestamo', function ($attribute, $value, $parameters) {
            $disponible = Ejemplar::estaDisponibleOReservado($value);
            if (!$disponible && isset($parameters[0])) {
                $disponible = Prestamo::estaElEjemplarEnElPrestamo($value, $parameters[0]);
            }
            return $disponible;
        });

        Validator::extend('ejemplar_esta_disponible_reservacion', function ($attribute, $value, $parameters) {
            $disponible = Ejemplar::estaDisponible($value);
            if (!$disponible && isset($parameters[0])) {
                $disponible = Reservacion::estaElEjemplarEnLaReserva($value, $parameters[0]);
            }
            return $disponible;
        });

        Validator::extend('usuario_esta_habilitado', function ($attribute, $value, $parameters) {
            return Usuario::estaHabilitado($value);
        });

        Validator::extend('usuario_existe', function ($attribute, $value, $parameters) {
            return Usuario::existe($value);
        });

        Validator::extend('tipo_de_sancion_existe', function ($attribute, $value, $parameters) {
            return TipoDeSancion::existe($value);
        });

        Validator::extend('sub_clasificacion_existe', function ($attribute, $value, $parameters) {
            return SubClasificacion::existe($value);
        });

        Validator::extend('estado_del_usuario_existe', function ($attribute, $value, $parameters) {
            return EstadoDelUsuario::existe($value);
        });

        Validator::extend('estado_de_la_sancion_existe', function ($attribute, $value, $parameters) {
            return EstadoDeLaSancion::existe($value);
        });

        Validator::extend('estado_del_prestamo_existe', function ($attribute, $value, $parameters) {
            return EstadoDelPrestamo::existe($value);
        });

        Validator::extend('estado_del_ejemplar_existe', function ($attribute, $value, $parameters) {
            return EstadoDelEjemplar::existe($value);
        });

        Validator::extend('sancion_existe', function ($attribute, $value, $parameters) {
            return Sancion::existe($value);
        });

        Validator::extend('sancion_no_existe', function ($attribute, $value, $parameters) {
            return !Sancion::existe($value);
        });

        Validator::extend('reservacion_existe', function ($attribute, $value, $parameters) {
            return Reservacion::existe($value);
        });

        Validator::extend('estado_fisico_de_la_ejemplar_existe', function ($attribute, $value, $parameters) {
            return EstadoFisicoDelEjemplar::existe($value);
        });

        Validator::extend('prestamo_existe', function ($attribute, $value, $parameters) {
            return Prestamo::existe($value);
        });

        Validator::extend('idioma_existe', function ($attribute, $value, $parameters) {
            return Idioma::existe($value);
        });

        Validator::extend('genero_existe', function ($attribute, $value, $parameters) {
            return Genero::existe($value);
        });

        Validator::extend('editorial_existe', function ($attribute, $value, $parameters) {
            return Editorial::existe($value);
        });

        Validator::extend('ejemplar_existe', function ($attribute, $value, $parameters) {
            return Ejemplar::existe($value);
        });

        Validator::extend('clasificacion_existe', function ($attribute, $value, $parameters) {
            return Clasificacion::existe($value);
        });

        Validator::extend('libro_existe', function ($attribute, $value, $parameters) {
            return Libro::existe($value);
        });

        Validator::extend('autor_existe', function ($attribute, $value, $parameters) {
            return Autor::existe($value);
        });
        Validator::extend('rol_existe', function ($attribute, $value, $parameters) {
            return Rol::existe($value);
        });
    }
}
