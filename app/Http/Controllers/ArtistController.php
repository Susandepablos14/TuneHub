<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Services\SpotifyService;
use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }


    public function index(Request $request)
    {
        try {
            $artist = Artist::with('album', 'song')->filter($request)->paginate(10);
        } catch (Exception  $e) {
            return response()->json([
                'data' => [
                    'code'   => $e->getCode(),
                    'title'  =>'Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.',
                    'errors' => $e->getMessage(),
            ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $artist;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $artist = new Artist();
            $artist->name = $request->name;

            $artist->save();

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
            // Obtener el artista de la base de datos por su ID
            $artist = Artist::findOrFail($id);

            // Autenticación con Spotify
            $this->spotifyService->authenticate();

            // Buscar al artista en la API de Spotify por su nombre
            $artistInfo = $this->spotifyService->searchArtists($artist->name);

        } catch (Exception $e) {
            return response()->json([
                'data' => [
                    'code'   => $e->getCode(),
                    'title'  =>'Ha ocurrido un error. Por favor, inténtelo de nuevo más tarde.',
                    'errors' => $e->getMessage(),
            ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json($artistInfo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $artist = Artist::find($id);
        if (!$artist){
            return response()->json([
                'errors' => [
                    'message'   => 'No se encontro este artista',
                ]
            ], 422);
        }
        try {
            $artist = Artist::findOrFail($id);
            $artist->name = $request->name ?? $artist->name;

            $artist->save();
            $response = Artist::find($id);
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
            $artist = Artist::findOrFail($id);
            $artist->delete();

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
        $artist = Artist::find($id);
        if ($artist){
            return response()->json([
                'errors' => [
                    'message'   => 'Este artista no se encuentra eliminado',
                ]
            ], 422);
        }
        try {
            $artist = Artist::withTrashed()->findOrFail($id);
            $artist->restore();

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
