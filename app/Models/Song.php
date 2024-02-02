<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'duration',
        'type',
        'artist_id',
        'album_id'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'song_genres');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    Public Function scopeFilter ($query, $request) {
        return $query->when($request->title, function ($song, $title){
                return $song->where('title',$title);}
        )->when($request->duration, function ($song, $duration){
                return $song->where('duration', $duration);}
        )->when($request->type, function ($song, $type){
                return $song->where('type', $type);}
        )->when($request->artist_id, function ($song, $artist_id){
                return $song->where('artist_id', $artist_id);}
        )->when($request->album_id, function ($song, $album_id){
                return $song->where('album_id', $album_id);}
        );
    }
}
