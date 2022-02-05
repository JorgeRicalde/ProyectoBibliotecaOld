<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Http\Requests\StorePrestamoRequest;
use App\Http\Requests\UpdatePrestamoRequest;
use App\Models\Prestamo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{

    /**
     * Retorna la interfaz Prestamos
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('prestamos');
    }

    /**
     * Retorna la interfaz Historial de Prestamos
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function historial()
    {
        return view('historialprestamos');
    }

    /**
     * Retorna la interfaz Reporte de Prestamos
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reporte()
    {
        return view('reporteprestamos');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StorePrestamoRequest $request): JsonResponse
    {
        $prestamo = Prestamo::create($request->validated());
        $prestamo->ejemplar->estadosFisicosDeLaEjemplar()->sync($validated["estado_fisico_del_ejemplar_id"] ?? null);
        return new JsonResponse($prestamo->mensajeStore(), 200);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $prestamo_id): JsonResponse
    {
        $prestamo = Prestamo::buscarPrestamoPorID($prestamo_id);
        if (boolval($prestamo)) {
            return new JsonResponse($prestamo[0], 200);
        }
        return new JsonResponse(null, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdatePrestamoRequest $request, string $prestamo_id): JsonResponse
    {
        $validated = $request->validated();
        $prestamo = Prestamo::find($prestamo_id);
        if ($prestamo->fill($validated)->save()) {
            $copy = $prestamo->ejemplar;
            if ($copy->setAttribute("estado_del_ejemplar_id", $validated["estado_del_ejemplar_id"])->save()) {
                $copy->estadosFisicosDeLaEjemplar()->sync($validated["estado_fisico_del_ejemplar_id"] ?? null);
                return new JsonResponse($prestamo->mensajeUpdate(), 200);
            }
        }
        return new JsonResponse(null, 500);
    }

    /**
     * Retorna el Historial de prestamos de un lector
     *
     */
    public function misPrestamos(HistoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return new JsonResponse(Prestamo::prestamosHistorialDeUnLector(
            $validated["lector_id"],
            $validated["fecha_desde"],
            $validated["fecha_hasta"]
        ), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(string $prestamo_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }
}
