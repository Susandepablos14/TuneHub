<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'song_genres');
    }

    Public Function scopeFilter ($query, $request) {

        return $query->when($request->name, function ($genre, $name){
                return $genre->where('name',$name);}
        );
        }
}
