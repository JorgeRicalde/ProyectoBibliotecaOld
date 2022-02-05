<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservacionRequest;
use App\Http\Requests\UpdateReservacionRequest;
use App\Models\Reservacion;
use Illuminate\Http\JsonResponse;

class ReservacionController extends Controller
{

    /**
     * Retorna la interfaz Reservaciones
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('reservaciones');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreReservacionRequest $request): JsonResponse
    {
        $reservacion = Reservacion::create($request->validated());
        return new JsonResponse($reservacion->mensajeStore(), 200);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $reservacion_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateReservacionRequest $request, string $reservacion_id): JsonResponse
    {
        $reservacion = Reservacion::find($reservacion_id);
        if ($reservacion->fill($request->validated())->save()) {
            return new JsonResponse($reservacion->mensajeUpdate(), 200);
        }
        return new JsonResponse(null, 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(string $reservacion_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }
}
