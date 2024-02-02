<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    Public Function scopeFilter ($query, $request) {

        return $query->when($request->name, function ($country, $name){
                return $country->where('name',$name);}
        );
        }
}
