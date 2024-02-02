<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',
        'country_id',
        'code',
        'phone',
        'email'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    Public Function scopeFilter ($query, $request) {
        return $query->when($request->name, function ($clients, $name){
                return $clients->where('name',$name);}
        )->when($request->last_name, function ($clients, $last_name){
                return $clients->where('last_name', $last_name);}
        )->when($request->country_id, function ($clients, $country_id){
                return $clients->where('country_id', $country_id);}
        )->when($request->code, function ($clients, $code){
                return $clients->where('code', $code);}
        )->when($request->phone, function ($clients, $phone){
                return $clients->where('phone', $phone);}
        )->when($request->email, function ($clients, $email){
                return $clients->where('email', $email);}
        );
    }
}
