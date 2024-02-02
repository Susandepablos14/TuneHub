<?php

namespace App\Http\Controllers;

use App\Models\Song_genre;
use App\Http\Requests\StoreSong_genreRequest;
use App\Http\Requests\UpdateSong_genreRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SongGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $song_genre = Song_genre::filter($request)->paginate(10);
        } catch (Exception  $e) {
            return response()->json([
                'data' => [
                    'code'   => $e->getCode(),
                    'title'  =>'Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.',
                    'errors' => $e->getMessage(),
            ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $song_genre;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $song_genre = new Song_genre();
            $song_genre->song_id = $request->song_id;
            $song_genre->genre_id = $request->genre_id;

            $song_genre->save();
        }  catch (Exception $e) {
                return response()->json([
                    'data' => [
                        'code'   => $e->getCode(),
                        'title'  =>'Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.',
                        'errors' => $e->getMessage(),
                ]
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        return response()->json([
            'message'    => 'Registrado exitosamente',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $song_genre = Song_genre::findOrFail($id);
        } catch (Exception $e) {
            return response()->json([
                'data' => [
                    'code'   => $e->getCode(),
                    'title'  =>'Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.',
                    'errors' => $e->getMessage(),
            ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        };
        return response()->json([
            'message'    => 'Hola',
            'response'   => $song_genre,
        ]); ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $song_genre = Song_genre::find($id);
        if (!$song_genre){
            return response()->json([
                'errors' => [
                    'message'   => 'No se encontro esta cancion y genero',
                ]
            ], 422);
        }
        try {
            $song_genre = Song_genre::findOrFail($id);
            $song_genre->song_id = $request->song_id ?? $song_genre->song_id;
            $song_genre->genre_id = $request->genre_id ?? $song_genre->genre_id;

            $song_genre->save();
            $response = Song_genre::find($id);
        } catch (Exception $e) {
            return response()->json([
                'data' => [
                    'code'   => $e->getCode(),
                    'title'  =>'Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.',
                    'errors' => $e->getMessage(),
            ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        };

        return response()->json([
            'message'    => 'Registro Actualizado exitosamente',
            'response'   => $response,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $song_genre = Song_genre::findOrFail($id);
            $song_genre->delete();

        } catch (Exception $e) {
            return response()->json([
                'data' => [
                    'code'   => $e->getCode(),
                    'title'  =>'Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.',
                    'errors' => $e->getMessage(),
            ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        };

        return response()->json([
            'message'    => 'Registro Borrado exitosamente',
        ]);
    }

    public function restore($id)
    {
        $song_genre = Song_genre::find($id);
        if ($song_genre){
            return response()->json([
                'errors' => [
                    'message'   => 'Esta cancion y genero no se encuentra eliminado',
                ]
            ], 422);
        }
        try {
            $song_genre = Song_genre::withTrashed()->findOrFail($id);
            $song_genre->restore();

        } catch (Exception $e) {
            return response()->json([
                'data' => [
                    'code'   => $e->getCode(),
                    'title'  =>'Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.',
                    'errors' => $e->getMessage(),
            ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        };

        return response()->json([
            'message'    => 'Restaurado exitosamente',
        ]);
    }
}
