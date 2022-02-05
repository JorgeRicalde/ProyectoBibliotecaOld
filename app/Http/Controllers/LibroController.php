<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchLibroRequest;
use App\Http\Requests\StoreLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Libro;
use App\Models\Ejemplar;

class LibroController extends Controller
{

    /**
     * Retorna la interfaz Libros
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('libros');
    }

    /**
     * Retorna la interfaz Buscar Libro
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function buscarLibro()
    {
        return view('buscarlibro');
    }

    /**
     * Retorna la interfaz Ejemplares
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ejemplares(string $titulo_slug = "")
    {
        return view('ejemplares', ["titulo_slug" => $titulo_slug]);
    }

    /**
     * Retorna los datos de la busqueda segun el filtro
     *
     */
    public function search(SearchLibroRequest $request): JsonResponse
    {
        $validated = $request->validated();
        switch ($validated["filtro"]) {
            case 1: {
                    return new JsonResponse(Libro::buscarPorTitulo($validated["buscar"]), 200);
                }
            case 2: {
                    return new JsonResponse(Libro::buscarPorAutor($validated["buscar"]), 200);
                }
            case 3: {
                    return new JsonResponse(Libro::buscarPorSubClasificacion($validated["buscar"]), 200);
                }
            default: {
                    return new JsonResponse(null, 400);
                }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreLibroRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $libro = Libro::create($validated);
        $libro->autores()->attach($validated["autor_id"] ?? null);
        $libro->subClasificaciones()->attach($validated["sub_clasificacion_id"] ?? null);
        Ejemplar::insertarVariosEjemplares($validated["cantidad_ejemplares"], $libro["id"]);
        return new JsonResponse($libro->mensajeStore(), 200);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $titulo_slug): JsonResponse
    {
        $libro = Libro::buscarPorSlug($titulo_slug);
        if (boolval($libro)) {
            return new JsonResponse($libro[0], 200);
        }
        return new JsonResponse(null, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateLibroRequest $request, string $libro_id): JsonResponse
    {
        $validated = $request->validated();
        $libro = Libro::find($libro_id);
        if ($libro->fill($validated)->save()) {
            $libro->autores()->sync($validated["autor_id"] ?? null);
            $libro->subClasificaciones()->sync($validated["sub_clasificacion_id"] ?? null);
            return new JsonResponse($libro->mensajeUpdate(), 200);
        }
        return new JsonResponse(null, 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(string $libro_id): JsonResponse
    {
        return new JsonResponse(null, 500);
    }
}
