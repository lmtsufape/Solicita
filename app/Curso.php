<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //
    protected $fillable = ['nome'];


    public function perfil(){
        return $this->hasMany('App\Perfil');
    }

    public function unidade(){
        return $this->belongsTo('App\Unidade');
    }
}
