<?php

namespace App\Http\Controllers;

use App\Http\Requests\Select2Request;
use App\Models\Autor;
use App\Models\Libro;
use App\Models\Clasificacion;
use App\Models\Editorial;
use App\Models\Genero;
use App\Models\Idioma;
use App\Models\EstadoFisicoDelEjemplar;
use App\Models\EstadoDelEjemplar;
use App\Models\EstadoDelPrestamo;
use App\Models\EstadoDeLaSancion;
use App\Models\EstadoDelUsuario;
use App\Models\Rol;
use App\Models\SubClasificacion;
use App\Models\TipoDeSancion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{

    /**
     * Obtener varios select2
     *
     */
    public function select2(Request $request): JsonResponse
    {
        $data = [];

        if ($campos = $request->input('campos', false)) {
            $campos = is_string($campos) ? [$campos] : $campos;
            foreach ($campos as $campo) {
                switch ($campo) {
                    case 'estados_de_los_usuarios': {
                            $data["estados_de_los_usuarios"] = EstadoDelUsuario::select2();
                            break;
                        }
                    case 'tipos_de_sanciones': {
                            $data["tipos_de_sanciones"] = TipoDeSancion::select2();
                            break;
                        }
                    case 'sub_clasificaciones': {
                            $data["sub_clasificaciones"] = SubClasificacion::select2();
                            break;
                        }
                    case 'estados_de_los_prestamos': {
                            $data["estados_de_los_prestamos"] = EstadoDelPrestamo::select2();
                            break;
                        }
                    case 'estados_de_los_ejemplares': {
                            $data["estados_de_los_ejemplares"] = EstadoDelEjemplar::select2();
                            break;
                        }
                    case 'estados_de_las_sanciones': {
                            $data["estados_de_las_sanciones"] = EstadoDeLaSancion::select2();
                            break;
                        }
                    case 'estados_fisicos_de_los_ejemplares': {
                            $data["estados_fisicos_de_los_ejemplares"] = EstadoFisicoDelEjemplar::select2();
                            break;
                        }
                    case 'idiomas': {
                            $data["idiomas"] = Idioma::select2();
                            break;
                        }
                    case 'generos': {
                            $data["generos"] = Genero::select2();
                            break;
                        }
                    case 'editoriales': {
                            $data["editoriales"] = Editorial::select2();
                            break;
                        }
                    case 'clasificaciones': {
                            $data["clasificaciones"] = Clasificacion::select2();
                            break;
                        }
                    case 'autores': {
                            $data["autores"] = Autor::select2();
                            break;
                        }
                    case 'roles': {
                            $data["roles"] = Rol::select2();
                            break;
                        }
                }
            }
        }
        return new JsonResponse($data, 200);
    }

    /**
     * Obtener todos los Estados de los Usuarios para un select2
     *
     */
    public function estadosDeLosUsuarios(): JsonResponse
    {
        return new JsonResponse(EstadoDelUsuario::select2(), 200);
    }

    /**
     * Obtener todos los Tipos de Sanciones para un select2
     *
     */
    public function tiposDeSanciones(): JsonResponse
    {
        return  new JsonResponse(TipoDeSancion::select2(), 200);
    }

    /**
     * Obtener todas las Sub Clasificaciones para un select2
     *
     */
    public function subClasificaciones(): JsonResponse
    {
        return new JsonResponse(SubClasificacion::select2(), 200);
    }

    /**
     * Obtener todos los Estados de los Prestamos para un select2
     *
     */
    public function estadosDeLosPrestamos(): JsonResponse
    {
        return new JsonResponse(EstadoDelPrestamo::select2(), 200);
    }

    /**
     * Obtener todos los Estados de los Ejemplares para un select2
     *
     */
    public function estadosDeLosEjemplares(): JsonResponse
    {
        return new JsonResponse(EstadoDelEjemplar::select2(), 200);
    }

    /**
     * Obtener todos los Estados de las Sanciones para un select2
     *
     */
    public function estadosDeLasSanciones(): JsonResponse
    {
        return new JsonResponse(EstadoDeLaSancion::select2(), 200);
    }

    /**
     * Obtener todos los Estados Fisicos de los Ejemplares para un select2
     *
     */
    public function estadosFisicosDeLosEjemplares(): JsonResponse
    {
        return new JsonResponse(EstadoFisicoDelEjemplar::select2(), 200);
    }

    /**
     * Obtener todos los Idiomas para un select2
     *
     */
    public function idiomas(): JsonResponse
    {
        return new JsonResponse(Idioma::select2(), 200);
    }

    /**
     * Obtener todos los Generos para un select2
     *
     */
    public function generos(): JsonResponse
    {
        return new JsonResponse(Genero::select2(), 200);
    }

    /**
     * Obtener todas los Editoriales para un select2
     *
     */
    public function editoriales(): JsonResponse
    {
        return new JsonResponse(Editorial::select2(), 200);
    }

    /**
     * Obtener todas los Clasificaciones para un select2
     *
     */
    public function clasificaciones(): JsonResponse
    {
        return new JsonResponse(Clasificacion::select2(), 200);
    }

    /**
     * Obtener todas los Autor para un select2
     *
     */
    public function autores(): JsonResponse
    {
        return new JsonResponse(Autor::select2(), 200);
    }

    /**
     * Obtener todas los Libros para un select2
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function librosTodos(): JsonResponse
    {
        return new JsonResponse(Libro::select2(), 200);
    }

    /**
     * Obtener todas los Libros para un select2 paginado
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function libros(Select2Request $request, ?string $titulo = ""): JsonResponse
    {
        $validated = $request->validated();
        return new JsonResponse(Libro::select2Paginado($titulo, $validated["saltar"], $validated["tomar"]), 200);
    }

    /**
     * Obtener todas los Roles para un select2
     *
     */
    public function roles(): JsonResponse
    {
        return new JsonResponse(Rol::select2(), 200);
    }
}
