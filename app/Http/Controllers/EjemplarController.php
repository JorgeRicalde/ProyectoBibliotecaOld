<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEjemplarRequest;
use App\Http\Requests\UpdateEjemplarRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Ejemplar;

class EjemplarController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(null, 500);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreEjemplarRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $ejemplar = Ejemplar::create($validated);
        $ejemplar->estadosFisicosDeLaEjemplar()->sync($validated["estado_fisico_del_ejemplar_id"] ?? null);
        return new JsonResponse($ejemplar->mensajeStore(), 200);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $ejemplar_id): JsonResponse
    {
        $ejemplar = Ejemplar::buscarEjemplarPorID($ejemplar_id);
        if (boolval($ejemplar)) {
            return new JsonResponse($ejemplar[0], 200);
        }
        return new JsonResponse(null, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateEjemplarRequest $request, string $ejemplar_id): JsonResponse
    {
        $validated = $request->validated();
        $ejemplar = Ejemplar::find($ejemplar_id);
        if ($ejemplar->fill($validated)->save()) {
            $ejemplar->estadosFisicosDeLaEjemplar()->sync($validated["estado_fisico_del_ejemplar_id"] ?? null);
            return new JsonResponse($ejemplar->mensajeUpdate(), 200);
        }
        return new JsonResponse(null, 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(string $ejemplar_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }
}
