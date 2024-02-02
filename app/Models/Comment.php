<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'song_id',
        'comment'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    Public Function scopeFilter ($query, $request) {
        return $query->when($request->client_id, function ($comments, $client_id){
                return $comments->where('client_id',$client_id);}
        )->when($request->song_id, function ($comments, $song_id){
                return $comments->where('song_id', $song_id);}
        )->when($request->comment, function ($comments, $comment){
                return $comments->where('comment', $comment);}
        );
    }
}
