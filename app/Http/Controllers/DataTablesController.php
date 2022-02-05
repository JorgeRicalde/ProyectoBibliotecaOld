<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataTablesRequest;
use App\Http\Requests\ReportMensualRequest;
use App\Http\Requests\ReportTrimestreRequest;
use App\Models\Ejemplar;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\Reservacion;
use App\Models\Sancion;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;

class DataTablesController extends Controller
{

    /**
     * DataTables Usuarios
     *
     */
    public function usuarios(DataTablesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Usuario::cantidadListarUsuarios($validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] = Usuario::listarUsuarios($validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Usuarios disponibles y su rol
     *
     */
    public function usuariosHabilitados(DataTablesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Usuario::cantidadListarUsuariosHabilitados($validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] =  Usuario::listarUsuariosHabilitados($validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Libro
     *
     */
    public function libros(DataTablesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Libro::cantidadListarLibros($validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] =  Libro::listarLibros($validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Ejemplars
     *
     */
    public function ejemplares(DataTablesRequest $request, int $libro_id): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Ejemplar::cantidadListarEjemplaresDelLibroPorID($libro_id, $validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] =  Ejemplar::listarEjemplaresDelLibroPorID($libro_id, $validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Ejemplars Disponibles
     *
     */
    public function ejemplaresDisponibles(DataTablesRequest $request, int $libro_id): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Ejemplar::cantidadListarEjemplaresDisponiblesDelLibroPorID($libro_id, $validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] =  Ejemplar::listarEjemplaresDisponiblesDelLibroPorID($libro_id, $validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Prestamos
     *
     */
    public function prestamos(DataTablesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Prestamo::cantidadListarPrestamos($validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] = Prestamo::listarPrestamos($validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Prestamos que no tienen prestamos
     *
     */
    public function prestamosSinSancion(DataTablesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Prestamo::cantidadListarPrestamosSinSancion($validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] = Prestamo::listarPrestamosSinSancion($validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Sanciones
     *
     */
    public function sanciones(DataTablesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Sancion::cantidadListarSanciones($validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] = Sancion::listarSanciones($validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Reservaciones
     *
     */
    public function reservaciones(DataTablesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Reservacion::cantidadListarReservaciones($validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] = Reservacion::listarReservaciones($validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Reservaciones del usuario logeado
     *
     */
    public function misReservaciones(DataTablesRequest $request): JsonResponse
    {
        $usuario_id = $request->user()->id;
        $validated = $request->validated();

        $respuesta['recordsTotal'] = Reservacion::cantidadListarReservacionesDeUnUsuario($usuario_id, $validated["texto"]);
        $respuesta['recordsFiltered'] = $respuesta['recordsTotal'];
        $respuesta['draw'] = $validated["draw"];
        $respuesta['data'] = Reservacion::listarReservacionesDeUnUsuario($usuario_id, $validated);

        return new JsonResponse($respuesta, 200);
    }

    /**
     * DataTables Prestamos Reporte Por Año y Mes
     *
     */
    public function prestamosReportePorAnyoMes(ReportMensualRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return new JsonResponse(Prestamo::prestamosReportePorAnyoMes($validated["anyo"], $validated["mes"]), 200);
    }

    /**
     * DataTables Prestamos Reporte Por Año y Trimestre
     *
     */
    public function prestamosReportePorAnyoTrimestre(ReportTrimestreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return new JsonResponse(Prestamo::prestamosReportePorAnyoTrimestre($validated["anyo"], $validated["trimestre"]), 200);
    }

    /**
     * DataTables Sanciones Reporte Por Año y Mes
     *
     */
    public function sancionesReportePorAnyoMes(ReportMensualRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return new JsonResponse(Sancion::sancionesReportePorAnyoMes($validated["anyo"], $validated["mes"]), 200);
    }

    /**
     * DataTables Sanciones Reporte Por Año y Trimestre
     *
     */
    public function sancionesReportePorAnyoTrimestre(ReportTrimestreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return new JsonResponse(Sancion::sancionesReportePorAnyoTrimestre($validated["anyo"], $validated["trimestre"]), 200);
    }

    /**
     * DataTables Reservaciones del usuario logeado
     *
     */
    public function limpiar(DataTablesRequest $request): JsonResponse
    {
        $respuesta['recordsTotal'] = 0;
        $respuesta['recordsFiltered'] = 0;
        $respuesta['draw'] = $request->input('draw');
        $respuesta['data'] = [];
        return new JsonResponse($respuesta, 200);
    }
}
