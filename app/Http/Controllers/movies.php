<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Movie;

class Movies extends Controller
{
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'synopsis' => 'nullable|string|max:255',
            'imageLink' => 'nullable|string|max:512',
            'year' => 'nullable|integer',
        ]);

        Log::info('Prueba');
        $createdMovie = Movie::create($validated);

        return response()->json([
            'mensaje' => 'Pelicula guardada',
            'datos' => $createdMovie
        ]);
    }

    public function get(Request $request)
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    public function getById($id)
    {
        // Buscar la película por su ID
        $movie = Movie::find($id);

        // Si no se encuentra, devolver error
        if (!$movie) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }

        // Si se encuentra, devolver la película
        return response()->json($movie);
    }

    public function update(Request $request, $id)
    {
        // Validar datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'synopsis' => 'nullable|string|max:255',
            'imageLink' => 'nullable|string|max:512',
            'year' => 'nullable|integer',
        ]);

        // Buscar la película
        $movie = Movie::findOrFail($id);

        // Actualizar con los datos validados
        $movie->update($validated);

        // Retornar la película actualizada
        return response()->json($movie);
    }

    public function delete($id)
    {
        // Buscar la película
        $movie = Movie::findOrFail($id);

        // Eliminarla
        $movie->delete();

        // Retornar respuesta
        return response()->json(['message' => 'Película eliminada correctamente.']);
    }
}
