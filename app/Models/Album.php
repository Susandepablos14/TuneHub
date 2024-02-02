<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'artist_id'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    Public Function scopeFilter ($query, $request) {
        return $query->when($request->title, function ($album, $title){
            return $album->where('title',$title);}
        )->when($request->artist_id, function ($album, $artist_id){
            return $album->where('artist_id',$artist_id);}
        );
    }
}
