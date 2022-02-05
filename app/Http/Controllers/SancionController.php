<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Http\Requests\StoreSancionRequest;
use App\Http\Requests\UpdateSancionRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Sancion;

class SancionController extends Controller
{

    /**
     * Retorna la interfaz Sanciones
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('sanciones');
    }

    /**
     * Retorna la interfaz Historial de Sanciones
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function historial()
    {
        return view('historialsanciones');
    }

    /**
     * Retorna la interfaz Reporte de Sanciones
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reporte()
    {
        return view('reportesanciones');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreSancionRequest $request): JsonResponse
    {
        $sancion = Sancion::create($request->validated());
        return new JsonResponse($sancion->mensajeStore(), 200);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $sancion_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateSancionRequest $request, string $sancion_id): JsonResponse
    {
        $sancion = Sancion::find($sancion_id);
        if ($sancion->fill($request->validated())->save()) {
            return new JsonResponse($sancion->mensajeUpdate(), 200);
        }
        return new JsonResponse(null, 500);
    }

    /**
     * Retorna el Historial de sanciones de un lector
     *
     */
    public function misSanciones(HistoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return new JsonResponse(Sancion::sancionesHistorialDeUnLector(
            $validated["lector_id"],
            $validated["fecha_desde"],
            $validated["fecha_hasta"]
        ), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(string $sancion_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }
}
