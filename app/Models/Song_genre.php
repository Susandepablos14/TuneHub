<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song_genre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'song_id',
        'genre_id'
    ];

    protected $table = 'song_genres';

    Public Function scopeFilter ($query, $request) {
        return $query->when($request->song_id, function ($song_genre, $song_id){
            return $song_genre->where('song_id',$song_id);}
        )->when($request->genre_id, function ($song_genre, $genre_id){
            return $song_genre->where('genre_id',$genre_id);}
        );
    }
}
