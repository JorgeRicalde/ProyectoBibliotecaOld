<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Usuario;

class UsuarioController extends Controller
{

    /**
     * Retorna la interfaz Usuarios
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('usuarios');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreUsuarioRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ($usuario = Usuario::create($validated)) {
            $usuario->assignRole($validated["role_id"]);
            return new JsonResponse($usuario->mensajeStore(), 200);
        }
        return new JsonResponse(null, 500);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $usuario_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateUsuarioRequest $request, string $usuario_id): JsonResponse
    {
        $validated = $request->validated();
        $usuario = Usuario::find($usuario_id);
        if ($usuario->fill($validated)->save()) {
            $usuario->syncRoles($validated["role_id"]);
            return new JsonResponse($usuario->mensajeUpdate(), 200);
        }
        return new JsonResponse(null, 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(string $usuario_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }
}
