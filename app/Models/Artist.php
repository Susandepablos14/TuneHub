<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function album()
    {
        return $this->hasMany(Album::class);
    }

    public function song()
    {
        return $this->hasMany(Song::class);
    }

    Public Function scopeFilter ($query, $request) {

    return $query->when($request->name, function ($artist, $name){
        return $artist->where('name',$name);}
    );
    }
}
