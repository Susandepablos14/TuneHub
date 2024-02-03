<?php

namespace App\Http\Controllers;

use App\Services\SpotifyService;
use Illuminate\Http\Request;

class SpotifyController extends Controller
{
    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }

    public function getArtistInfo($artistId)
    {
        $this->spotifyService->authenticate(); // Autenticar con Spotify
        $artistInfo = $this->spotifyService->getArtistInfo($artistId); // Obtener información del artista

        // Procesar la respuesta y devolverla al cliente
        return response()->json($artistInfo);
    }

}


