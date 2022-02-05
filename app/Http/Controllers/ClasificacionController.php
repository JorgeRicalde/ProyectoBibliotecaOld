<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClasificacionController extends Controller
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
    public function store(Request $request): JsonResponse
    {
        return new JsonResponse(null, 500);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $clasificacion): JsonResponse
    {
        return new JsonResponse(null, 500);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, string $clasificacion): JsonResponse
    {
        return new JsonResponse(null, 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(string $clasificacion): JsonResponse
    {
        return new JsonResponse(null, 500);
    }
}
