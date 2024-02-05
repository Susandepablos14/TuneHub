<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\SongGenreController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/country', [CountryController::class, 'index']);
Route::post('/country', [CountryController::class, 'store']);
Route::get('/country/{id}', [CountryController::class, 'show']);
Route::put('/country/{id}', [CountryController::class, 'update']);
Route::delete('/country/{id}', [CountryController::class, 'destroy']);
Route::get('/country/restore/{id}', [CountryController::class, 'restore']);

Route::get('/client', [ClientController::class, 'index']);
Route::post('/client', [ClientController::class, 'store']);
Route::get('/client/{id}', [ClientController::class, 'show']);
Route::put('/client/{id}', [ClientController::class, 'update']);
Route::delete('/client/{id}', [ClientController::class, 'destroy']);
Route::get('/client/restore/{id}', [ClientController::class, 'restore']);

Route::get('/artist', [ArtistController::class, 'index']);
Route::post('/artist', [ArtistController::class, 'store']);
Route::get('/artist/{id}', [ArtistController::class, 'show']);
Route::put('/artist/{id}', [ArtistController::class, 'update']);
Route::delete('/artist/{id}', [ArtistController::class, 'destroy']);
Route::get('/artist/restore/{id}', [ArtistController::class, 'restore']);

Route::get('/album', [AlbumController::class, 'index']);
Route::post('/album', [AlbumController::class, 'store']);
Route::get('/album/{id}', [AlbumController::class, 'show']);
Route::put('/album/{id}', [AlbumController::class, 'update']);
Route::delete('/album/{id}', [AlbumController::class, 'destroy']);
Route::get('/album/restore/{id}', [AlbumController::class, 'restore']);

Route::get('/song', [SongController::class, 'index']);
Route::post('/song', [SongController::class, 'store']);
Route::get('/song/{id}', [SongController::class, 'show']);
Route::put('/song/{id}', [SongController::class, 'update']);
Route::delete('/song/{id}', [SongController::class, 'destroy']);
Route::get('/song/restore/{id}', [SongController::class, 'restore']);

Route::get('/comment', [CommentController::class, 'index']);
Route::post('/comment', [CommentController::class, 'store']);
Route::get('/comment/{id}', [CommentController::class, 'show']);
Route::put('/comment/{id}', [CommentController::class, 'update']);
Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
Route::get('/comment/restore/{id}', [CommentController::class, 'restore']);

Route::get('/genre', [GenreController::class, 'index']);
Route::post('/genre', [GenreController::class, 'store']);
Route::get('/genre/{id}', [GenreController::class, 'show']);
Route::put('/genre/{id}', [GenreController::class, 'update']);
Route::delete('/genre/{id}', [GenreController::class, 'destroy']);
Route::get('/genre/restore/{id}', [GenreController::class, 'restore']);

Route::get('/song_genre', [SongGenreController::class, 'index']);
Route::post('/song_genre', [SongGenreController::class, 'store']);
Route::get('/song_genre/{id}', [SongGenreController::class, 'show']);
Route::put('/song_genre/{id}', [SongGenreController::class, 'update']);
Route::delete('/song_genre/{id}', [SongGenreController::class, 'destroy']);
Route::get('/song_genre/restore/{id}', [SongGenreController::class, 'restore']);

