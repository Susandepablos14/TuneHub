<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SpotifyService
{
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $accessToken;

    public function __construct()
    {
        $this->clientId = env('SPOTIFY_CLIENT_ID');
        $this->clientSecret = env('SPOTIFY_CLIENT_SECRET');
        $this->redirectUri = env('SPOTIFY_REDIRECT_URI');
    }

    public function authenticate()
    {
        // Implementa la lógica para autenticarte con Spotify y obtener un token de acceso
        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        $responseData = $response->json();
        $this->accessToken = $responseData['access_token'];
    }

    public function getArtistInfo($artistId)
    {
        // Implementa la lógica para obtener información sobre un artista específico
        $response = Http::withToken($this->accessToken)
            ->get("https://api.spotify.com/v1/artists/{$artistId}");

        return $response->json();
    }
}
